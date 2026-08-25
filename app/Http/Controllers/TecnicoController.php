<?php

namespace App\Http\Controllers;

use App\Models\Audifono;
use App\Models\CantidadRam;
use App\Models\CapacidadDisco;
use App\Models\CapacidadRam;
use App\Models\CapacidadTvideo;
use App\Models\ColorCase;
use App\Models\Dependencia;
use App\Models\DisipadorRam;
use App\Models\Estabilizador;
use App\Models\Estado;
use App\Models\EstadoUsuario;
use App\Models\GenProcesador;
use App\Models\Impresora;
use App\Models\Laptop;
use App\Models\MarcaCase;
use App\Models\MarcaDisco;
use App\Models\MarcaFuente;
use App\Models\MarcaLectorcd;
use App\Models\MarcaProcesador;
use App\Models\MarcaRam;
use App\Models\MarcaTmadre;
use App\Models\MarcaTred;
use App\Models\MarcaTvideo;
use App\Models\MarcaTwifi;
use App\Models\ModeloProcesador;
use App\Models\ModeloTmadre;
use App\Models\ModeloTred;
use App\Models\ModeloWifi;
use App\Models\Monitor;
use App\Models\Parlante;
use App\Models\PotenciaFuente;
use App\Models\Raton;
use App\Models\RegistroCpu;
use App\Models\Role;
use App\Models\Teclado;
use App\Models\TipoDisco;
use App\Models\TipoRam;
use App\Models\TipoTvideo;
use App\Models\Upese;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Servicio;
use App\Models\Funcionario;
use Illuminate\Support\Str;
use App\Models\OtrosEquipo;


