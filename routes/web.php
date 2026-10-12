<?php

use App\Http\Controllers\AudifonoController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CantidadRamController;
use App\Http\Controllers\CapacidadDiscoController;
use App\Http\Controllers\CapacidadRamController;
use App\Http\Controllers\CapacidadTvideoController;
use App\Http\Controllers\ColorCaseController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\DisipadorRamController;
use App\Http\Controllers\EstabilizadorController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\EstadoUsuarioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\GenProcesadorController;
use App\Http\Controllers\ImpresoraController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\MarcaCaseController;
use App\Http\Controllers\MarcaDiscoController;
use App\Http\Controllers\MarcaFuenteController;
use App\Http\Controllers\MarcaLectorcdController;
use App\Http\Controllers\MarcaProcesadorController;
use App\Http\Controllers\MarcaRamController;
use App\Http\Controllers\MarcaTmadreController;
use App\Http\Controllers\MarcaTredController;
use App\Http\Controllers\MarcaTvideoController;
use App\Http\Controllers\MarcaTwifiController;
use App\Http\Controllers\ModelHasRoleController;
use App\Http\Controllers\ModeloDiscoController;
use App\Http\Controllers\ModeloProcesadorController;
use App\Http\Controllers\ModeloRamController;
use App\Http\Controllers\ModeloTmadreController;
use App\Http\Controllers\ModeloTredController;
use App\Http\Controllers\ModeloTvideoController;
use App\Http\Controllers\ModeloWifiController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ParlanteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PotenciaFuenteController;
use App\Http\Controllers\RegistroCpuController;
use App\Http\Controllers\TipoDiscoController;
use App\Http\Controllers\TipoTvideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatonController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleHasPermissionController;
use App\Http\Controllers\TecladoController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\TipoRamController;
use App\Http\Controllers\UpeseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\OtrosEquipoController;
use App\Http\Controllers\TiposEquipoController;
use App\Http\Controllers\EquipoController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TerminoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EspecialidadController;


use Illuminate\Support\Facades\Mail;

    /*
    |--------------------------------------------------------------------------
    | BUSCAR ACTIVOS DESDE SERVICIO
    |--------------------------------------------------------------------------
    */

Route::get('/configuracion/institucional', [ConfiguracionController::class, 'institucional'])->middleware('auth')->name('configuracion.institucional');
Route::post('/configuracion-correo/cambiar', [ConfiguracionController::class, 'cambiar'])->middleware('auth')->name('configuracion.correo.cambiar');
Route::get('/buscarActivo', [ServicioController::class, 'buscarActivo'])->name('servicios.buscarActivo');
Route::get('/buscarActivo', [ServicioController::class, 'buscarActivo'])->name('servicios.buscarActivo');

Route::get('/historial-equipo', [ServicioController::class, 'historialEquipo'])->name('servicios.historial')->middleware('auth');
Route::get('/historial-equipo/pdf', [ServicioController::class, 'historialEquipoPdf'])->name('servicios.historial.pdf')->middleware('auth');

Route::get('/', function () {
    return view('inicio.inicio');
});
Route::get('/', [InicioController::class, 'index']);
// routes/web.php

Route::get('/ingresar', function () {return view('auth.login');});
Route::get('/registrar', function () {return view('auth.register');});
Route::get('/reload-captcha', function () { return response()->json(['captcha' => captcha_img()]);});
Auth::routes();
Route::resource('servicios', ServicioController::class);
Route::post('/servicio/marcar-visto', [ServicioController::class, 'marcarVisto'])->name('servicio.marcarVisto')->middleware('auth');

