<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ServicioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Funcionario;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dependencia;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Laptop;
use App\Models\Teclado;
use App\Models\Raton;
use App\Models\Upese;
use App\Models\Parlante;
use App\Models\Estabilizador;
use App\Models\OtrosEquipo;
use App\Models\RegistroCpu;
use App\Models\Audifono;
use App\Services\EquipoPdfService;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): View
{
    $query = Servicio::query()
        ->with([
            'funcionario',
            'Dependencia',
            'user'
        ]);

    $year = $request->input('year', date('Y'));

    if ($year !== 'todos') {
        $query->whereYear('created_at', $year);
    }

    if ($request->filled('estado')) {

        if ($request->estado == 'pendiente') {

            $query->where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('visto', 0);
            });

        } elseif ($request->estado == 'atendido') {

            $query->whereNotNull('user_id')
                  ->where('visto', 1);
        }
    }

    if ($request->filled('tecnico')) {
        $query->where('user_id', $request->tecnico);
    }

    if ($request->filled('dependencia')) {
        $query->where(
            'dependencia_id',
            $request->dependencia
        );
    }

    if ($request->filled('fecha_desde')) {
        $query->whereDate(
            'created_at',
            '>=',
            $request->fecha_desde
        );
    }

    if ($request->filled('fecha_hasta')) {
        $query->whereDate(
            'created_at',
            '<=',
            $request->fecha_hasta
        );
    }

    $servicios = $query
        ->orderByDesc('created_at')
        ->paginate(15)
        ->withQueryString();

    // Técnicos
    $users = User::whereHas('roles', function ($query) {
        $query->where('name', 'Tecnico');
    })
    ->where('id_estadousuario', '1')
    ->orderBy('paterno', 'asc')
    ->get();

    // Dependencias
    $dependencias = Dependencia::orderBy(
        'dependencias',
        'asc'
    )->get();

    // Hay pendientes
    $hayPendientes = Servicio::where('visto', 0)
        ->exists();

    return view(
        'servicio.index',
        compact(
            'servicios',
            'hayPendientes',
            'users',
            'dependencias',
            'year'
        )
    )->with(
        'i',
        ($request->input('page', 1) - 1) * $servicios->perPage()
    );
}