class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name','LIKE', 'Tecnico');
        })->orderBy('paterno', 'asc')->get();
        $roles = Role:: all();
        $estados = EstadoUsuario:: all();
        return view('tecnico.index', compact('users', 'roles','estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $roles = Role:: all();
        $estados = EstadoUsuario:: all();
        return view('tecnico.create', compact('user', 'roles','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'ci' => 'required',
            'expedido' => 'required',
            'celular' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'id_estadousuario' => 'required',

        ]);
    
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->expedido = $request->input('expedido');
        $user->celular = $request->input('celular');
        $user->paterno = $request->input('paterno');
        $user->materno = $request->input('materno');
        $user->id_estadousuario = $request->input('id_estadousuario');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $user->assignRole('Tecnico');
    
        return redirect()->route('tecnicos.index')
        ->with('icono', 'success')
        ->with('success', 'TECNICO REGISTRADO CON EXITO');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $estados = EstadoUsuario:: all();
        return view('tecnico.edit', compact('user','roles', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->expedido = $request->input('expedido');
        $user->celular = $request->input('celular');
        $user->paterno = $request->input('paterno');
        $user->materno = $request->input('materno');
        $user->id_estadousuario = $request->input('id_estadousuario');
        $user->update();
        $user->roles()->sync($request->roles);

        return redirect()->route('tecnicos.index')
        ->with('success', 'REGISTRADO ACTUALIZADO')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return Redirect::route('tecnicos.index')
            ->with('success', 'User deleted successfully');
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->update();
        return Redirect::route('tecnicos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE') 
        ->with('text', 'Se actualizo la contraseña')          
        ->with('icono', 'success');
    }


    public function cambiarEstado(Request $request)
    {
        $user = User::find($request->id);
        $estados = [1 => 2, 2 => 1] ;// Mapeo de estados
        $estadoSiguiente = $estados[$user->id_estadousuario];
        $user->id_estadousuario = $estadoSiguiente;
        $user->save();

        return response()->json(['estado' => $user->estadousuario->nombre]);
    }

public function tecnicoPanel($id)
{
    $user = User::where('id', $id)->first();

    $userId = User::find($id);
        $audifonos = Audifono::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $monitors = Monitor::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $laptops = Laptop::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $cpus = RegistroCpu::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $impresoras = Impresora::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $estabilizadors = Estabilizador::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $teclados = Teclado::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $mouses = Raton::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $upss = Upese::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $parlantes = Parlante::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();

// ----------------------------------------------------------------------------
    return view('asigTecnicos.panel', compact('user'));
}

public function tecnicoEstadistica($id)
{
    $user = User::where('id', $id)->first();

    $user = User::find($id);
$modelos = [
    'CPU' => RegistroCpu::class,
    'Impresora' => Impresora::class,
    'Monitor' => Monitor::class,
    'Audifono' => Audifono::class,
    'Parlante' => Parlante::class,
    'Estabilizador' => Estabilizador::class,
    'Mouse' => Raton::class,
    'Teclado' => Teclado::class,
    'UPS' => Upese::class,
    'Laptop' => Laptop::class,
];

$totales1 = [];

$anioActual = date('Y');

foreach ($modelos as $nombre => $modelo) {
    $totales1[$nombre] = $modelo::where('user_id', $id)
        ->whereYear('fecha_asignacion', $anioActual)
        ->count();
}

// ---------------------------TECNICO-------------------------------------------------
    $cpuPorMes = RegistroCpu::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesCpu2 = [];
    foreach ($cpuPorMes as $cpu) {
        
        $mes = date('F', mktime(0, 0, 0, $cpu->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesCpu2[$mes] = $cpu->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $audifonosPorMes = Audifono::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesAudifono2 = [];
    foreach ($audifonosPorMes as $audifono) {
        $mes = date('F', mktime(0, 0, 0, $audifono->mes, 1));
        $mesa = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesAudifono2[$mesa] = $audifono->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $impresoraPorMes = Impresora::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesImpresora2 = [];
    foreach ($impresoraPorMes as $impresora) {
        
        $mes = date('F', mktime(0, 0, 0, $impresora->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesImpresora2[$mes] = $impresora->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $monitorPorMes = Monitor::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesMonitor2 = [];
    foreach ($monitorPorMes as $monitor) {
        
        $mes = date('F', mktime(0, 0, 0, $monitor->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesMonitor2[$mes] = $monitor->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $tecladoPorMes = Teclado::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

    $totalesTeclado2 = [];
    foreach ($tecladoPorMes as $teclado) {        
        $mes = date('F', mktime(0, 0, 0, $teclado->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesTeclado2[$mes] = $teclado->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $parlantePorMes = Parlante::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesParlante2 = [];
    foreach ($parlantePorMes as $parlante) {        
        $mes = date('F', mktime(0, 0, 0, $parlante->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesParlante2[$mes] = $parlante->total;
    }
// ---------------------------TECNICO-------------------------------------------------
$mousePorMes = Raton::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

$totalesMouse2 = [];

foreach ($mousePorMes as $mouse) {
    $mes = strtoupper(
        \Carbon\Carbon::create()->month($mouse->mes)->translatedFormat('F')
    );

    $totalesMouse2[$mes] = $mouse->total;
}
// ---------------------------TECNICO-------------------------------------------------
    $upsPorMes = Upese::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesUps2 = [];
    foreach ($upsPorMes as $ups) {        
        $mes = date('F', mktime(0, 0, 0, $ups->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesUps2[$mes] = $ups->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $estabilizadorPorMes = Estabilizador::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesEstabilizador2 = [];
    foreach ($estabilizadorPorMes as $estabilizador) {        
        $mes = date('F', mktime(0, 0, 0, $estabilizador->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesEstabilizador2[$mes] = $estabilizador->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $laptopPorMes = Laptop::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $id)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesLaptop2 = [];
    foreach ($laptopPorMes as $laptop) {        
        $mes = date('F', mktime(0, 0, 0, $laptop->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesLaptop2[$mes] = $laptop->total;
    }

// ----------------------------------------------------------------------------
    return view('asigTecnicos.estadisticas', compact('user', 'totales1' ,'totalesAudifono2','totalesImpresora2','totalesCpu2', 'totalesMouse2', 'totalesMonitor2', 'totalesTeclado2', 'totalesParlante2', 'totalesUps2', 'totalesEstabilizador2', 'totalesLaptop2'));


}

public function tecnicoTeclado($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigTeclado', compact('users'));
}

public function tecnicoAudifono($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigAudifono', compact('users'));
}

public function tecnicoCpu($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigCpu', compact('users'));
}

public function tecnicoImpresora($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigImpresora', compact('users'));
}

public function tecnicoMonitor($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigMonitor', compact('users'));
}

public function tecnicoParlante($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigParlante', compact('users'));
}

public function tecnicoEstabilizador($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigEstabilizador', compact('users'));
}

public function tecnicoMouse($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigMouse', compact('users'));
}

public function tecnicoUps($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigUps', compact('users'));
}

public function tecnicoLaptop($id)
{
    $users = User::where('id', $id)->first();
    return view('asigTecnicos.asigLaptop', compact('users'));
}
public function panelRegistros($id)
{
        $registroCpu = new RegistroCpu();
        $capdisco=CapacidadDisco::all();
        $capram=CapacidadRam::all();
        $captvideo=CapacidadTvideo::all();
        $colorcase=ColorCase::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $estado=Estado::all()->except(6);
        $genprocesador=GenProcesador::all();
        $marcacase=MarcaCase::all();
        $marcadisco=MarcaDisco::all();
        $marcafuente=MarcaFuente::all();
        $marcalectorcd=MarcaLectorcd::all();
        $marcaprocesador=MarcaProcesador::all();
        $marcaram=MarcaRam::all();
        $marcatmadre=MarcaTmadre::all();
        $modelotmadre=ModeloTmadre::all();
        $marcatred=MarcaTred::all();
        $marcatvideo=MarcaTvideo::all();
        $marcatwifi=MarcaTwifi::all();
        $modelowifi=ModeloWifi::all();
        $disipadorram=DisipadorRam::all();
        $modprocesador=ModeloProcesador::all();    
        $tiporam=TipoRam::all();
        $modelotred=ModeloTred::all();
        $cantidadram=CantidadRam::all();
        $potenciafuente=PotenciaFuente::all();
        $tipodisco=TipoDisco::all();
        $tipotvideo=TipoTvideo::all();
        $user = User::where('id', $id)->first();
        $impresora = new Impresora();  
        $audifono = new Audifono();  
        $estabilizador = new Estabilizador();
        $monitor = new Monitor();
        $upese = new Upese();
        $raton = new Raton();
        $parlante = new Parlante();
        $teclado = new Teclado();
        $laptop = new Laptop();
        return view('panel.PanelRegistro', compact('registroCpu','capdisco','capram','user'
        ,'captvideo','colorcase','dependencia','estado','genprocesador','modelowifi','disipadorram','cantidadram',
        'marcacase','marcadisco','marcafuente','marcalectorcd','marcaprocesador','tiporam',
        'marcaram','marcatmadre','modelotmadre','marcatred','marcatvideo','marcatwifi',
        'modprocesador','modelotred','potenciafuente','tipodisco','tipotvideo','impresora','audifono',
        'estabilizador','monitor','upese','raton','parlante','teclado', 'laptop'))   ;   

}

public function reporteGeneralPdf(Request $request)
{
    $tipo = $request->input('tipo', 'anio');
    $anio = $request->input('anio', date('Y'));
    $mes = $request->input('mes');

    // Obtener todos los usuarios que tienen el rol Técnico
    $users = User::whereHas('roles', function ($query) {
        $query->where('name', 'LIKE', 'Tecnico');
    })
    ->orderBy('paterno', 'asc')
    ->get();

    $asignaciones = [
        ['titulo' => 'CPUs', 'relacion' => 'registro_cpus'],
        ['titulo' => 'Impresoras', 'relacion' => 'impresoras'],
        ['titulo' => 'Monitores', 'relacion' => 'monitor'],
        ['titulo' => 'Audífonos', 'relacion' => 'audifonos'],
        ['titulo' => 'Laptops', 'relacion' => 'laptop'],
        ['titulo' => 'Teclados', 'relacion' => 'teclados'],
        ['titulo' => 'Parlantes', 'relacion' => 'parlantes'],
        ['titulo' => 'Mouse', 'relacion' => 'raton'],
        ['titulo' => 'UPS', 'relacion' => 'upeses'],
        ['titulo' => 'Estabilizadores', 'relacion' => 'estabilizador'],
        ['titulo' => 'OtrosEquipo', 'relacion' => 'otrosequipos'],
    ];

    $estados = [
        1 => 'Recepcionado',
        2 => 'En proceso',
        3 => 'Apersonarse',
        4 => 'Concluido',
        5 => 'Entregado',
    ];

    $datosTecnicos = [];

    foreach ($users as $user) {

        $datos = [];

        foreach ($asignaciones as $item) {

            $rel = $item['relacion'];

            /*
             * Consulta general del tipo de equipo
             */
            $query = $user->$rel()
                ->whereYear('fecha_asignacion', $anio);

            if ($tipo === 'mes' && $mes) {
                $query->whereMonth('fecha_asignacion', $mes);
            }

            $total = $query->count();

            /*
             * Cantidades por estado
             */
            $estadosData = [];

            foreach ($estados as $idEstado => $nombreEstado) {

                $queryEstado = $user->$rel()
                    ->whereYear('fecha_asignacion', $anio)
                    ->where('estado_id', $idEstado);

                if ($tipo === 'mes' && $mes) {
                    $queryEstado->whereMonth('fecha_asignacion', $mes);
                }

                $cantidad = $queryEstado->count();

                $estadosData[] = [
                    'estado' => $nombreEstado,
                    'cantidad' => $cantidad,
                ];
            }

            $datos[] = [
                'titulo' => $item['titulo'],
                'total' => $total,
                'estados' => $estadosData,
            ];
        }

        /*
         * Guardamos la información del técnico
         */
        $datosTecnicos[] = [
            'user' => $user,
            'datos' => $datos,
        ];
    }

    /*
     * Nombre del mes
     */
    $meses = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE',
    ];

    $nombreMes = $mes
        ? $meses[(int) $mes]
        : null;

    /*
     * Generar UN SOLO PDF
     */
    $pdf = Pdf::loadView(
        'tecnico.informe-pdf',
        compact(
            'datosTecnicos',
            'anio',
            'tipo',
            'nombreMes'
        )
    );

    return $pdf->stream(
        'reporte_general' . $anio . '.pdf'
    );
}

public function asignacionesAsistencia()
{
    $user = Auth::user();

    $asignaciones = Servicio::where('user_id', $user->id)
        ->latest()
        ->get();

    return view('asigAsistencia.asigAsistencia', compact('user', 'asignaciones'));
}


public function buscarEvaluacion()
{
    return view('asigAsistencia.buscar-evaluacion');
}

public function mostrarEvaluacion(Request $request)
{
    $request->validate([
        'ci' => 'required|string|max:20',
    ]);

    $funcionario = Funcionario::where('ci', $request->ci)
        ->first();

    if (!$funcionario) {

        return back()->with(
            'error',
            'No se encontró un usuario con ese número de documento.'
        );
    }

    $asignacion = Servicio::with([
        'tecnico',
        'funcionario'
    ])
    ->where('funcionario_id', $funcionario->id)

    // Solo solicitudes no vistas
    ->where('visto', 0)

    // Debe tener técnico asignado
    ->whereNotNull('user_id')

    // Todavía no atendida/evaluada
    // ->whereNull('fecha_atencion')

    ->latest()
    ->first();

    if (!$asignacion) {

        return back()->with(
            'warning',
            'No existen solicitudes pendientes de evaluación.'
        );
    }

    return view(
        'asigAsistencia.evaluar',
        compact('asignacion')
    );
}

public function evaluar($id)
{
    $asignacion = Servicio::with([
        'tecnico',
        'funcionario'
    ])->findOrFail($id);

    if ($asignacion->fecha_atencion) {

        return view('asignaciones.gracias');
    }

    return view(
        'asigAsistencia.evaluar',
        compact('asignacion')
    );
}

public function guardarEvaluacion(Request $request)
{
    $request->validate([
        'asignacion_id' => 'required|integer',
        'servicio' => 'required|string|max:1000',
        'puntuacion' => 'required|integer|between:1,5',
    ]);

    $asignacion = Servicio::findOrFail(
        $request->asignacion_id
    );

    if ($asignacion->fecha_atencion) {
        return back()->with(
            'error',
            'Esta solicitud ya fue evaluada.'
        );
    }

    $asignacion->servicio = $request->servicio;
    $asignacion->puntuacion = $request->puntuacion;
    $asignacion->visto = 1;
    $asignacion->fecha_atencion = now();

    $asignacion->save();

    return view('asigAsistencia.gracias');
}

}
