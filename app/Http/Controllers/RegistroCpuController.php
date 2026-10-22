<?php

namespace App\Http\Controllers;

use App\Models\RegistroCpu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroCpuRequest;
use App\Models\CantidadRam;
use App\Models\CapacidadDisco;
use App\Models\CapacidadRam;
use App\Models\CapacidadTvideo;
use App\Models\ColorCase;
use App\Models\Dependencia;
use App\Models\DisipadorRam;
use App\Models\Estado;
use App\Models\Funcionario;
use App\Models\GenProcesador;
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
use App\Models\PotenciaFuente;
use App\Models\TipoDisco;
use App\Models\TipoRam;
use App\Models\TipoTvideo;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use TCPDF;
use App\Services\TwilioService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMantenimiento;
use App\Services\NotificacionService;
use App\Mail\TecnicoAsignado;
use App\Services\EquipoPdfService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Correlativo;
use App\Services\CorrelativoService;
use App\Models\Termino;
use Illuminate\Support\Facades\Storage;
use App\Mail\EquipoPdfEnviado;
use Illuminate\Support\Facades\Cache;

class RegistroCpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $notificacionService;

    public function __construct(NotificacionService $notificacionService)
    {
        $this->notificacionService = $notificacionService;
    }


public function index(Request $request): View
{
    $gestionActual = (int) now()->year;
    $gestionPasada = $gestionActual - 1;

    // Rango de los últimos 30 días de la gestión pasada.
    $fechaFinPasada = Carbon::create($gestionPasada, 12, 31)->endOfDay();
    $fechaInicioPasada = $fechaFinPasada->copy()->subDays(29)->startOfDay();

    // Registros de los últimos 30 días de la gestión pasada
    // (excepto estado 5) o de toda la gestión actual.
    $inicioGestionActual = Carbon::create($gestionActual, 1, 1)->startOfDay();
    $inicioGestionSiguiente = Carbon::create($gestionActual + 1, 1, 1)->startOfDay();

    $registroCpus = RegistroCpu::query()
        ->where(function ($query) use (
            $fechaInicioPasada,
            $fechaFinPasada,
            $inicioGestionActual,
            $inicioGestionSiguiente
        ) {
            $query->where(function ($subquery) use (
                $fechaInicioPasada,
                $fechaFinPasada
            ) {
                $subquery->whereBetween('fecha', [
                    $fechaInicioPasada,
                    $fechaFinPasada,
                ])
                ->where('estado_id', '!=', 5);
            })
            ->orWhere(function ($subquery) use (
                $inicioGestionActual,
                $inicioGestionSiguiente
            ) {
                $subquery->where('fecha', '>=', $inicioGestionActual)
                         ->where('fecha', '<', $inicioGestionSiguiente);
            });
        })
        ->orderByDesc('fecha')
        ->paginate(15)
        ->withQueryString();

    // Catálogos: se conservan los mismos nombres utilizados por la vista.
    $catalogos = [
        'capdisco'        => CapacidadDisco::class,
        'capram'          => CapacidadRam::class,
        'captvideo'       => CapacidadTvideo::class,
        'colorcase'       => fn() => ColorCase::orderBy('color')->get(),
        'dependencia'     => fn() => Dependencia::orderBy('dependencias')->get(),
        'estado'          => Estado::class,
        'genprocesador'   => GenProcesador::class,
        'marcacase'       => fn() => MarcaCase::orderBy('marca')->get(),
        'marcadisco'      => fn() => MarcaDisco::orderBy('marca')->get(),
        'marcafuente'     => MarcaFuente::class,
        'marcalectorcd'   => MarcaLectorcd::class,
        'marcaprocesador' => MarcaProcesador::class,
        'marcaram'        => fn() => MarcaRam::orderBy('marca')->get(),
        'marcatmadre'     => fn() => MarcaTmadre::orderBy('marca')->get(),
        'modelotmadre'    => fn() => ModeloTmadre::orderBy('modelo')->get(),
        'marcatred'       => fn() => MarcaTred::orderBy('marca')->get(),
        'marcatvideo'     => fn() => MarcaTvideo::orderBy('marca')->get(),
        'marcatwifi'      => fn() => MarcaTwifi::orderBy('marca')->get(),
        'modelowifi'      => fn() => ModeloWifi::orderBy('modelo')->get(),
        'disipadorram'    => DisipadorRam::class,
        'modprocesador'   => ModeloProcesador::class,
        'tiporam'         => TipoRam::class,
        'modelotred'      => fn() => ModeloTred::orderBy('modelo')->get(),
        'cantidadram'     => CantidadRam::class,
        'potenciafuente'  => PotenciaFuente::class,
        'tipodisco'       => TipoDisco::class,
        'tipotvideo'      => TipoTvideo::class,
    ];

    // Cachear los catálogos durante una hora.
    $catalogosData = Cache::remember(
        'registro_cpu.catalogos.v1',
        now()->addHour(),
        function () use ($catalogos) {
            return collect($catalogos)->mapWithKeys(
                function ($origen, $clave) {
                    $resultado = is_callable($origen)
                        ? $origen()
                        : $origen::query()->get();

                    return [$clave => $resultado];
                }
            )->all();
        }
    );

    // Funcionarios: se mantiene la colección completa por compatibilidad
    // con la vista actual, pero la consulta se reutiliza desde caché.
    $funcionarios = Cache::remember(
        'registro_cpu.funcionarios.v1',
        now()->addHour(),
        fn() => Funcionario::query()->get()
    );

    // Técnicos activos.
    $tecnicos = Cache::remember(
        'registro_cpu.tecnicos.v1',
        now()->addHour(),
        fn() => User::query()
            ->where('id_estadousuario', 1)
            ->whereHas('roles', fn($query) =>
                $query->where('name', 'Tecnico')
            )
            ->orderBy('paterno')
            ->get()
    );

    // Términos y condiciones.
    $termino = Cache::remember(
        'registro_cpu.termino.v1',
        now()->addHour(),
        fn() => Termino::query()->first()
    );

    $data = array_merge($catalogosData, [
        'funcionario' => $funcionarios,
        'users'       => $tecnicos,
        'registroCpus' => $registroCpus,
        'termino'      => $termino,
        'i'            => ($registroCpus->currentPage() - 1)
                        * $registroCpus->perPage(),
    ]);

    return view('registro-cpu.index', $data);
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request,CorrelativoService $correlativoService) 
{
    /*
    |--------------------------------------------------------------------------
    | 1. VALIDAR ANTES DE ESCRIBIR EN LA BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    $request->validate([
        'ci'        => 'required',
        'celular'   => 'required|string',
        'email'     => 'required|string',
        'cod_gamea' => 'required|integer',
        'falla'     => 'required|string',
        'respaldo'  => 'required|string',
    ]);

    /*
    |--------------------------------------------------------------------------
    | 2. PROCESAR FUNCIONARIO, CATÁLOGOS Y CPU EN UNA TRANSACCIÓN
    |--------------------------------------------------------------------------
    */
    $registroCpu = DB::transaction(function () use (
        $request,
        $correlativoService
    ) {

        /*
        |--------------------------------------------------------------------------
        | FUNCIONARIO
        |--------------------------------------------------------------------------
        */
        $funcionario = Funcionario::firstOrNew([
            'ci' => $request->input('ci'),
        ]);

        $funcionario->grado_academico = $request->input('grado_academico');
        $funcionario->paterno         = $request->input('paterno');
        $funcionario->materno         = $request->input('materno');
        $funcionario->nombre          = $request->input('nombre');
        $funcionario->ci              = $request->input('ci');
        $funcionario->expedido         = $request->input('expedido');
        $funcionario->celular          = $request->input('celular');
        $funcionario->email            = $request->input('email');
        $funcionario->cargo            = $request->input('cargo');
        $funcionario->dependencia_id   = $request->input('dependencia_id');

        $funcionario->save();

        /*
        |--------------------------------------------------------------------------
        | CATÁLOGOS: CREAR OPCIONES "OTRO" SOLO CUANDO CORRESPONDA
        |--------------------------------------------------------------------------
        |
        | Formato:
        | campo_id => [valor_otro, campo_texto, modelo, columna]
        |
        */

        $catalogos = [

            // CASE
            'marcacase_id' => [
                'otroMarcacase', 'otra_marca',
                \App\Models\MarcaCase::class, 'marca'
            ],
            'colorcase_id' => [
                'otroColorcase', 'otro_color',
                \App\Models\ColorCase::class, 'color'
            ],

            // PROCESADOR
            'marcaprocesador_id' => [
                'otroMarcapro', 'otra_marca_procesador',
                \App\Models\MarcaProcesador::class, 'marca'
            ],
            'modeloprocesador_id' => [
                'otroModpro', 'otro_modelo_procesador',
                \App\Models\ModeloProcesador::class, 'modelo'
            ],
            'genprocesador_id' => [
                'otroGenpro', 'otra_generacion',
                \App\Models\GenProcesador::class, 'generacion'
            ],

            // TARJETA MADRE
            'marcatmadre_id' => [
                'otroMarcatm', 'otra_marcatm',
                \App\Models\MarcaTmadre::class, 'marca'
            ],
            'modtmadre_id' => [
                'otroModtm', 'otro_modtm',
                \App\Models\ModeloTmadre::class, 'modelo'
            ],

            // DISCO DURO
            'marcadisco_id' => [
                'otroMarcadisco', 'otra_marca_disco',
                \App\Models\MarcaDisco::class, 'marca'
            ],
            'capacdisco_id' => [
                'otroCapdisco', 'otra_capacidad_disco',
                \App\Models\CapacidadDisco::class, 'capacidad'
            ],
            'tipodisco_id' => [
                'otroTipodisco', 'otro_tipo_disco',
                \App\Models\TipoDisco::class, 'tipo'
            ],

            // RAM 1
            'marcaram_id' => [
                'otroMarcaram', 'otra_marca_ram',
                \App\Models\MarcaRam::class, 'marca'
            ],
            'capacram_id' => [
                'otroCapram', 'otra_capacidad_ram',
                \App\Models\CapacidadRam::class, 'capacidad'
            ],
            'tiporam_id' => [
                'otroTiporam', 'otra_tipo_ram',
                \App\Models\TipoRam::class, 'tipo'
            ],

            // RAM 2
            'marcaram2_id' => [
                'otroMarcaram2', 'otra_marca_ram2',
                \App\Models\MarcaRam::class, 'marca'
            ],
            'capacram2_id' => [
                'otroCapram2', 'otra_capacidad_ram2',
                \App\Models\CapacidadRam::class, 'capacidad'
            ],
            'tiporam2_id' => [
                'otroTiporam2', 'otra_tipo_ram2',
                \App\Models\TipoRam::class, 'tipo'
            ],

            // RAM 3
            'marcaram3_id' => [
                'otroMarcaram3', 'otra_marca_ram3',
                \App\Models\MarcaRam::class, 'marca'
            ],
            'capacram3_id' => [
                'otroCapram3', 'otra_capacidad_ram3',
                \App\Models\CapacidadRam::class, 'capacidad'
            ],
            'tiporam3_id' => [
                'otroTiporam3', 'otra_tipo_ram3',
                \App\Models\TipoRam::class, 'tipo'
            ],

            // RAM 4
            'marcaram4_id' => [
                'otroMarcaram4', 'otra_marca_ram4',
                \App\Models\MarcaRam::class, 'marca'
            ],
            'capacram4_id' => [
                'otroCapram4', 'otra_capacidad_ram4',
                \App\Models\CapacidadRam::class, 'capacidad'
            ],
            'tiporam4_id' => [
                'otroTiporam4', 'otra_tipo_ram4',
                \App\Models\TipoRam::class, 'tipo'
            ],

            // TARJETA DE VIDEO
            'marcatvideo_id' => [
                'otroMarcatv', 'otra_marca_tvideo',
                \App\Models\MarcaTvideo::class, 'marca'
            ],
            'capactvideo_id' => [
                'otroCaptv', 'otra_capacidad_tvideo',
                \App\Models\CapacidadTvideo::class, 'capacidad'
            ],

            // TARJETA DE RED
            'marcatred_id' => [
                'otroMarcatred', 'otra_marca_tred',
                \App\Models\MarcaTred::class, 'marca'
            ],
            'modtred_id' => [
                'otroModtred', 'otro_modelo_tred',
                \App\Models\ModeloTred::class, 'modelo'
            ],

            // WIFI
            'marcawifi_id' => [
                'otroMarcawifi', 'otra_marca_wifi',
                \App\Models\MarcaTwifi::class, 'marca'
            ],
            'modcawifi_id' => [
                'otroModwifi', 'otra_modelo_wifi',
                \App\Models\ModeloWifi::class, 'modelo'
            ],

            // FUENTE DE PODER
            'marcafuente_id' => [
                'otroMarcafuente', 'otra_marca_fuente',
                \App\Models\MarcaFuente::class, 'marca'
            ],
            'potfuente_id' => [
                'otroPotenciafuente', 'otra_potencia_fuente',
                \App\Models\PotenciaFuente::class, 'potencia'
            ],

            // LECTOR CD/DVD
            'marcacd_id' => [
                'otroMarcacd', 'otro_marca_cd',
                \App\Models\MarcaLectorcd::class, 'nombre'
            ],
        ];

        foreach ($catalogos as $campoId => $configuracion) {
            [
                $valorOtro,
                $campoTexto,
                $modelo,
                $columna
            ] = $configuracion;

            if ($request->input($campoId) !== $valorOtro) {
                continue;
            }

            $texto = trim((string) $request->input($campoTexto));

            $id = $texto !== ''
                ? $modelo::create([$columna => $texto])->id
                : null;

            $request->merge([
                $campoId => $id,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REGISTRO CPU
        |--------------------------------------------------------------------------
        */
        $registroCpu = new RegistroCpu();

        $registroCpu->funcionario_id = $funcionario->id;
        $registroCpu->dependencia_id = $request->input('dependencia_id');
        $registroCpu->cargo          = $request->input('cargo');
        $registroCpu->fecha          = $request->input('fecha');
        $registroCpu->fecha_inicio   = $request->input('fecha_inicio');
        $registroCpu->cod_gamea      = $request->input('cod_gamea');

        // Generar el número de recepción una sola vez.
        $registroCpu->cod_registro =
            $correlativoService->generarNumeroRecepcion();

        $registroCpu->usuario    = $request->input('usuario');
        $registroCpu->contrasena = $request->input('contrasena');

        /*
         * Campos de los componentes.
         * Se conservan los nombres originales de las columnas.
         */
        $camposComponentes = [
            'marcacase_id',
            'colorcase_id',
            'marcaprocesador_id',
            'modeloprocesador_id',
            'genprocesador_id',
            'marcatmadre_id',
            'modtmadre_id',
            'marcadisco_id',
            'capacdisco_id',
            'tipodisco_id',
            'disipador_id',

            // RAM 1
            'marcaram_id',
            'tiporam_id',
            'capacram_id',
            'cantidad_id',

            // Tarjeta de video
            'marcatvideo_id',
            'capactvideo_id',
            'tipotvideo_id',

            // Tarjeta de red y WiFi
            'marcatred_id',
            'modtred_id',
            'marcawifi_id',
            'modcawifi_id',

            // Fuente y lector
            'marcafuente_id',
            'potfuente_id',
            'marcacd_id',

            // RAM 2
            'marcaram2_id',
            'disipador2_id',
            'capacram2_id',
            'tiporam2_id',
            'cantidad2_id',

            // RAM 3
            'marcaram3_id',
            'disipador3_id',
            'capacram3_id',
            'tiporam3_id',
            'cantidad3_id',

            // RAM 4
            'marcaram4_id',
            'disipador4_id',
            'capacram4_id',
            'tiporam4_id',
            'cantidad4_id',

            // Otros componentes
            'cable_id',
            'antena_id',
        ];

        foreach ($camposComponentes as $campo) {
            $registroCpu->{$campo} = $request->input($campo);
        }

        /*
         * Información del registro.
         */
        $registroCpu->falla              = $request->input('falla');
        $registroCpu->respaldo           = $request->input('respaldo');
        $registroCpu->observaciones      = $request->input('observaciones');
        $registroCpu->funcionario_activo = $request->input('funcionario_activo');
        $registroCpu->otro               = $request->input('otro');
        $registroCpu->condiciones        = $request->input('condiciones');
        $registroCpu->estado_id          = $request->input('estado_id');
        $registroCpu->user_id             = $request->input('user_id');

        // El modelo RegistroCpu ya asigna reguser_id en su evento creating.
        $registroCpu->save();

        return $registroCpu;
    }, 3);

    /*
    |--------------------------------------------------------------------------
    | REDIRECCIÓN
    |--------------------------------------------------------------------------
    */
    return Redirect::route('registro-cpus.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'Número de recepción: ' . $registroCpu->cod_registro)
        ->with('icono', 'success');
}

// NUMERO CORRELATIVO
    private function generarNumeroRecepcion()
{
    $anio = now()->year;

    $correlativo = Correlativo::where('anio', $anio)
        ->lockForUpdate()
        ->first();

    if (!$correlativo) {

        $correlativo = Correlativo::create([
            'anio' => $anio,
            'ultimo_numero' => 0,
        ]);
    }

    $correlativo->increment('ultimo_numero');

    return str_pad(
        $correlativo->ultimo_numero,
        3,
        '0',
        STR_PAD_LEFT
    ) . '/' . $anio;
}

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $registroCpu = RegistroCpu::find($id);

        return view('registro-cpu.show', compact('registroCpu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $registroCpu = RegistroCpu::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($registroCpu->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $registroCpu->funcionario_id = $funcionarioExistente->id;
        } else {
            // Si no existe o es el mismo, actualiza el funcionario
            if(empty($request->input('cargo'))){
            $request->merge(['cargo' => 'EX FUNCIONARIO']);
            }
            $funcionario->grado_academico = $request->input('grado_academico');
            $funcionario->paterno = $request->input('paterno');
            $funcionario->materno = $request->input('materno');
            $funcionario->nombre = $request->input('nombre');
            $funcionario->ci = $request->input('ci');
            $funcionario->expedido = $request->input('expedido');
            $funcionario->celular = $request->input('celular');
            $funcionario->cargo = $request->input('cargo');
            $funcionario->email = $request->input('email');            
            $funcionario->dependencia_id = $request->input('dependencia_id');
            $funcionario->save();
            $registroCpu->funcionario_id = $funcionario->id;
        }

        $registroCpu->dependencia_id = $request->input('dependencia_id');
        $registroCpu->marcacase_id = $request->input('marcacase_id');
        $registroCpu->colorcase_id = $request->input('colorcase_id');
        $registroCpu->marcaprocesador_id = $request->input('marcaprocesador_id');
        $registroCpu->modeloprocesador_id = $request->input('modeloprocesador_id');
        $registroCpu->genprocesador_id = $request->input('genprocesador_id');
        $registroCpu->marcatmadre_id = $request->input('marcatmadre_id');
        $registroCpu->modtmadre_id = $request->input('modtmadre_id');
        $registroCpu->marcadisco_id = $request->input('marcadisco_id');
        $registroCpu->capacdisco_id = $request->input('capacdisco_id');
        $registroCpu->tipodisco_id = $request->input('tipodisco_id');
        $registroCpu->marcadisco2_id = $request->input('marcadisco2_id');
        $registroCpu->capacdisco2_id = $request->input('capacdisco2_id');
        $registroCpu->tipodisco2_id = $request->input('tipodisco2_id');
        $registroCpu->disipador_id = $request->input('disipador_id');
        $registroCpu->marcaram_id = $request->input('marcaram_id');
        $registroCpu->tiporam_id = $request->input('tiporam_id');
        $registroCpu->capacram_id = $request->input('capacram_id');
        $registroCpu->cantidad_id = $request->input('cantidad_id');
        $registroCpu->marcatvideo_id = $request->input('marcatvideo_id');
        $registroCpu->capactvideo_id = $request->input('capactvideo_id');
        $registroCpu->tipotvideo_id = $request->input('tipotvideo_id');
        $registroCpu->marcatred_id = $request->input('marcatred_id');
        $registroCpu->modtred_id = $request->input('modtred_id');
        $registroCpu->marcawifi_id = $request->input('marcawifi_id');
        $registroCpu->modcawifi_id = $request->input('modcawifi_id');
        $registroCpu->marcafuente_id = $request->input('marcafuente_id');
        $registroCpu->potfuente_id = $request->input('potfuente_id');
        $registroCpu->marcacd_id = $request->input('marcacd_id');
        $registroCpu->marcaram2_id = $request->input('marcaram2_id');
        $registroCpu->disipador2_id = $request->input('disipador2_id');
        $registroCpu->capacram2_id = $request->input('capacram2_id');
        $registroCpu->tiporam2_id = $request->input('tiporam2_id');
        $registroCpu->cantidad2_id = $request->input('cantidad2_id');
        $registroCpu->marcaram3_id = $request->input('marcaram3_id');
        $registroCpu->disipador3_id = $request->input('disipador3_id');
        $registroCpu->capacram3_id = $request->input('capacram3_id');
        $registroCpu->tiporam3_id = $request->input('tiporam3_id');
        $registroCpu->cantidad3_id = $request->input('cantidad3_id');
        $registroCpu->marcaram4_id = $request->input('marcaram4_id');
        $registroCpu->disipador4_id = $request->input('disipador4_id');
        $registroCpu->capacram4_id = $request->input('capacram4_id');
        $registroCpu->tiporam4_id = $request->input('tiporam4_id');
        $registroCpu->cantidad4_id = $request->input('cantidad4_id');
        $registroCpu->cable_id = $request->input('cable_id');
        $registroCpu->antena_id = $request->input('antena_id');
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'respaldo' => 'required|string',
            ]);

        $registroCpu->fecha = $request->input('fecha');
        $registroCpu->cargo = $request->input('cargo');
        $registroCpu->cod_gamea = $request->input('cod_gamea');
        $registroCpu->cod_registro = $request->input('cod_registro');
        $registroCpu->usuario = $request->input('usuario');
        $registroCpu->contrasena = $request->input('contrasena');
        $registroCpu->fecha_asignacion = $request->input('fecha_asignacion');
        $registroCpu->fecha_inicio = $request->input('fecha_inicio');
        $registroCpu->falla = $request->input('falla');
        $registroCpu->respaldo = $validatedData['respaldo'];
        $registroCpu->observaciones = $request->input('observaciones');
        $registroCpu->funcionario_activo = $request->input('funcionario_activo');
        $registroCpu->otro = $request->input('otro');
        $registroCpu->estado_id = $request->input('estado_id');
        $registroCpu->user_id = $request->input('user_id') ?: null;

        $registroCpu->save();
        return Redirect::route('registro-cpus.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE.')
        ->with('icono', 'success'); 
    }

    public function destroy($id): RedirectResponse
    {
        RegistroCpu::find($id)->delete();
        return Redirect::route('registro-cpus.index')
        ->with('success', 'ELIMINADO CON EXITO')         
        ->with('icono', 'success');
    }

    public function generarPdf($id)
    {
        $registroCpu = RegistroCpu::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $registroCpu->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('registro-cpu.pdf', compact('registroCpu'))->render();
        $pdf->writeHTML($html);

        
         // codigo qr
        $style = array(
            //'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, 
            'module_width' => 1, 
            'module_height' => 1,
            'font_size' =>9,
        );
 if ($registroCpu->funcionario_activo == 1) {

    $datos = $registroCpu->funcionario?->grado_academico . ' ' .
             $registroCpu->funcionario?->nombre . ' ' .
             $registroCpu->funcionario?->paterno . ' ' .
             $registroCpu->funcionario?->materno .
             ' - ' .
             $registroCpu->funcionario?->ci . ' ' .
             $registroCpu->funcionario?->expedido .
             ' - ' .
             ($registroCpu->dependencia?->dependencias ?? 'SIN DEPENDENCIA') .
             ' - SOPORTE TECNICO-GAMEA';

} else {

    $datos = $registroCpu->funcionario?->grado_academico . ' ' .
             $registroCpu->funcionario?->nombre . ' ' .
             $registroCpu->funcionario?->paterno . ' ' .
             $registroCpu->funcionario?->materno .
             ' - ' .
             $registroCpu->funcionario?->ci . ' ' .
             $registroCpu->funcionario?->expedido .
             ' - ' .
             ($registroCpu->funcionario?->cargo ?? 'SIN CARGO') .
             ' - SOPORTE TECNICO-GAMEA';
}

$datos1 = trim(
    ($registroCpu->funcionario?->grado_academico ?? '') . ' ' .
    ($registroCpu->funcionario?->nombre ?? '') . ' ' .
    ($registroCpu->funcionario?->paterno ?? '') . ' ' .
    ($registroCpu->funcionario?->materno ?? '')
);

$datos2 = ($registroCpu->funcionario?->ci ?? '') . ' ' .
          ($registroCpu->funcionario?->expedido ?? '');

$datos3 = $registroCpu->funcionario?->cargo ?? 'SIN CARGO';

$datos4 = $registroCpu->dependencia?->dependencias ?? 'SIN DEPENDENCIA';

$pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');

$pdf->SetFont('helvetica', '', 8);

$pdf->SetY(-50);

$pdf->Cell(0, 4, $datos1, 0, 1, 'C');
$pdf->Cell(0, 4, $datos2, 0, 1, 'C');
$pdf->Cell(0, 4, $datos3, 0, 1, 'C');
$pdf->MultiCell(0, 4, $datos4, 0, 'C', false, 1);

$pdfContent = $pdf->Output('registro-cpu.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Cpu.pdf"');
        
    }

// DATOS PARA EL ENVIO DE FORMULARIO
    private function armarDataregistroCpu($equipo)
{
    return [
        'registroCpu' => $equipo,
        'qr' => $this->armarQrregistroCpu($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrregistroCpu($equipo)
{
    if ($equipo->funcionario_activo == 1) {
        return $this->nombreCompleto($equipo) . ' - ' .
               $this->ciCompleto($equipo) . ' - ' .
               ($equipo->dependencia?->dependencias ?? '') .
               ' - SOPORTE TECNICO-GAMEA';
    }

    return $this->nombreCompleto($equipo) . ' - ' .
           $this->ciCompleto($equipo) . ' - ' .
           ($equipo->funcionario?->cargo ?? '') .
           ' - SOPORTE TECNICO-GAMEA';
}

private function nombreCompleto($equipo)
{
    return trim(
        ($equipo->funcionario?->grado_academico ?? '') . ' ' .
        ($equipo->funcionario?->nombre ?? '') . ' ' .
        ($equipo->funcionario?->paterno ?? '') . ' ' .
        ($equipo->funcionario?->materno ?? '')
    );
}

private function ciCompleto($equipo)
{
    return trim(
        ($equipo->funcionario?->ci ?? '') . ' ' .
        ($equipo->funcionario?->expedido ?? '')
    );
}
/**
     * 1. PREVISUALIZACION
     */
public function preview($id, EquipoPdfService $service)
{
    $equipo = RegistroCpu::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataregistroCpu($equipo);

    $pdf = $service->generar($data, 'cpu.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="Cpu.pdf"');
}
    /**
     * 2. DESCARGA 
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = RegistroCpu::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataregistroCpu($equipo);

    $pdf = $service->generar($data, 'registro-cpu.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="CPU.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = RegistroCpu::with([
        'funcionario',
        'dependencia'
    ])->findOrFail($id);

    $data = $this->armarDataregistroCpu($equipo);

    $pdf = $service->generar($data, 'registro-cpu.pdf');

    $correo = $this->obtenerCorreoDestino($equipo);

    if (!$correo) {
        return response()->json([
            'success' => false,
            'message' => 'El funcionario no tiene correo registrado'
        ], 422);
    }

    // Nombre temporal del PDF
    $nombreArchivo = 'documentos/registro_cpu_' . $equipo->id . '_' . time() . '.pdf';

    // Guardar PDF temporalmente
    Storage::disk('local')->put($nombreArchivo, $pdf);

    // Enviar a la cola solamente la ruta del archivo
    Mail::to($correo)
        ->queue(new EquipoPdfEnviado(
            Storage::disk('local')->path($nombreArchivo)
        ));

    return response()->json([
        'success' => true,
        'message' => 'Formulario enviado correctamente'
    ]);
}

    /**
     * Método auxiliar
     */
    private function obtenerCorreoDestino($registroCpu)
    {
        return $registroCpu->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================

public function cambiarEstado(Request $request)
{
    $cpu = RegistroCpu::findOrFail($request->id);

    $estadoId = (int) $request->input('estado_id');

    // =========================
    // ACTUALIZAR ESTADO
    // =========================
    $cpu->estado_id = $estadoId;

    $fechas = [
        2 => 'fecha_inicio',
        5 => 'fecha_entrega',
    ];

    if (isset($fechas[$estadoId])) {

        $campoFecha = $fechas[$estadoId];

        if (empty($cpu->$campoFecha)) {
            $cpu->$campoFecha = now();
        }
    }

    $cpu->save();

    // =========================
    // TIPO DE EQUIPO
    // =========================
    $nombreEquipo = 'CPU';

    // =========================
    // ENVÍO DE NOTIFICACIÓN
    // =========================
    if (in_array($estadoId, [3, 4])) {

        $this->notificacionService->enviar(
            $cpu->funcionario,
            $estadoId,
            $cpu,
            $nombreEquipo
        );
    }

    // =========================
    // RESPUESTA
    // =========================
    return response()->json([
        'estado' => $estadoId == 5
            ? $cpu->resultado?->nombre
            : $cpu->estado?->nombre
    ]);
}
    //numero de recepcion
    public function updateRecepcion(Request $request, $id){
    $request->validate([
        'cod_registro' => [
            'nullable',
            function ($attribute, $value, $fail) {

                if (empty($value)) {
                    return;
                }

                $anio = date('Y');

                $tablas = [
                    'registro_cpus'   => 'CPU',
                    'monitors'        => 'Monitor',
                    'impresoras'      => 'Impresora',
                    'laptops'         => 'Laptop',
                    'teclados'        => 'Teclado',
                    'ratons'          => 'Mouse',
                    'upeses'          => 'regi$registroCpu',
                    'parlantes'       => 'Parlante',
                    'registroCpus'       => 'Audífono',
                    'estabilizadors'  => 'Estabilizador',
                ];

                foreach ($tablas as $tabla => $nombre) {

                    $existe = DB::table($tabla)
                        ->where('cod_registro', $value)
                        ->whereYear('created_at', $anio)
                        ->exists();

                    if ($existe) {
                        $fail("El número de recepción ya está asignado a un {$nombre} en la gestión actual.");
                        return;
                    }
                }
            },
        ],
    ]);
        $cpu = RegistroCpu::find($id);
        $cpu->cod_registro = $request->input('cod_registro');
        $cpu->update();
        return Redirect::route('registro-cpus.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE') 
        ->with('text', 'Numero de recepción')          
        ->with('icono', 'success');
    }

    public function updateTecnico(Request $request, $id){
    
    $equipo = RegistroCpu::findOrFail($id);
    $equipo->user_id = $request->input('user_id');
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');
    $equipo->save();

    //obtener usuario (técnico)
    $user = $equipo->user;

    // 📧 enviar correo
    if ($user?->email) {
        Mail::to($user->email)
            ->queue(new TecnicoAsignado($equipo, $user));
    }

    return Redirect::route('registro-cpus.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   
    }

    public function updateFecha(Request $request, $id){
        $cpu = RegistroCpu::find($id);
        $cpu->fecha = $request->input('fecha');
        $cpu->boton_oculto = true;
        $cpu->update();
        return Redirect::route('registro-cpus.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $cpu = RegistroCpu::whereBetween('fecha', [$start_date, $end_date])
        ->get();
        if ($cpu->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.cpu.resFechaCpu', compact('cpu', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $cpu = RegistroCpu::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.cpu.pdfFechaCpu', compact('cpu','start_date', 'end_date'));
        return $pdf->stream('cpu.pdf');
        //'landscape'
    }

    public function searchCpu(Request $request)
    {
        $query = $request->input('query');
        
        $cpu = RegistroCpu::where('cod_gamea', 'LIKE', "$query")
        ->get();
        $estado=Estado::all()->except(6);
        if ($cpu->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.cpu.resCpu', compact('cpu','query','estado'));
        }
    
    }

    public function pdfCpu(Request $request)
    {

        $query = $request->input('query');
        $cpu = RegistroCpu::where('cod_gamea', 'LIKE', $query )
        ->get();
         $estado=Estado::all()->except(6);
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.cpu.pdfCpu', compact('cpu','query', 'estado'));
        return $pdf->stream('cpu.pdf');
    }

    public function searchYearCpu(Request $request)
    {
        $query = $request->input('query');
        
        $cpu = RegistroCpu::whereYear('created_at', $query)->get();
         $estado=Estado::all()->except(6);

        if ($cpu->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.cpu.resYearCpu', compact('cpu','query', 'estado'));
        }
    
    }

    public function pdfYearCpu(Request $request)
    {

        $query = $request->input('query');
        $cpu = RegistroCpu::whereYear('created_at', $query)->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.cpu.pdfYearCpu', compact('cpu','query'));
        return $pdf->stream('cpu.pdf');
    }

public function buscaCpu(Request $request) {
    $query = $request->input('query');
    $datos = RegistroCpu::where('cod_gamea', 'LIKE',$query)
     ->orderBy('id', 'desc') // o created_at
    ->with('marcacase', 'colorcase', 'marcaprocesador', 'modeloprocesador', 'genprocesador','marcadisco', 'capacidaddisco', 'tipodisco',
     'marcatmadre', 'disipadorram', 'marcaram', 'capacidadram', 'tiporam', 'cantidadram', 'marcatvideo', 'capacidadtvideo', 'tipotvideo',
      'marcatred', 'modelotred', 'marcatwifi', 'disipadorram2', 'marcaram2', 'capacidadram2', 'tiporam2', 'cantidadram2', 'disipadorram3',
       'marcaram3', 'capacidadram3', 'tiporam3', 'cantidadram3', 'disipadorram4', 'marcaram4', 'capacidadram4', 'tiporam4', 'cantidadram4','marcafuente', 'potenciafuente', 'marcalectorcd', 'modelotmadre', 'modelowifi', 'cable', 'antena')
    ->get();
    return response()->json($datos);

    }

public function guardar(Request $request, string $tipo, int $id)
{
    $request->validate([
        'detalle_trabajo' => 'required|string|min:3',
        'resultado_id' => 'required|integer|in:1,2,3,4,5',
    ]);

    $modelos = [
        'audifono' => Audifono::class,
        'cpu' => RegistroCpu::class,
        'estabilizador' => Estabilizador::class,
        'impresora' => Impresora::class,
        'laptop' => Laptop::class,
        'ups' => Upese::class,
        'parlante' => Parlante::class,
        'teclado' => Teclado::class,
        'mouse' => Raton::class,
        'monitor' => Monitor::class,
        'otro' => OtrosEquipo::class,
    ];

    abort_unless(
        isset($modelos[$tipo]),
        404,
        'Tipo de equipo no válido.'
    );

    $modelo = $modelos[$tipo];

    $equipo = $modelo::findOrFail($id);

    $equipo->detalle_trabajo = $request->detalle_trabajo;
    $equipo->resultado_id = $request->resultado_id;
    $equipo->save();

    return redirect()->back()
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'El detalle del trabajo y el resultado se guardaron correctamente.')
        ->with('icono', 'success');
}

}