public function reporteServicioPdf(Request $request)
{
    $query = Servicio::with([
        'funcionario',
        'Dependencia',
        'user'
    ]);

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR GESTIÓN
    |--------------------------------------------------------------------------
    */
    if ($request->filled('year')) {

        $query->whereYear(
            'created_at',
            $request->year
        );

    }

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR ESTADO
    |--------------------------------------------------------------------------
    */
    if ($request->filled('estado')) {

        if ($request->estado == 'pendiente') {

            $query->where(function ($q) {

                $q->whereNull('user_id')
                  ->orWhere('visto', 0);

            });
        }

        if ($request->estado == 'atendido') {

            $query->whereNotNull('user_id')
                  ->where('visto', 1);

        }
    }

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR TÉCNICO
    |--------------------------------------------------------------------------
    */
    if ($request->filled('tecnico')) {

        $query->where(
            'user_id',
            $request->tecnico
        );

    }

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR DEPENDENCIA
    |--------------------------------------------------------------------------
    */
    if ($request->filled('dependencia')) {

        $query->where(
            'dependencia_id',
            $request->dependencia
        );

    }

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR FECHA DESDE
    |--------------------------------------------------------------------------
    */
    if ($request->filled('fecha_desde')) {

        $query->whereDate(
            'created_at',
            '>=',
            $request->fecha_desde
        );

    }

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR FECHA HASTA
    |--------------------------------------------------------------------------
    */
    if ($request->filled('fecha_hasta')) {

        $query->whereDate(
            'created_at',
            '<=',
            $request->fecha_hasta
        );

    }

    /*
    |--------------------------------------------------------------------------
    | OBTENER SERVICIOS
    |--------------------------------------------------------------------------
    */
    $servicios = $query
        ->orderBy('created_at', 'desc')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | DATOS PARA EL ENCABEZADO DEL PDF
    |--------------------------------------------------------------------------
    */

    // Si se seleccionó una gestión, usarla.
    // Si no, usar la gestión actual.
    $year = $request->year ?? now()->year;

/*
|--------------------------------------------------------------------------
| MES PARA EL ENCABEZADO
|--------------------------------------------------------------------------
*/

$year = $request->year ?? now()->year;

if ($request->filled('mes')) {

    $mesNombre = \Carbon\Carbon::create()
        ->month((int) $request->mes)
        ->locale('es')
        ->translatedFormat('F');

    $mesNombre = strtoupper($mesNombre);

} elseif (
    $request->filled('fecha_desde') &&
    $request->filled('fecha_hasta')
) {

    $desde = \Carbon\Carbon::parse($request->fecha_desde);
    $hasta = \Carbon\Carbon::parse($request->fecha_hasta);

    if ($desde->format('Y-m') === $hasta->format('Y-m')) {

        $mesNombre = strtoupper(
            $desde->locale('es')->translatedFormat('F')
        );

    } else {

        $mesNombre = strtoupper(
            $desde->locale('es')->translatedFormat('F')
        ) . ' - ' .
        strtoupper(
            $hasta->locale('es')->translatedFormat('F')
        );
    }

} elseif ($request->filled('fecha_desde')) {

    $mesNombre = strtoupper(
        \Carbon\Carbon::parse($request->fecha_desde)
            ->locale('es')
            ->translatedFormat('F')
    );

} elseif ($request->filled('fecha_hasta')) {

    $mesNombre = strtoupper(
        \Carbon\Carbon::parse($request->fecha_hasta)
            ->locale('es')
            ->translatedFormat('F')
    );

} else {

    $mesNombre = null;
}
    /*
    |--------------------------------------------------------------------------
    | GENERAR PDF
    |--------------------------------------------------------------------------
    */

    $pdf = Pdf::loadView(
        'servicio.reporte-pdf',
        compact(
            'servicios',
            'year',
            'mesNombre'
        )
    )->setPaper('letter');

    return $pdf->stream('reporte-servicios.pdf');
}
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $servicio = new Servicio();

        return view('servicio.create', compact('servicio'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'ci' => 'required|numeric',
        'dependencia_id' => 'required',
        'equipo' => 'required',
        'cod_gamea' => 'required|string|max:100',
        'falla' => 'required',
    ]);

    // Buscar por C.I.
    $funcionario = Funcionario::where('ci', $request->ci)->first();

    // Si no existe, registrarlo
    if (!$funcionario) {

        $request->validate([
            'nombre' => 'required|string',
            'paterno' => 'required|string',
            'materno' => 'required|string',
        ]);

        $funcionario = Funcionario::create([
            'ci' => $request->ci,
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'dependencia_id' => $request->dependencia_id,
        ]);
    }

    // Registrar requerimiento
    Servicio::create([
        'equipo' => $request->equipo,
        'cod_gamea' => $request->cod_gamea,
        'falla' => $request->falla,
        'visto' => false,
        'dependencia_id' => $request->dependencia_id,
        'funcionario_id' => $funcionario->id,
    ]);

    return redirect()->back()
        ->with('icono', 'success')
        ->with('success', 'LA SOLICITUD SE REGISTRO CON EXITO')
        ->with('text', 'EN BREVE LO ATENDEREMOS');
}

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $servicio = Servicio::find($id);

        return view('servicio.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $servicio = Servicio::find($id);

        return view('servicio.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicioRequest $request, Servicio $servicio): RedirectResponse
    {
        $servicio->update($request->validated());

        return Redirect::route('servicios.index')
            ->with('success', 'Servicio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Servicio::find($id)->delete();

        return Redirect::route('servicios.index')
            ->with('success', 'Servicio deleted successfully');
    }



    public function marcarVisto(Request $request)
    {
        $servicio = Servicio::find($request->id);

        if (!$servicio) {
            return response()->json([
                'success' => false
            ], 404);
        }

        $servicio->visto = !$servicio->visto;
        $servicio->save();

        return response()->json([
            'success' => true,
            'visto' => $servicio->visto
        ]);
    }

public function updateTecnico(Request $request, $id)
{
    $equipo = Servicio::findOrFail($id);

    // Técnico asignado
    $equipo->user_id = $request->input('user_id');

    // Fecha de asignación
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');

    // Usuario que realizó la asignación
    $equipo->asignado_por = auth()->id();

    $equipo->save();

    return Redirect::route('servicios.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE')
        ->with('icono', 'success');
}

public function atender(Request $request, $id)
{
    $request->validate([
        'puntuacion' => 'required|integer|min:1|max:5',
    ]);

    $servicio = Servicio::findOrFail($id);
    $servicio -> servicio = $request->servicio;
    $servicio->puntuacion = $request->puntuacion;
    $servicio->visto = 1;
    $servicio->fecha_atencion = now();

    $servicio->save();

return redirect()->back()
    ->with('success', 'La solicitud fue atendida correctamente')
    ->with('text', 'Gracias por su opinión')
    ->with('icono', 'success');
}


public function evaluar($id)
{
    $asignacion = Servicio::findOrFail($id);

    return view('asigTecnico.evaluar', compact('asignacion'));
}

public function buscarActivo(Request $request)
{
    $request->validate([
        'cod_gamea' => 'required|string|max:100',
    ]);

    $codigo = trim($request->cod_gamea);

    $modelos = [
        'C.P.U.' => [
            'modelo' => RegistroCpu::class,
            'equipo' => 'cpu',
        ],

        'Impresora' => [
            'modelo' => Impresora::class,
            'equipo' => 'impresora',
        ],

        'Monitor' => [
            'modelo' => Monitor::class,
            'equipo' => 'monitor',
        ],

        'Laptop' => [
            'modelo' => Laptop::class,
            'equipo' => 'laptop',
        ],

        'Teclado' => [
            'modelo' => Teclado::class,
            'equipo' => 'teclado',
        ],

        'Ratón' => [
            'modelo' => Raton::class,
            'equipo' => 'mouse',
        ],

        'UPS' => [
            'modelo' => Upese::class,
            'equipo' => 'ups',
        ],

        'Parlante' => [
            'modelo' => Parlante::class,
            'equipo' => 'parlante',
        ],

        'Estabilizador' => [
            'modelo' => Estabilizador::class,
            'equipo' => 'estabilizador',
        ],

        'Otros' => [
            'modelo' => OtrosEquipo::class,
            'equipo' => 'otros',
        ],

        'Audífono' => [
            'modelo' => Audifono::class,
            'equipo' => 'audifono',
        ],
    ];

foreach ($modelos as $tipo => $config) {

    $activo = $config['modelo']::where('cod_gamea', $codigo)->first();

    if ($activo) {

        $nombreEquipo = null;

        // Solo OtrosEquipo tiene tipo_equipo_id
        if ($config['modelo'] === OtrosEquipo::class) {

            $activo->load('tipoEquipo');

            $nombreEquipo = $activo->tipoEquipo?->nombre;
        }

        return response()->json([
            'encontrado' => true,
            'tipo' => $tipo,
            'equipo' => $config['equipo'],
            'cod_gamea' => $activo->cod_gamea,
            'id' => $activo->id,
            'nombre_equipo' => $nombreEquipo,
        ]);
    }
}

    return response()->json([
        'encontrado' => false,
        'mensaje' => 'No se encontró ningún activo con el código ingresado.',
    ]);
}

public function historialEquipo(Request $request)
{

    $codigo = trim($request->input('cod_gamea', ''));

    $historial = collect();

    $equipo = null;

    $serviciosOficina = collect();

    $mantenimientosTaller = collect();

    // =========================================================
    // RESULTADOS DE MANTENIMIENTO
    // =========================================================

        $resultados = [
            1 => 'DEVOLUCIÓN',
            2 => 'REPOSICIÓN',
            3 => 'REPLIEGUE',
            4 => 'CUSTODIO',
            5 => 'BAJA',
        ];


    // =========================================================
    // 1. SERVICIOS REALIZADOS EN OFICINA
    // =========================================================

    if ($codigo !== '') {

        $serviciosOficina = Servicio::with([
            'funcionario',
            'Dependencia',
            'user'
        ])
        ->where('cod_gamea', $codigo)
        ->orderBy('created_at', 'desc')
        ->get();


        foreach ($serviciosOficina as $servicio) {

            $historial->push([

                'fecha' => $servicio->created_at,

                'fecha_inicio' => null,

                'fecha_entrega' => null,

                'lugar' => 'Oficina',

                'tipo' => 'Servicio',

                'equipo' => $servicio->equipo ?? 'Equipo',

                'falla' => $servicio->falla ?? '',

                'observaciones' => null,

                'resultado_id' => null,

                'resultado' => null,

                'tecnico' => $servicio->user
                    ? trim(
                        ($servicio->user->name ?? '') . ' ' .
                        ($servicio->user->paterno ?? '') . ' ' .
                        ($servicio->user->materno ?? '')
                    )
                    : null,

                'registro' => $servicio,
            ]);
        }


        // =====================================================
        // 2. MODELOS DE EQUIPOS - MANTENIMIENTO EN TALLER
        // =====================================================

        $modelos = [
            'C.P.U.' => [
                'modelo' => RegistroCpu::class,
                'equipo' => 'cpu',
            ],

            'Impresora' => [
                'modelo' => Impresora::class,
                'equipo' => 'impresora',
            ],

            'Monitor' => [
                'modelo' => Monitor::class,
                'equipo' => 'monitor',
            ],

            'Laptop' => [
                'modelo' => Laptop::class,
                'equipo' => 'laptop',
            ],

            'Teclado' => [
                'modelo' => Teclado::class,
                'equipo' => 'teclado',
            ],

            'Ratón' => [
                'modelo' => Raton::class,
                'equipo' => 'mouse',
            ],

            'UPS' => [
                'modelo' => Upese::class,
                'equipo' => 'ups',
            ],

            'Parlante' => [
                'modelo' => Parlante::class,
                'equipo' => 'parlante',
            ],

            'Estabilizador' => [
                'modelo' => Estabilizador::class,
                'equipo' => 'estabilizador',
            ],

            'Otros' => [
                'modelo' => OtrosEquipo::class,
                'equipo' => 'otros',
            ],

            'Audífono' => [
                'modelo' => Audifono::class,
                'equipo' => 'audifono',
            ],
        ];


foreach ($modelos as $nombreEquipo => $config) {

    $modelo = $config['modelo'];
    $tipoEquipo = $config['equipo'];

    $registros = $modelo::where('cod_gamea', $codigo)
        ->orderBy('fecha', 'desc')
        ->get();

    foreach ($registros as $registro) {

        // Nombre que se mostrará
        $nombreMostrar = $nombreEquipo;

        // =====================================================
        // SI ES OTROS, OBTENER EL NOMBRE DESDE tipo_equipo_id
        // =====================================================

        if ($modelo === OtrosEquipo::class) {

            $registro->load('tipoEquipo');

            $nombreMostrar = $registro->tipoEquipo?->nombre ?? 'Otros';
        }


        // =====================================================
        // DATOS GENERALES DEL EQUIPO
        // =====================================================

        if ($equipo === null) {

            $equipo = [
                'tipo' => $nombreMostrar,
                'marca' => $registro->marca ?? '',
                'modelo' => $registro->modelo ?? '',
                'cod_gamea' => $registro->cod_gamea ?? $codigo,
                'cod_registro' => $registro->cod_registro ?? '',
            ];
        }


        // =====================================================
        // RESULTADO
        // =====================================================

        $resultadoId = $registro->resultado_id;

        $resultadoNombre = $resultados[$resultadoId] ?? null;

        // =====================================================
        // AGREGAR AL HISTORIAL
        // =====================================================

$historial->push([
    'fecha' => $registro->fecha,
    'fecha_inicio' => $registro->fecha_inicio,
    'fecha_entrega' => $registro->fecha_entrega,
    'lugar' => 'Taller',
    'tipo' => 'Mantenimiento',
    'equipo' => $nombreMostrar,
    'tipo_equipo' => $tipoEquipo,
    'falla' => $registro->falla ?? '',
    'observaciones' => $registro->observaciones ?? '',
    'resultado_id' => $resultadoId,
    'resultado' => $resultadoNombre,
    'tecnico' => $registro->tecnico ?? null,
    'registro' => $registro,
]);


        $mantenimientosTaller->push($registro);
    }
}


        // =====================================================
        // 3. ORDENAR TODO EL HISTORIAL POR FECHA
        // =====================================================

        $historial = $historial
            ->sortByDesc(function ($item) {

                return $item['fecha'];
            })
            ->values();


        // =====================================================
        // 4. SI NO ENCONTRAMOS EQUIPO EN TALLER,
        //    PERO EXISTE SERVICIO EN OFICINA
        // =====================================================

        if ($equipo === null && $serviciosOficina->isNotEmpty()) {

            $primerServicio = $serviciosOficina->first();

            $equipo = [

                'tipo' => $primerServicio->equipo ?? 'Equipo',

                'marca' => '',

                'modelo' => '',

                'cod_gamea' => $primerServicio->cod_gamea ?? $codigo,

                'cod_registro' => '',
            ];
        }
    }


    // =========================================================
    // 5. ESTADÍSTICAS
    // =========================================================

    $totalOficina = $serviciosOficina->count();

    $totalTaller = $mantenimientosTaller->count();

    $totalAtenciones = $historial->count();


    // Primera atención registrada
    $primeraAtencion = $historial->last();

    // Última atención registrada
    $ultimaAtencion = $historial->first();


    // =========================================================
    // 6. ENVIAR TODO A LA VISTA
    // =========================================================

    return view('servicio.historial', compact(

        'codigo',

        'equipo',

        'historial',

        'totalOficina',

        'totalTaller',

        'totalAtenciones',

        'primeraAtencion',

        'ultimaAtencion'

    ));
}

public function historialEquipoPdf(Request $request)
{
    $codigo = trim($request->input('cod_gamea', ''));

    if ($codigo === '') {
        return redirect()
            ->route('servicios.historial')
            ->with('error', 'Debe ingresar un código GAMEA.');
    }

    $historial = collect();

    $equipo = null;

    $serviciosOficina = collect();

    $mantenimientosTaller = collect();

    $resultados = [
        1 => 'DEVOLUCIÓN',
        2 => 'REPOSICIÓN',
        3 => 'REPLIEGUE',
        4 => 'CUSTODIO',
        5 => 'BAJA',
    ];

    /*
    |--------------------------------------------------------------------------
    | SERVICIOS DE OFICINA
    |--------------------------------------------------------------------------
    */

    $serviciosOficina = Servicio::with([
        'funcionario',
        'Dependencia',
        'user'
    ])
    ->where('cod_gamea', $codigo)
    ->orderBy('created_at', 'desc')
    ->get();

    foreach ($serviciosOficina as $servicio) {

        $historial->push([
            'fecha' => $servicio->created_at,
            'fecha_inicio' => null,
            'fecha_entrega' => null,

            'lugar' => 'OFICINA',
            'tipo' => 'SERVICIO',

            'equipo' => $servicio->equipo ?? 'Equipo',

            'falla' => $servicio->falla ?? '',

            'observaciones' => null,

            'resultado_id' => null,
            'resultado' => null,

            'tecnico' => $servicio->user
                ? trim(
                    ($servicio->user->name ?? '') . ' ' .
                    ($servicio->user->paterno ?? '') . ' ' .
                    ($servicio->user->materno ?? '')
                )
                : null,

            'registro' => $servicio,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EQUIPOS DE TALLER
    |--------------------------------------------------------------------------
    */

    $modelos = [

        'C.P.U.' => [
            'modelo' => RegistroCpu::class,
            'equipo' => 'cpu',
        ],

        'Impresora' => [
            'modelo' => Impresora::class,
            'equipo' => 'impresora',
        ],

        'Monitor' => [
            'modelo' => Monitor::class,
            'equipo' => 'monitor',
        ],

        'Laptop' => [
            'modelo' => Laptop::class,
            'equipo' => 'laptop',
        ],

        'Teclado' => [
            'modelo' => Teclado::class,
            'equipo' => 'teclado',
        ],

        'Ratón' => [
            'modelo' => Raton::class,
            'equipo' => 'mouse',
        ],

        'UPS' => [
            'modelo' => Upese::class,
            'equipo' => 'ups',
        ],

        'Parlante' => [
            'modelo' => Parlante::class,
            'equipo' => 'parlante',
        ],

        'Estabilizador' => [
            'modelo' => Estabilizador::class,
            'equipo' => 'estabilizador',
        ],

        'Otros' => [
            'modelo' => OtrosEquipo::class,
            'equipo' => 'otros',
        ],

        'Audífono' => [
            'modelo' => Audifono::class,
            'equipo' => 'audifono',
        ],
    ];

    foreach ($modelos as $nombreEquipo => $config) {

        $modelo = $config['modelo'];

        $tipoEquipo = $config['equipo'];

        $registros = $modelo::where('cod_gamea', $codigo)
            ->orderBy('fecha', 'desc')
            ->get();

        foreach ($registros as $registro) {

            /*
            |--------------------------------------------------------------------------
            | NOMBRE DEL EQUIPO
            |--------------------------------------------------------------------------
            */

            $nombreMostrar = $nombreEquipo;

            /*
            |--------------------------------------------------------------------------
            | OTROS EQUIPOS
            |--------------------------------------------------------------------------
            */

            if ($modelo === OtrosEquipo::class) {

                $registro->load('tipoEquipo');

                $nombreMostrar =
                    $registro->tipoEquipo?->nombre ?? 'Otros';
            }

            /*
            |--------------------------------------------------------------------------
            | DATOS PRINCIPALES DEL ACTIVO
            |--------------------------------------------------------------------------
            */

            if ($equipo === null) {

                $equipo = [
                    'tipo' => $nombreMostrar,

                    'marca' => $registro->marca ?? '',

                    'modelo' => $registro->modelo ?? '',

                    'cod_gamea' =>
                        $registro->cod_gamea ?? $codigo,

                    'cod_registro' =>
                        $registro->cod_registro ?? '',
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | RESULTADO
            |--------------------------------------------------------------------------
            */

            $resultadoId = $registro->resultado_id;

            $resultadoNombre =
                $resultados[$resultadoId] ?? null;

            /*
            |--------------------------------------------------------------------------
            | HISTORIAL
            |--------------------------------------------------------------------------
            */

            $historial->push([

                'fecha' => $registro->fecha,

                'fecha_inicio' =>
                    $registro->fecha_inicio,

                'fecha_entrega' =>
                    $registro->fecha_entrega,

                'lugar' => 'TALLER',

                'tipo' => 'MANTENIMIENTO',

                'equipo' => $nombreMostrar,

                'tipo_equipo' => $tipoEquipo,

                'falla' =>
                    $registro->falla ?? '',

                'observaciones' =>
                    $registro->observaciones ?? '',

                'resultado_id' =>
                    $resultadoId,

                'resultado' =>
                    $resultadoNombre,

                'tecnico' =>
                    $registro->tecnico ?? null,

                'registro' =>
                    $registro,
            ]);

            $mantenimientosTaller->push($registro);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SI NO SE ENCONTRÓ EL EQUIPO EN TALLER
    |--------------------------------------------------------------------------
    */

    if (
        $equipo === null &&
        $serviciosOficina->isNotEmpty()
    ) {

        $primerServicio =
            $serviciosOficina->first();

        $equipo = [

            'tipo' =>
                $primerServicio->equipo ?? 'Equipo',

            'marca' => '',

            'modelo' => '',

            'cod_gamea' =>
                $primerServicio->cod_gamea ?? $codigo,

            'cod_registro' => '',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | ORDENAR HISTORIAL
    |--------------------------------------------------------------------------
    */

    $historial = $historial
        ->sortByDesc(function ($item) {

            return $item['fecha'];
        })
        ->values();

    /*
    |--------------------------------------------------------------------------
    | RESUMEN
    |--------------------------------------------------------------------------
    */

    $totalOficina =
        $serviciosOficina->count();

    $totalTaller =
        $mantenimientosTaller->count();

    $totalAtenciones =
        $historial->count();

    $primeraAtencion =
        $historial->last();

    $ultimaAtencion =
        $historial->first();

    /*
    |--------------------------------------------------------------------------
    | SI NO EXISTEN REGISTROS
    |--------------------------------------------------------------------------
    */

    if ($historial->isEmpty()) {

        return redirect()
            ->route(
                'servicios.historial',
                ['cod_gamea' => $codigo]
            )
            ->with(
                'error',
                'No se encontraron registros asociados al código GAMEA ' . $codigo . '.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DATOS PARA EL PDF
    |--------------------------------------------------------------------------
    */

    $data = [

        'codigo' =>
            $codigo,

        'equipo' =>
            $equipo,

        'historial' =>
            $historial,

        'totalOficina' =>
            $totalOficina,

        'totalTaller' =>
            $totalTaller,

        'totalAtenciones' =>
            $totalAtenciones,

        'primeraAtencion' =>
            $primeraAtencion,

        'ultimaAtencion' =>
            $ultimaAtencion,

        /*
        |--------------------------------------------------------------------------
        | DATOS DEL FOOTER
        |--------------------------------------------------------------------------
        */

        'footer' => [

            'Gobierno Autónomo Municipal de El Alto',

            'Unidad de Administración de Sistemas de Información',

            'Área de Soporte Técnico',

            'Historial de equipo - Código GAMEA: ' . $codigo,
        ],
    ];

    /*
    |--------------------------------------------------------------------------
    | GENERAR PDF
    |--------------------------------------------------------------------------
    */

    $pdfService =
        app(EquipoPdfService::class);

    return response(
        $pdfService->generar(
            $data,
            'servicio.pdf.historial'
        )
    )
    ->header(
        'Content-Type',
        'application/pdf'
    )
    ->header(
        'Content-Disposition',
        'inline; filename="historial-equipo-' . $codigo . '.pdf"'
    );
}
}