Route::get('/hay-pendientes', function () {
    $usuario = auth()->user();
    /*
    |--------------------------------------------------------------------------
    | ADMINISTRADOR / SUPERADMINISTRADOR
    |--------------------------------------------------------------------------
    */

    if ($usuario->hasAnyRole([
        'Administrador',
        'SuperAdministrador'
    ])) {

        $servicio = \App\Models\Servicio::where('visto', 0)
            ->whereNull('user_id')
            ->latest('id')
            ->first();

        return response()->json([

            'hayPendientes' => $servicio !== null,

            'tipo' => 'nuevo_requerimiento',

            'id' => $servicio?->id,

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | TÉCNICO
    |--------------------------------------------------------------------------
    */

    if ($usuario->hasRole('Tecnico')) {

        $servicio = \App\Models\Servicio::where(
                'user_id',
                $usuario->id
            )
            ->whereNotNull('fecha_asignacion')
            ->latest('fecha_asignacion')
            ->first();

        return response()->json([
            'hayPendientes' => $servicio !== null,
            'tipo' => 'asignacion',
            'id' => $servicio?->id,
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | OTROS
    |--------------------------------------------------------------------------
    */
    return response()->json([
        'hayPendientes' => false,
        'tipo' => null,
        'id' => null,
    ]);

})->middleware('auth');

Route::resource('especialidades', EspecialidadController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('auth');

Route::get('/perfil', [UserController::class, 'show'])->name('perfil')->middleware('auth');

// --------------------TERMINOS---------------------------------------------------------------------------------
Route::get('/terminos/edit', [TerminoController::class, 'edit'])->name('terminos.edit');
Route::put('/terminos',[TerminoController::class, 'update'])->name('terminos.update');

// --------------------SOLICITUDES PARA DESCARGAR---------------------------------------------------------------------------------
Route::resource('documentos', DocumentoController::class);
Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');
Route::get('/documentos/create',[DocumentoController::class, 'create'])->name('documentos.create');
Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
Route::get('/documentos/{documento}/descargar', [DocumentoController::class, 'descargar'])->name('documentos.descargar');
Route::delete('/documentos/{documento}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');


// --------------------PARA SELECCIONAR EQUIPOS----------------------------------------------------------------------------------
Route::get('/otros-equipos/por-tipo/{tipo}', [OtrosEquipoController::class, 'porTipo'])->name('otros-equipos.porTipo');
Route::get('/otros-equipos/filtrar', [OtrosEquipoController::class, 'filtrar'])->name('otros-equipos.filtrar');
Route::get('/equipos/por-tipo/{tipo}',[OtrosEquipoController::class, 'porTipo'])->name('equipos.porTipo');

// --------------------REGISTRAR TIPO DE EQUIPO----------------------------------------------------------------------------------

Route::post('/tipos-equipos', [TiposEquipoController::class, 'store'])->name('tipos-equipos.store')->middleware('auth');

// --------------------PARA API REST-----------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('cpus', RegistroCpuController::class);});

// -----------------------------REPORTES DE ASIGANCIONES A TECNICOS--------------------------------------------------------------------------
Route::get('/asignaciones/{user}/pdf', [PanelController::class, 'reportePdf'])->name('admin.asignaciones.pdf');
Route::get('/asignaciones2/{user}/pdf', [PanelController::class, 'reportePdf2'])->name('admin.asignaciones2.pdf');
Route::get('/tecnicos/reporte-general',[TecnicoController::class, 'reporteGeneralPdf'])->name('tecnicos.reporteGeneral');

// --------------------------------------------------------------------------------------------------------
Route::get('/panel', [DashboardController::class, 'vistas'])->name('panel');

Route::resource('configuracions', ConfiguracionController::class)->middleware('auth');

Route::get('/buscarFuncionario',[App\Http\Controllers\FuncionarioController::class,'buscarFuncionario'])->name('buscarFuncionario');
Route::get('/buscarEquipo',[App\Http\Controllers\OtrosEquipoController::class,'buscarEquipo'])->name('buscarEquipo');
Route::get('/buscaMouse',[App\Http\Controllers\RatonController::class,'buscaMouse'])->name('buscaMouse');
Route::get('/buscaImpresora',[App\Http\Controllers\ImpresoraController::class,'buscaImpresora'])->name('buscaImpresora');
Route::get('/buscaTeclado',[App\Http\Controllers\TecladoController::class,'buscaTeclado'])->name('buscaTeclado');
Route::get('/buscaParlante',[App\Http\Controllers\ParlanteController::class,'buscaParlante'])->name('buscaParlante');
Route::get('/buscaAudifono',[App\Http\Controllers\AudifonoController::class,'buscaAudifono'])->name('buscaAudifono');
Route::get('/buscaMonitor',[App\Http\Controllers\MonitorController::class,'buscaMonitor'])->name('buscaMonitor');
Route::get('/buscaEstabilizador',[App\Http\Controllers\EstabilizadorController::class,'buscaEstabilizador'])->name('buscaEstabilizador');
Route::get('/buscaUps',[App\Http\Controllers\UpeseController::class,'buscaUps'])->name('buscaUps');
Route::get('/buscaLaptop',[App\Http\Controllers\LaptopController::class,'buscaLaptop'])->name('buscaLaptop');
Route::get('/buscaCpu',[App\Http\Controllers\RegistroCpuController::class,'buscaCpu'])->name('buscaCpu');



//-----------------------------------------------------------------------------

Route::post('/infresult/estabilizador/{id}', [InformesController::class, 'resultadoEstabilizador'])->name('resultado.estabilizador')->middleware('auth');

//---------------EVALUACION DE REQUERIMIENTOS DE SERVICIOS A UNIDADES--------------------
Route::get('/registrar/activos', [DashboardController::class, 'panelRegistro'])->name('registrar.activos')->middleware('auth');
Route::get('/evaluar', [TecnicoController::class, 'buscarEvaluacion'])->name('evaluacion.buscar');
Route::post('/evaluar', [TecnicoController::class, 'mostrarEvaluacion'])->name('evaluacion.mostrar');
Route::get('/evaluar/{id}', [TecnicoController::class, 'evaluar'])->name('asignacion.evaluar');
Route::post('/evaluar/guardar', [TecnicoController::class, 'guardarEvaluacion'])->name('evaluacion.guardar');



//---------------------------RUTAS PROTEGIDAS------------------------------------
Route::middleware(['auth', 'single.session'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/panel', [PanelController::class, 'panel'])->name('panel.panel');

Route::resource('responsables', ResponsableController::class)->middleware('auth');
Route::resource('funcionarios', FuncionarioController::class)->middleware('auth');
Route::resource('registros', RegistroController::class)->middleware('auth');
Route::resource('color-cases', ColorCaseController::class)->middleware('auth');
Route::resource('marca-cases', MarcaCaseController::class)->middleware('auth');
Route::resource('marca-procesadors', MarcaProcesadorController::class)->middleware('auth');
Route::resource('gen-procesadors', GenProcesadorController::class)->middleware('auth');
Route::resource('marca-tmadres', MarcaTmadreController::class)->middleware('auth');
Route::resource('modelo-discos', ModeloDiscoController::class)->middleware('auth');
Route::resource('marca-discos', MarcaDiscoController::class)->middleware('auth');
Route::resource('capacidad-discos', CapacidadDiscoController::class)->middleware('auth');
Route::resource('tipo-discos', TipoDiscoController::class)->middleware('auth');
Route::resource('marca-rams', MarcaRamController::class)->middleware('auth');
Route::resource('capacidad-rams', CapacidadRamController::class)->middleware('auth');
Route::resource('modelo-rams', ModeloRamController::class)->middleware('auth');
Route::resource('modelo-tvideos', ModeloTvideoController::class)->middleware('auth');
Route::resource('marca-tvideos', MarcaTvideoController::class)->middleware('auth');
Route::resource('tipo-tvideos', TipoTvideoController::class)->middleware('auth');
Route::resource('capacidad-tvideos', CapacidadTvideoController::class)->middleware('auth');
Route::resource('marca-treds', MarcaTredController::class)->middleware('auth');
Route::resource('modelo-treds', ModeloTredController::class)->middleware('auth');
Route::resource('marca-twifis', MarcaTwifiController::class)->middleware('auth');
Route::resource('modelo-wifis', ModeloWifiController::class)->middleware('auth');
Route::resource('marca-fuentes', MarcaFuenteController::class)->middleware('auth');
Route::resource('potencia-fuentes', PotenciaFuenteController::class)->middleware('auth');
Route::resource('dependencias', DependenciaController::class)->middleware('auth');
Route::resource('estados', EstadoController::class)->middleware('auth');
Route::resource('marca-lectorcds', MarcaLectorcdController::class)->middleware('auth');
Route::resource('modelo-procesadors', ModeloProcesadorController::class)->middleware('auth');
Route::resource('modelo-tmadres', ModeloTmadreController::class)->middleware('auth');
Route::resource('registro-cpus', RegistroCpuController::class)->middleware('auth');
Route::resource('impresoras', ImpresoraController::class)->middleware('auth');
Route::resource('monitors', MonitorController::class)->middleware('auth');
Route::resource('estabilizadors', EstabilizadorController::class)->middleware('auth');
Route::resource('teclados', TecladoController::class)->middleware('auth');
Route::resource('ratons', RatonController::class)->middleware('auth');
Route::resource('upeses', UpeseController::class)->middleware('auth');
Route::resource('parlantes', ParlanteController::class)->middleware('auth');
Route::resource('audifonos', AudifonoController::class)->middleware('auth');
Route::resource('laptops', LaptopController::class)->middleware('auth');
Route::resource('disipador-rams', DisipadorRamController::class);
Route::resource('cantidad-rams', CantidadRamController::class);
Route::resource('tipo-rams', TipoRamController::class);
Route::resource('resultados', ResultadoController::class);

//---------------------------------
Route::resource('otros-equipos', OtrosEquipoController::class)->middleware('auth');
Route::resource('tipos-equipos', TiposEquipoController::class)->middleware('auth');

//---------------------------------ASIGNACIONES DE ASITENCIA TECNICA-----------
Route::get('/asignaciones/asistencia', [TecnicoController::class, 'asignacionesAsistencia'])->name('asignaciones.asistencia')->middleware('auth');
Route::put('/asignacion/{id}/atender', [ServicioController::class, 'atender'])->name('asignacion.atender')->middleware('auth');

Route::get('/asignaciones-asistencia/reporte-pdf',[TecnicoController::class, 'reporteAsistenciaPdf'])->name('servicios.asignaciones.reporte.pdf');


//---------------ASIGNACIONES A TECNICOS--------------------
Route::get('/asignaciones/impresora', [DashboardController::class, 'asignacionesImpresora'])->name('asignaciones.impresora')->middleware('auth');
Route::get('/asignaciones/cpu', [DashboardController::class, 'asignacionesCpu'])->name('asignaciones.cpu')->middleware('auth');
Route::get('/asignaciones/teclado', [DashboardController::class, 'asignacionesTeclado'])->name('asignaciones.teclado')->middleware('auth');
Route::get('/asignaciones/mouse', [DashboardController::class, 'asignacionesMouse'])->name('asignaciones.mouse')->middleware('auth');
Route::get('/asignaciones/parlante', [DashboardController::class, 'asignacionesParlante'])->name('asignaciones.parlante')->middleware('auth');
Route::get('/asignaciones/audifono', [DashboardController::class, 'asignacionesAudifono'])->name('asignaciones.audifono')->middleware('auth');
Route::get('/asignaciones/monitor', [DashboardController::class, 'asignacionesMonitor'])->name('asignaciones.monitor')->middleware('auth');
Route::get('/asignaciones/estabilizador', [DashboardController::class, 'asignacionesEstabilizador'])->name('asignaciones.estabilizador')->middleware('auth');
Route::get('/asignaciones/ups', [DashboardController::class, 'asignacionesUps'])->name('asignaciones.ups')->middleware('auth');
Route::get('/asignaciones/laptop', [DashboardController::class, 'asignacionesLaptop'])->name('asignaciones.laptop')->middleware('auth');
Route::get('/asignaciones/equipos', [DashboardController::class, 'asignacionesEquipos'])->name('asignaciones.Equipos')->middleware('auth');


//------------------VER ASIGNACIONES A TECNICOS------------------------------------
Route::get('/admin/registro/{id}', [TecnicoController::class, 'panelRegistros'])->name('admin.registro')->middleware('auth');
Route::get('/admin/verTecnico/{id}', [TecnicoController::class, 'tecnicoPanel'])->name('admin.verTecnico')->middleware('auth');
Route::get('/admin/asigTeclado/{id}', [TecnicoController::class, 'tecnicoTeclado'])->name('admin.asigTeclado')->middleware('auth');
Route::get('/admin/asigAudifono/{id}', [TecnicoController::class, 'tecnicoAudifono'])->name('admin.asigAudifono')->middleware('auth');
Route::get('/admin/asigImpresora/{id}', [TecnicoController::class, 'tecnicoImpresora'])->name('admin.asigImpresora')->middleware('auth');
Route::get('/admin/asigCpu/{id}', [TecnicoController::class, 'tecnicoCpu'])->name('admin.asigCpu')->middleware('auth');
Route::get('/admin/asigMouse/{id}', [TecnicoController::class, 'tecnicoMouse'])->name('admin.asigMouse')->middleware('auth');
Route::get('/admin/asigParlante/{id}', [TecnicoController::class, 'tecnicoParlante'])->name('admin.asigParlante')->middleware('auth');
Route::get('/admin/asigMonitor/{id}', [TecnicoController::class, 'tecnicoMonitor'])->name('admin.asigMonitor')->middleware('auth');
Route::get('/admin/asigEstabilizador/{id}', [TecnicoController::class, 'tecnicoEstabilizador'])->name('admin.asigEstabilizador')->middleware('auth');
Route::get('/admin/asigUps/{id}', [TecnicoController::class, 'tecnicoUps'])->name('admin.asigUps')->middleware('auth');
Route::get('/admin/asigLaptop/{id}', [TecnicoController::class, 'tecnicoLaptop'])->name('admin.asigLaptop')->middleware('auth');


//------------------CREAR INFORMES WORD------------------------------------
Route::get('/informe/equipo/{id}', [InformesController::class, 'crearInformeEquipo'])->name('informe.equipo')->middleware('auth');
Route::get('/informe/cpu/{id}', [InformesController::class, 'crearInformeCpu'])->name('informe.cpu')->middleware('auth');
Route::get('/informe/impresora/{id}', [InformesController::class, 'crearInformeImpresora'])->name('informe.impresora')->middleware('auth');
Route::get('/informe/audifono/{id}', [InformesController::class, 'crearInformeAudifono'])->name('informe.audifono')->middleware('auth');
Route::get('/informe/teclado/{id}', [InformesController::class, 'crearInformeTeclado'])->name('informe.teclado')->middleware('auth');
Route::get('/informe/mouse/{id}', [InformesController::class, 'crearInformeMouse'])->name('informe.mouse')->middleware('auth');
Route::get('/informe/parlante/{id}', [InformesController::class, 'crearInformeParlante'])->name('informe.parlante')->middleware('auth');
Route::get('/informe/monitor/{id}', [InformesController::class, 'crearInformeMonitor'])->name('informe.monitor')->middleware('auth');
Route::get('/informe/estabilizador/{id}', [InformesController::class, 'crearInformeEstabilizador'])->name('informe.estabilizador')->middleware('auth');
Route::get('/informe/ups/{id}', [InformesController::class, 'crearInformeUps'])->name('informe.ups')->middleware('auth');
Route::get('/informe/laptop/{id}', [InformesController::class, 'crearInformeLaptop'])->name('informe.laptop')->middleware('auth');
Route::post('/informe/descargar/{id}', [InformesController::class, 'descargarInforme'])->name('informe.descargar')->middleware('auth');


//---------------ESTADISTICAS--------------------
Route::get('/estadistica',[PanelController::class,'index'])->name('estadistica')->middleware('auth');
Route::get('/estadistica/tecnico',[PanelController::class,'estadisticaTecnico1'])->name('estadistica.tecnico')->middleware('auth');
Route::get('/admin/TecnicoEstadistica/{id}', [TecnicoController::class, 'tecnicoEstadistica'])->name('admin.TecnicoEstadistica')->middleware('auth');
Route::get('/resultado',[PanelController::class,'resultado'])->name('resultado')->middleware('auth');
Route::get('/resultado/tecnico',[PanelController::class,'resultadoTecnico1'])->name('resultado.tecnico')->middleware('auth');
Route::get('/admin/TecnicoResultado/{id}', [TecnicoController::class, 'tecnicoResultado'])->name('admin.TecnicoResultado')->middleware('auth');

//---------------ROLES  Y PERMISOS--------------------

Route::resource('roles', RoleController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('permissions', PermissionController::class)->middleware('auth');
Route::resource('role-has-permissions', RoleHasPermissionController::class)->middleware('auth');
Route::resource('model-has-roles', ModelHasRoleController::class)->middleware('auth');
Route::resource('estado-usuarios', EstadoUsuarioController::class)->middleware('auth');
Route::patch('/user/{id}', [App\Http\Controllers\UserController::class,'updatePassword'])->name('user.pass')->middleware('auth');
// ----------- ESTADOS DE USUARIOS -------------------
Route::post('/estado-usuario',[App\Http\Controllers\UserController::class,'cambiarEstado'])->name('estado-usuario')->middleware('auth');
Route::post('/usuario/cambiar-password', [UserController::class, 'cambiarPassword'])->middleware('auth')->name('usuario.cambiar.password');

//-------------------BACKUP DB---------------------------------------

Route::get('/backup', [BackupController::class, 'backup'])->name('backup')->middleware('auth');
Route::get('/backupSuccess', [BackupController::class, 'backupSuccess'])->name('backup.success')->middleware('auth');

// ---------------------TECNICOS---------------------------------------
Route::resource('tecnicos', TecnicoController::class)->middleware('auth');
Route::post('/estado-tecnico',[App\Http\Controllers\TecnicoController::class,'cambiarEstado'])->name('estado.tecnico')->middleware('auth');
Route::patch('/tecnico/{id}', [App\Http\Controllers\TecnicoController::class,'updatePassword'])->name('tecnico.pass')->middleware('auth');

//-------------------------REPORTES SERVICIOS----------------------------------------------------
Route::patch('/password/update', [UserController::class, 'ActualizarPassword'])->name('usuario.password.update')->middleware('auth');
Route::get('/servicio/reporte-pdf', [ServicioController::class, 'reporteServicioPdf'])->name('servicio.reporte.pdf')->middleware('auth');


// ---------------------MODAL ASIGNAR -----------------------
Route::patch('/audifono/{id}', [App\Http\Controllers\AudifonoController::class,'updateRecepcion'])->name('audi.recepcion')->middleware('auth');
Route::patch('/audifonoT/{id}', [App\Http\Controllers\AudifonoController::class,'updateTecnico'])->name('audi.tecnico')->middleware('auth');
Route::patch('/estabilizador/{id}', [App\Http\Controllers\EstabilizadorController::class,'updateRecepcion'])->name('estabilizador.recepcion')->middleware('auth');
Route::patch('/estabilizadorT/{id}', [App\Http\Controllers\EstabilizadorController::class,'updateTecnico'])->name('estabilizador.tecnico')->middleware('auth');
Route::patch('/impresora/{id}', [App\Http\Controllers\ImpresoraController::class,'updateRecepcion'])->name('impresora.recepcion')->middleware('auth');
Route::patch('/impresoraT/{id}', [App\Http\Controllers\ImpresoraController::class,'updateTecnico'])->name('impresora.tecnico')->middleware('auth');
Route::patch('/monitor/{id}', [App\Http\Controllers\MonitorController::class,'updateRecepcion'])->name('monitor.recepcion')->middleware('auth');
Route::patch('/monitorT/{id}', [App\Http\Controllers\MonitorController::class,'updateTecnico'])->name('monitor.tecnico')->middleware('auth');
Route::patch('/parlante/{id}', [App\Http\Controllers\ParlanteController::class,'updateRecepcion'])->name('parlante.recepcion')->middleware('auth');
Route::patch('/parlanteT/{id}', [App\Http\Controllers\ParlanteController::class,'updateTecnico'])->name('parlante.tecnico')->middleware('auth');
Route::patch('/mouse/{id}', [App\Http\Controllers\RatonController::class,'updateRecepcion'])->name('mouse.recepcion')->middleware('auth');
Route::patch('/mouseT/{id}', [App\Http\Controllers\RatonController::class,'updateTecnico'])->name('mouse.tecnico')->middleware('auth');
Route::patch('/cpu/{id}', [App\Http\Controllers\RegistroCpuController::class,'updateRecepcion'])->name('cpu.recepcion')->middleware('auth');
Route::patch('/cpuT/{id}', [App\Http\Controllers\RegistroCpuController::class,'updateTecnico'])->name('cpu.tecnico')->middleware('auth');
Route::patch('/teclado/{id}', [App\Http\Controllers\TecladoController::class,'updateRecepcion'])->name('teclado.recepcion')->middleware('auth');
Route::patch('/tecladoT/{id}', [App\Http\Controllers\TecladoController::class,'updateTecnico'])->name('teclado.tecnico')->middleware('auth');
Route::patch('/ups/{id}', [App\Http\Controllers\UpeseController::class,'updateRecepcion'])->name('ups.recepcion')->middleware('auth');
Route::patch('/upsT/{id}', [App\Http\Controllers\UpeseController::class,'updateTecnico'])->name('ups.tecnico')->middleware('auth');
Route::patch('/laptop/{id}', [App\Http\Controllers\LaptopController::class,'updateRecepcion'])->name('laptop.recepcion')->middleware('auth');
Route::patch('/laptopT/{id}', [App\Http\Controllers\LaptopController::class,'updateTecnico'])->name('laptop.tecnico')->middleware('auth');
Route::patch('/equipoT/{id}', [App\Http\Controllers\OtrosEquipoController::class,'updateTecnico'])->name('equipo.tecnico')->middleware('auth');
Route::patch('/servicioT/{id}', [App\Http\Controllers\ServicioController::class,'updateTecnico'])->name('servicio.tecnico')->middleware('auth');


// ----------- ESTADOS DE PROCESOS -------------------
Route::post('/estado-equipo',[App\Http\Controllers\OtrosEquipoController::class,'cambiarEstado'])->name('estado-equipo')->middleware('auth');
Route::post('/estado-audifono',[App\Http\Controllers\AudifonoController::class,'cambiarEstado'])->name('estado-audifono')->middleware('auth');
Route::post('/estado-impresora',[App\Http\Controllers\ImpresoraController::class,'cambiarEstado'])->name('estado-impresora')->middleware('auth');
Route::post('/estado-teclado',[App\Http\Controllers\TecladoController::class,'cambiarEstado'])->name('estado-teclado')->middleware('auth');
Route::post('/estado-monitor',[App\Http\Controllers\MonitorController::class,'cambiarEstado'])->name('estado-monitor')->middleware('auth');
Route::post('/estado-estabilizador',[App\Http\Controllers\EstabilizadorController::class,'cambiarEstado'])->name('estado-estabilizador')->middleware('auth');
Route::post('/estado-parlante',[App\Http\Controllers\ParlanteController::class,'cambiarEstado'])->name('estado-parlante')->middleware('auth');
Route::post('/estado-mouse',[App\Http\Controllers\RatonController::class,'cambiarEstado'])->name('estado-mouse')->middleware('auth');
Route::post('/estado-ups',[App\Http\Controllers\UpeseController::class,'cambiarEstado'])->name('estado-ups')->middleware('auth');
Route::post('/estado-cpu',[App\Http\Controllers\RegistroCpuController::class,'cambiarEstado'])->name('estado-cpu')->middleware('auth');
Route::post('/estado-laptop',[App\Http\Controllers\LaptopController::class,'cambiarEstado'])->name('estado-laptop')->middleware('auth');

// ----------------REPORTES EQUIPOS----------
Route::get('/equipos/reporte', [EquipoController::class, 'reporte'])->name('equipos.reporte')->middleware('auth');
Route::get('/equipos/reporte/pdf', [EquipoController::class, 'reportePdf'])->name('equipos.reporte.pdf')->middleware('auth');

// ----------------REPORTES----------

Route::get('/repYear-equipo',[App\Http\Controllers\OtrosEquipoController::class,'searchYearEquipo'])->name('repyear.equipo')->middleware('auth');
Route::get('/searchEquipo', [App\Http\Controllers\OtrosEquipoController::class,'searchEquipo'])->name('search.Equipo');
Route::get('/repFecha-equipo',[App\Http\Controllers\OtrosEquipoController::class,'search'])->name('repFecha.equipo')->middleware('auth');
Route::get('/pdfEquipos',[App\Http\Controllers\OtrosEquipoController::class,'pdfEquipo'])->name('pdf.Equipos')->middleware('auth');
Route::get('/pdfFechaEquipo',[App\Http\Controllers\OtrosEquipoController::class,'fechaPdf'])->name('pdf.fechaequipo')->middleware('auth');
Route::get('/pdfYearEquipo',[App\Http\Controllers\OtrosEquipoController::class,'pdfEquipoYear'])->name('pdf.Yearequipo')->middleware('auth');


Route::get('/reportes', function () {return view('reportes.reporte');})->name('reportes')->middleware('auth');
Route::get('/reportes',[App\Http\Controllers\DashboardController::class,'reportes'])->name('reportes')->middleware('auth');
Route::get('/repFecha-audifono',[App\Http\Controllers\AudifonoController::class,'search'])->name('repFecha.audifono')->middleware('auth');
Route::get('/pdfFechaAudifono',[App\Http\Controllers\AudifonoController::class,'fechaPdf'])->name('pdf.fechaaudifono')->middleware('auth');
Route::get('/repYear-audifono',[App\Http\Controllers\AudifonoController::class,'searchAudifonoYear'])->name('repyear.audifono')->middleware('auth');
Route::get('/pdfYearAudifono',[App\Http\Controllers\AudifonoController::class,'pdfAudifonoYear'])->name('pdf.Yearaudifono')->middleware('auth');
Route::get('/searchAudifono', [App\Http\Controllers\AudifonoController::class,'searchAudifono'])->name('search.Audifono');
Route::get('/pdfAudifonos',[App\Http\Controllers\AudifonoController::class,'pdfAudifono'])->name('pdf.Audifonos')->middleware('auth');
Route::get('/repFecha-cpu',[App\Http\Controllers\RegistroCpuController::class,'search'])->name('repFecha.cpu')->middleware('auth');
Route::get('/pdfFechaCpu',[App\Http\Controllers\RegistroCpuController::class,'fechaPdf'])->name('pdf.fechacpu')->middleware('auth');
Route::get('/searchCpu', [App\Http\Controllers\RegistroCpuController::class,'searchCpu'])->name('search.Cpu');
Route::get('/pdfCpu',[App\Http\Controllers\RegistroCpuController::class,'pdfCpu'])->name('pdf.Cpu')->middleware('auth');
Route::get('/searchYearCpu', [App\Http\Controllers\RegistroCpuController::class,'searchYearCpu'])->name('search.YearCpu');
Route::get('/pdfYearCpu',[App\Http\Controllers\RegistroCpuController::class,'pdfYearCpu'])->name('pdf.YearCpu')->middleware('auth');
Route::get('/repFecha-impresora',[App\Http\Controllers\ImpresoraController::class,'search'])->name('repFecha.impresora')->middleware('auth');
Route::get('/pdfFechaImpresora',[App\Http\Controllers\ImpresoraController::class,'fechaPdf'])->name('pdf.fechaimpresora')->middleware('auth');
Route::get('/searchImpresora', [App\Http\Controllers\ImpresoraController::class,'searchImpresora'])->name('search.Impresora');
Route::get('/pdfImpresora',[App\Http\Controllers\ImpresoraController::class,'pdfImpresora'])->name('pdf.Impresora')->middleware('auth');
Route::get('/searchYearImpresora', [App\Http\Controllers\ImpresoraController::class,'searchYearImpresora'])->name('search.YearImpresora');
Route::get('/pdfYearImpresora',[App\Http\Controllers\ImpresoraController::class,'pdfYearImpresora'])->name('pdf.YearImpresora')->middleware('auth');
Route::get('/repFecha-teclado',[App\Http\Controllers\TecladoController::class,'search'])->name('repFecha.teclado')->middleware('auth');
Route::get('/pdfFechaTeclado',[App\Http\Controllers\TecladoController::class,'fechaPdf'])->name('pdf.fechateclado')->middleware('auth');
Route::get('/searchTeclado', [App\Http\Controllers\TecladoController::class,'searchTeclado'])->name('search.Teclado');
Route::get('/pdfTeclado',[App\Http\Controllers\TecladoController::class,'pdfTeclado'])->name('pdf.Teclado')->middleware('auth');
Route::get('/searchYearTeclado', [App\Http\Controllers\TecladoController::class,'searchYearTeclado'])->name('search.YearTeclado');
Route::get('/pdfYearTeclado',[App\Http\Controllers\TecladoController::class,'pdfYearTeclado'])->name('pdf.YearTeclado')->middleware('auth');
Route::get('/repFecha-mouse',[App\Http\Controllers\RatonController::class,'search'])->name('repFecha.mouse')->middleware('auth');
Route::get('/pdfFechaMouse',[App\Http\Controllers\RatonController::class,'fechaPdf'])->name('pdf.fechamouse')->middleware('auth');
Route::get('/searchMouse', [App\Http\Controllers\RatonController::class,'searchMouse'])->name('search.Mouse');
Route::get('/pdfMouse',[App\Http\Controllers\RatonController::class,'pdfMouse'])->name('pdf.Mouse')->middleware('auth');
Route::get('/searchYearMouse', [App\Http\Controllers\RatonController::class,'searchYearMouse'])->name('search.YearMouse');
Route::get('/pdfYearMouse',[App\Http\Controllers\RatonController::class,'pdfYearMouse'])->name('pdf.YearMouse')->middleware('auth');
Route::get('/repFecha-parlante',[App\Http\Controllers\ParlanteController::class,'search'])->name('repFecha.parlante')->middleware('auth');
Route::get('/pdfFechaParlante',[App\Http\Controllers\ParlanteController::class,'fechaPdf'])->name('pdf.fechaparlante')->middleware('auth');
Route::get('/searchParlante', [App\Http\Controllers\ParlanteController::class,'searchParlante'])->name('search.Parlante');
Route::get('/pdfParlante',[App\Http\Controllers\ParlanteController::class,'pdfParlante'])->name('pdf.Parlante')->middleware('auth');
Route::get('/searchYearParlante', [App\Http\Controllers\ParlanteController::class,'searchYearParlante'])->name('search.YearParlante');
Route::get('/pdfYearParlante',[App\Http\Controllers\ParlanteController::class,'pdfYearParlante'])->name('pdf.YearParlante')->middleware('auth');
Route::get('/repFecha-monitor',[App\Http\Controllers\MonitorController::class,'search'])->name('repFecha.monitor')->middleware('auth');
Route::get('/pdfFechaMonitor',[App\Http\Controllers\MonitorController::class,'fechaPdf'])->name('pdf.fechmonitor')->middleware('auth');
Route::get('/searchMonitor', [App\Http\Controllers\MonitorController::class,'searchMonitor'])->name('search.Monitor');
Route::get('/pdfMonitor',[App\Http\Controllers\MonitorController::class,'pdfMonitor'])->name('pdf.Monitor')->middleware('auth');
Route::get('/searchYearMonitor', [App\Http\Controllers\MonitorController::class,'searchYearMonitor'])->name('search.YearMonitor');
Route::get('/pdfYearMonitor',[App\Http\Controllers\MonitorController::class,'pdfYearMonitor'])->name('pdf.YearMonitor')->middleware('auth');
Route::get('/repFecha-estabilizador',[App\Http\Controllers\EstabilizadorController::class,'search'])->name('repFecha.estabilizador')->middleware('auth');
Route::get('/pdfFechaEstabilizador',[App\Http\Controllers\EstabilizadorController::class,'fechaPdf'])->name('pdf.fechaestabilizador')->middleware('auth');
Route::get('/searchEstabilizador', [App\Http\Controllers\EstabilizadorController::class,'searchEstabilizador'])->name('search.Estabilizador');
Route::get('/pdfEstabilizador',[App\Http\Controllers\EstabilizadorController::class,'pdfEstabilizador'])->name('pdf.Estabilizador')->middleware('auth');
Route::get('/searchYearEstabilizador', [App\Http\Controllers\EstabilizadorController::class,'searchYearEstabilizador'])->name('search.YearEstabilizador');
Route::get('/pdfYearEstabilizador',[App\Http\Controllers\EstabilizadorController::class,'pdfYearEstabilizador'])->name('pdf.YearEstabilizador')->middleware('auth');
Route::get('/repFecha-ups',[App\Http\Controllers\UpeseController::class,'search'])->name('repFecha.ups')->middleware('auth');
Route::get('/pdfFechaUps',[App\Http\Controllers\UpeseController::class,'fechaPdf'])->name('pdf.fechaups')->middleware('auth');
Route::get('/searchUps', [App\Http\Controllers\UpeseController::class,'searchUps'])->name('search.Ups');
Route::get('/pdfUps',[App\Http\Controllers\UpeseController::class,'pdfUps'])->name('pdf.Ups')->middleware('auth');
Route::get('/searchYearUps', [App\Http\Controllers\UpeseController::class,'searchYearUps'])->name('search.YearUps');
Route::get('/pdfYearUps',[App\Http\Controllers\UpeseController::class,'pdfYearUps'])->name('pdf.YearUps')->middleware('auth');
Route::get('/repFecha-laptop',[App\Http\Controllers\LaptopController::class,'search'])->name('repFecha.laptop')->middleware('auth');
Route::get('/pdfFechaLaptop',[App\Http\Controllers\LaptopController::class,'fechaPdf'])->name('pdf.fechalaptop')->middleware('auth');
Route::get('/searchLaptop', [App\Http\Controllers\LaptopController::class,'searchLaptop'])->name('search.Laptop');
Route::get('/pdfLaptop',[App\Http\Controllers\LaptopController::class,'pdfLaptop'])->name('pdf.Laptop')->middleware('auth');
Route::get('/searchYearLaptop', [App\Http\Controllers\LaptopController::class,'searchYearLaptop'])->name('search.YearLaptop');
Route::get('/pdfYearLaptop',[App\Http\Controllers\LaptopController::class,'pdfYearLaptop'])->name('pdf.YearLaptop')->middleware('auth');

Route::get('/manual-usuario', [DashboardController::class, 'manual'])->name('manual.usuario')->middleware('auth');
});

// ------------------SEGUIMIENTO DE EQUIPO-----------------------
Route::get('/seguimiento', [SeguimientoController::class, 'buscar'])->name('seguimiento.buscar');

// ----------------------FORMULARIO PDF-------------------

Route::get('/resultado/reporte-pdf',[PanelController::class, 'resultadoPdf'])->name('resultado.reporte.pdf');


Route::get('pdf/equipo/{id}', [App\Http\Controllers\OtrosEquipoController::class, 'generarPdf'])->name('pdf.equipo.preview');
Route::get('/pdf/equipo/{id}/descargar', [OtrosEquipoController::class, 'descargar'])->name('pdf.equipo.descargar');
Route::post('/pdf/equipo/{id}/enviar', [OtrosEquipoController::class, 'enviar'])->name('pdf.equipo.enviar');

Route::get('pdf/audifono/{id}', [App\Http\Controllers\AudifonoController::class, 'generarPdf'])->name('pdf.audifono.preview');
Route::get('/pdf/audifono/{id}/descargar', [AudifonoController::class, 'descargar'])->name('pdf.audifono.descargar');
Route::post('/pdf/audifono/{id}/enviar', [AudifonoController::class, 'enviar'])->name('pdf.audifono.enviar');
Route::get('pdf/estabilizador/{id}', [App\Http\Controllers\EstabilizadorController::class, 'generarPdf'])->name('pdf.estabilizador.preview');
Route::get('/pdf/estabilizador/{id}/descargar', [EstabilizadorController::class, 'descargar'])->name('pdf.estabilizador.descargar');
Route::post('/pdf/estabilizador/{id}/enviar', [EstabilizadorController::class, 'enviar'])->name('pdf.estabilizador.enviar');
Route::get('pdf/impresora/{id}', [App\Http\Controllers\ImpresoraController::class, 'generarPdf'])->name('pdf.impresora.preview');
Route::get('/pdf/impresora/{id}/descargar', [ImpresoraController::class, 'descargar'])->name('pdf.impresora.descargar');
Route::post('/pdf/impresora/{id}/enviar', [ImpresoraController::class, 'enviar'])->name('pdf.impresora.enviar');
Route::get('pdf/cpu/{id}', [App\Http\Controllers\RegistroCpuController::class, 'generarPdf'])->name('pdf.cpu.preview');
Route::get('/pdf/cpu/{id}/descargar', [RegistroCpuController::class, 'descargar'])->name('pdf.cpu.descargar');
Route::post('/pdf/cpu/{id}/enviar', [RegistroCpuController::class, 'enviar'])->name('pdf.cpu.enviar');
Route::get('pdf/laptop/{id}', [App\Http\Controllers\LaptopController::class, 'generarPdf'])->name('pdf.laptop.preview');
Route::get('/pdf/laptop/{id}/descargar', [LaptopController::class, 'descargar'])->name('pdf.laptop.descargar');
Route::post('/pdf/laptop/{id}/enviar', [LaptopController::class, 'enviar'])->name('pdf.laptop.enviar');
Route::get('pdf/monitor/{id}', [App\Http\Controllers\MonitorController::class, 'generarPdf'])->name('pdf.monitor.preview');
Route::get('/pdf/monitor/{id}/descargar', [MonitorController::class, 'descargar'])->name('pdf.monitor.descargar');
Route::post('/pdf/monitor/{id}/enviar', [MonitorController::class, 'enviar'])->name('pdf.monitor.enviar');
Route::get('pdf/ups/{id}', [App\Http\Controllers\UpeseController::class, 'generarPdf'])->name('pdf.ups.preview');
Route::get('/pdf/ups/{id}/descargar', [UpeseController::class, 'descargar'])->name('pdf.ups.descargar');
Route::post('/pdf/ups/{id}/enviar', [UpeseController::class, 'enviar'])->name('pdf.ups.enviar');
Route::get('pdf/teclado/{id}', [App\Http\Controllers\TecladoController::class, 'generarPdf'])->name('pdf.teclado.preview');
Route::get('/pdf/teclado/{id}/descargar', [TecladoController::class, 'descargar'])->name('pdf.teclado.descargar');
Route::post('/pdf/teclado/{id}/enviar', [TecladoController::class, 'enviar'])->name('pdf.teclado.enviar');
Route::get('pdf/mouse/{id}', [App\Http\Controllers\RatonController::class, 'generarPdf'])->name('pdf.mouse.preview');
Route::get('/pdf/mouse/{id}/descargar', [RatonController::class, 'descargar'])->name('pdf.mouse.descargar');
Route::post('/pdf/mouse/{id}/enviar', [RatonController::class, 'enviar'])->name('pdf.mouse.enviar');
Route::get('pdf/parlante/{id}', [App\Http\Controllers\ParlanteController::class, 'generarPdf'])->name('pdf.parlante.preview');
Route::get('/pdf/parlante/{id}/descargar', [ParlanteController::class, 'descargar'])->name('pdf.parlante.descargar');
Route::post('/pdf/parlante/{id}/enviar', [ParlanteController::class, 'enviar'])->name('pdf.parlante.enviar');


