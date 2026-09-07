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
    $gestionPasada = date('Y') - 1;

    // Últimos 30 días de la gestión pasada
    $fechaFinPasada = Carbon::create($gestionPasada, 12, 31);
    $fechaInicioPasada = $fechaFinPasada->copy()->subDays(29);

    // Últimos 30 días gestión pasada OR registros de la gestión actual
    $registroCpus = RegistroCpu::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
                  ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();

    $catalogos = [
        'capdisco'        => CapacidadDisco::class,
        'capram'          => CapacidadRam::class,
        'captvideo'       => CapacidadTvideo::class,
        'colorcase'       => fn() => ColorCase::orderBy('color', 'asc')->get(),
        'dependencia'     => fn() => Dependencia::orderBy('dependencias', 'asc')->get(),
        'estado'          => Estado::class,
        'genprocesador'   => GenProcesador::class,
        'marcacase'       => fn() => MarcaCase::orderBy('marca', 'asc')->get(),
        'marcadisco'      => fn() => MarcaDisco::orderBy('marca', 'asc')->get(),
        'marcafuente'     => MarcaFuente::class,
        'marcalectorcd'   => MarcaLectorcd::class,
        'marcaprocesador' => MarcaProcesador::class,
        'marcaram'        => fn() => MarcaRam::orderBy('marca', 'asc')->get(),
        'marcatmadre'     => fn() => MarcaTmadre::orderBy('marca', 'asc')->get(),
        'modelotmadre'    => fn() => ModeloTmadre::orderBy('modelo', 'asc')->get(),
        'marcatred'       => fn() => MarcaTred::orderBy('marca', 'asc')->get(),
        'marcatvideo'     => fn() => MarcaTvideo::orderBy('marca', 'asc')->get(),
        'marcatwifi'      => fn() => MarcaTwifi::orderBy('marca', 'asc')->get(),
        'modelowifi'      => fn() => ModeloWifi::orderBy('modelo', 'asc')->get(),
        'disipadorram'    => DisipadorRam::class,
        'modprocesador'   => ModeloProcesador::class,
        'tiporam'         => TipoRam::class,
        'modelotred'      => fn() => ModeloTred::orderBy('modelo', 'asc')->get(),
        'cantidadram'     => CantidadRam::class,
        'potenciafuente'  => PotenciaFuente::class,
        'tipodisco'       => TipoDisco::class,
        'tipotvideo'      => TipoTvideo::class,
        'funcionario'     => Funcionario::class,
    ];

    // Obtener términos y condiciones
    $termino = Termino::first();

    $data = collect($catalogos)->mapWithKeys(function ($class, $key) {
        return [
            $key => is_callable($class)
                ? $class()
                : $class::all()
        ];
    });

    $data['users'] = User::whereHas('roles', fn($q) =>
            $q->where('name', 'Tecnico')
        )
        ->where('id_estadousuario', 1)
        ->orderBy('paterno', 'asc')
        ->get();

    $data['registroCpus'] = $registroCpus;

    // Enviar términos a la vista
    $data['termino'] = $termino;

    $data['i'] = ($request->input('page', 1) - 1)
        * $registroCpus->perPage();

    return view('registro-cpu.index', $data->all());
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CorrelativoService $correlativoService)
    {
    $request->validate([
        'ci'        => 'required',
        'celular'   => 'required|string',
        'email'   => 'required|string',
        'cod_gamea' => 'required|integer',
        'falla'     => 'required|string',
    ]);

    $funcionario = Funcionario::firstOrNew(['ci' => $request->ci]);

    // Si es nuevo: asignar todos los campos desde el request
        if (!$funcionario->exists) {
            if (empty($request->cargo)) {
                $funcionario->cargo = null;
                $funcionario->dependencia_id = null;
            }
            // CELULAR, EMAIL para NUEVO registro
            $funcionario->celular = $request->celular;
            $funcionario->email = $request->email;
        } else {
            // Si existe: actualizar celular, email si es q cambio de numero
            if ($funcionario->celular != $request->celular) {
                $funcionario->celular = $request->celular;
            }
            if ($funcionario->email != $request->email) {
                $funcionario->email = $request->email;
            }
        }
        // Asignar los valores de los campos
        $funcionario->grado_academico = $request->input('grado_academico');
        $funcionario->paterno = $request->input('paterno');
        $funcionario->materno = $request->input('materno');
        $funcionario->nombre = $request->input('nombre');
        $funcionario->ci = $request->input('ci');
        $funcionario->expedido = $request->input('expedido');
        $funcionario->celular = $request->input('celular');
        $funcionario->email = $request->input('email');
        $funcionario->cargo = $request->input('cargo');
        $funcionario->dependencia_id = $request->input('dependencia_id');
        // Guardar los cambios
        $funcionario->save();


    //  Case
    if ($request->marcacase_id == 'otroMarcacase' && $request->filled('otra_marca')) {
        $request->merge([
            'marcacase_id' => MarcaCase::create(['marca' => $request->otra_marca])->id
        ]);
    }
    if ($request->colorcase_id == 'otroColorcase' && $request->filled('otro_color')) {
        $request->merge([
            'colorcase_id' => ColorCase::create(['color' => $request->otro_color])->id
        ]);
    }

    //  Procesador
    if ($request->marcaprocesador_id == 'otroMarcapro' && $request->filled('otra_marca_procesador')) {
        $request->merge([
            'marcaprocesador_id' => MarcaProcesador::create(['marca' => $request->otra_marca_procesador])->id
        ]);
    }
    if ($request->modeloprocesador_id == 'otroModpro' && $request->filled('otro_modelo_procesador')) {
        $request->merge([
            'modeloprocesador_id' => ModeloProcesador::create(['modelo' => $request->otro_modelo_procesador])->id
        ]);
    }
    if ($request->genprocesador_id == 'otroGenpro' && $request->filled('otra_generacion')) {
        $request->merge([
            'genprocesador_id' => GenProcesador::create(['generacion' => $request->otra_generacion])->id
        ]);
    }
    //----------------------TARJETA MADRE--------------------------------
    if ($request->marcatmadre_id == 'otroMarcatm' && $request->filled('otra_marcatm')) {
        $request->merge([
            'marcatmadre_id' => MarcaTmadre::create(['marca' => $request->otra_marcatm])->id
        ]);
    }
    if ($request->modtmadre_id == 'otroModtm' && $request->filled('otro_modtm')) {
        $request->merge([
            'modtmadre_id' => ModeloTmadre::create(['modelo' => $request->otro_modtm])->id
        ]);
    }
    //-----------------DISCO DURO--------------------------
    if ($request->marcadisco_id == 'otroMarcadisco' && $request->filled('otra_marca_disco')) {
        $request->merge([
            'marcadisco_id' => MarcaDisco::create(['marca' => $request->otra_marca_disco])->id
        ]);
    }
    if ($request->capacdisco_id == 'otroCapdisco' && $request->filled('otra_capacidad_disco')) {
        $request->merge([
            'capacdisco_id' => CapacidadDisco::create(['capacidad' => $request->otra_capacidad_disco])->id
        ]);
    }
    if ($request->tipodisco_id == 'otroTipodisco' && $request->filled('otro_tipo_disco')) {
        $request->merge([
            'tipodisco_id' => TipoDisco::create(['tipo' => $request->otro_tipo_disco])->id
        ]);
    }
    //------------RAM 1--------------------
    if ($request->marcaram_id == 'otroMarcaram' && $request->filled('otra_marca_ram')) {
        $request->merge([
            'marcaram_id' => MarcaRam::create(['marca' => $request->otra_marca_ram])->id
        ]);
    }
    if ($request->capacram_id == 'otroCapram' && $request->filled('otra_capacidad_ram')) {
        $request->merge([
            'capacram_id' => CapacidadRam::create(['capacidad' => $request->otra_capacidad_ram])->id
        ]);
    }
    if ($request->tiporam_id == 'otroTiporam' && $request->filled('otra_tipo_ram')) {
        $request->merge([
            'tiporam_id' => TipoRam::create(['tipo' => $request->otra_tipo_ram])->id
        ]);
    }
    //------------RAM 2--------------------
    if ($request->marcaram2_id == 'otroMarcaram2' && $request->filled('otra_marca_ram2')) {
        $request->merge([
            'marcaram2_id' => MarcaRam::create(['marca' => $request->otra_marca_ram2])->id
        ]);
    }
    if ($request->capacram2_id == 'otroCapram2' && $request->filled('otra_capacidad_ram2')) {
        $request->merge([
            'capacram2_id' => CapacidadRam::create(['capacidad' => $request->otra_capacidad_ram2])->id
        ]);
    }
    if ($request->tiporam2_id == 'otroTiporam2' && $request->filled('otra_tipo_ram2')) {
        $request->merge([
            'tiporam2_id' => TipoRam::create(['tipo' => $request->otra_tipo_ram2])->id
        ]);
    }
    //------------RAM 3--------------------
    if ($request->marcaram3_id == 'otroMarcaram3' && $request->filled('otra_marca_ram3')) {
        $request->merge([
            'marcaram3_id' => MarcaRam::create(['marca' => $request->otra_marca_ram3])->id
        ]);
    }
    if ($request->capacram3_id == 'otroCapram3' && $request->filled('otra_capacidad_ram3')) {
        $request->merge([
            'capacram3_id' => CapacidadRam::create(['capacidad' => $request->otra_capacidad_ram3])->id
        ]);
    }
    if ($request->tiporam3_id == 'otroTiporam3' && $request->filled('otra_tipo_ram3')) {
        $request->merge([
            'tiporam3_id' => TipoRam::create(['tipo' => $request->otra_tipo_ram3])->id
        ]);
    }
    //------------RAM 4--------------------
    if ($request->marcaram4_id == 'otroMarcaram4' && $request->filled('otra_marca_ram4')) {
        $request->merge([
            'marcaram4_id' => MarcaRam::create(['marca' => $request->otra_marca_ram4])->id
        ]);
    }
    if ($request->capacram4_id == 'otroCapram4' && $request->filled('otra_capacidad_ram4')) {
        $request->merge([
            'capacram4_id' => CapacidadRam::create(['capacidad' => $request->otra_capacidad_ram4])->id
        ]);
    }
    if ($request->tiporam4_id == 'otroTiporam4' && $request->filled('otra_tipo_ram4')) {
        $request->merge([
            'tiporam4_id' => TipoRam::create(['tipo' => $request->otra_tipo_ram4])->id
        ]);
    }
    //------------TARJETA DE VIDEO--------------------
    if ($request->marcatvideo_id == 'otroMarcatv' && $request->filled('otra_marca_tvideo')) {
        $request->merge([
            'marcatvideo_id' => MarcaTvideo::create(['marca' => $request->otra_marca_tvideo])->id
        ]);
    }
    if ($request->capactvideo_id == 'otroCaptv' && $request->filled('otra_capacidad_tvideo')) {
        $request->merge([
            'capactvideo_id' => CapacidadTvideo::create(['capacidad' => $request->otra_capacidad_tvideo])->id
        ]);
    }

    //------------TARJETA DE RED--------------------
    if ($request->marcatred_id == 'otroMarcatred' && $request->filled('otra_marca_tred')) {
        $request->merge([
            'marcatred_id' => MarcaTred::create(['marca' => $request->otra_marca_tred])->id
        ]);
    }
    if ($request->modtred_id == 'otroModtred' && $request->filled('otro_modelo_tred')) {
        $request->merge([
            'modtred_id' => ModeloTred::create(['modelo' => $request->otro_modelo_tred])->id
        ]);
    }

    //------------TARJETA WIFI--------------------
    if ($request->marcawifi_id == 'otroMarcawifi' && $request->filled('otra_marca_wifi')) {
        $request->merge([
            'marcawifi_id' => MarcaTwifi::create(['marca' => $request->otra_marca_wifi])->id
        ]);
    }
    if ($request->modcawifi_id == 'otroModwifi' && $request->filled('otra_modelo_wifi')) {
        $request->merge([
            'modcawifi_id' => ModeloWifi::create(['modelo' => $request->otra_modelo_wifi])->id
        ]);
    }

    //------------FUENTE DE PODER--------------------
    if ($request->marcafuente_id == 'otroMarcafuente' && $request->filled('otra_marca_fuente')) {
        $request->merge([
            'marcafuente_id' => MarcaFuente::create(['marca' => $request->otra_marca_fuente])->id
        ]);
    }
    if ($request->potfuente_id == 'otroPotenciafuente' && $request->filled('otra_potencia_fuente')) {
        $request->merge([
            'potfuente_id' => PotenciaFuente::create(['potencia' => $request->otra_potencia_fuente])->id
        ]);
    }

    //------------LECTOR CD/DVD--------------------
    if ($request->marcacd_id == 'otroMarcacd' && $request->filled('otro_marca_cd')) {
        $request->merge([
            'marcacd_id' => MarcaLectorcd::create(['marca' => $request->otro_marca_cd])->id
        ]);
    }

    $registroCpu = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {
        $registroCpu = new RegistroCpu();
        $registroCpu->funcionario_id = $funcionario->id;
        $registroCpu->dependencia_id = $request->input('dependencia_id');
        $registroCpu->cargo = $request->input('cargo');
        $registroCpu->fecha = $request->input('fecha');
        $registroCpu->fecha_inicio = $request->input('fecha_inicio');
        $registroCpu->cod_gamea = $request->input('cod_gamea');
        $registroCpu->cod_registro = $request->input('cod_registro');
        $registroCpu->usuario = $request->input('usuario');
        $registroCpu->contrasena = $request->input('contrasena');
                // GENERAR CORRELATIVO
        $registroCpu->cod_registro = $correlativoService->generarNumeroRecepcion();

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

        $request->validate([
        'respaldo' => 'required|string',
        ]);
        $registroCpu->falla = $request->input('falla');
        $registroCpu->respaldo = $request->input('respaldo');
        $registroCpu->observaciones = $request->input('observaciones');
        $registroCpu->funcionario_activo = $request->input('funcionario_activo');
        $registroCpu->otro = $request->input('otro');
        $registroCpu->condiciones = $request->input('condiciones');
        $registroCpu->estado_id = $request->input('estado_id');
        $registroCpu->user_id = $request->input('user_id');
        $registroCpu->reguser_id = Auth::id();

        $registroCpu->save();
        return $registroCpu;
    });
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
        $pdf->Text(20, 205, '');
        $pdf->SetY(-60); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->MultiCell(0, 5, $datos4, 0, 'C', false, 1);

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
    $equipo = RegistroCpu::with(['funcionario', 'dependencia'])->findOrFail($id);
    $data = $this->armarDataregistroCpu($equipo);
    $pdf = $service->generar($data, 'registro-cpu.pdf');
    $correo = $this->obtenerCorreoDestino($equipo);
    if (!$correo) {
        return response()->json([
            'success' => false,
            'message' => 'El funcionario no tiene correo registrado'
        ], 422);
    }

    Mail::send('emails.equipo', [], function ($message) use ($pdf, $correo) {
        $message->to($correo)
            ->subject('Remisión del formulario de recepción correspondiente')
            ->attachData($pdf, 'documento.pdf', [
                'mime' => 'application/pdf',
            ]);
    });

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

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $cpu->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha
            if (empty($cpu->$campoFecha)) {
                $cpu->$campoFecha = now();
            }
        }

        $cpu->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [3, 4])) {

            $this->notificacionService->enviar(
                $cpu->funcionario,
                $estadoId,
                $cpu
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
            ->send(new TecnicoAsignado($equipo, $user));
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

}