<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegistroCpuController;
use App\Http\Controllers\Api\ImpresoraController;
use App\Http\Controllers\Api\AudifonoController;
use App\Http\Controllers\Api\EstabilizadorController;
use App\Http\Controllers\Api\LaptopController;
use App\Http\Controllers\Api\TecladoController;
use App\Http\Controllers\Api\ParlanteController;
use App\Http\Controllers\Api\UpeseController;
use App\Http\Controllers\Api\MonitorController;
use App\Http\Controllers\Api\RatonController;
use App\Http\Controllers\Api\FuncionarioController;
use App\Http\Controllers\Api\DependenciaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConsultaEquiposController;
use App\Http\Controllers\Api\RegistroEquiposController;
use App\Http\Controllers\Api\PdfEquipoController;
use App\Http\Controllers\Api\AsignacionTecnicoController;
use App\Http\Controllers\Api\EstadoEquipoController;
use App\Http\Controllers\Api\NotificacionesDashboardController;


// Consultar usuario autenticado
Route::middleware('auth:sanctum')->get('/user',function (Request $request) {return $request->user();});

// Listar todos los equipos
Route::get('/equipos', [ConsultaEquiposController::class,'todos']);
// Consultar equipos por tipo de equipo
Route::middleware('auth:sanctum')->get('/equipos/{tipo}',[ConsultaEquiposController::class, 'index']);



// Registrar equipos genéricos
Route::middleware('auth:sanctum')->post('/equipos/{tipo}', [RegistroEquiposController::class, 'store']);
// {
//   "ci": "12345678",
//   "celular": "71234567",
//   "email": "funcionario@ejemplo.gob.bo",
//   "grado_academico": "LIC.",
//   "paterno": "MAMANI",
//   "materno": "QUISPE",
//   "nombre": "JUAN CARLOS",
//   "expedido": "LP",
//   "cargo": "ANALISTA",
//   "dependencia_id": 1,
//   "cod_gamea": 12345,
//   "marca": "EPSON",
//   "modelo": "EB-X06",
//   "falla": "El equipo no enciende",
//   "fecha": "2026-10-27",
//   "observaciones": "Equipo asignado a la unidad administrativa",
//   "funcionario_activo": true,
//   "estado_id": 1
// }
//Actualizar equipos genericos
Route::middleware('auth:sanctum')->patch('/equipos/{tipo}/{id}', [RegistroEquiposController::class,'update']);

// Registrar CPU
Route::post('/cpus',[RegistroCpuController::class, 'store'])->middleware('auth:sanctum');
// Actualizar CPU
Route::patch('/cpus/{id}',[RegistroCpuController::class, 'update'])->middleware('auth:sanctum');


//generar PDF DE formulario de RECEPCION 
Route::get('/equipos/{tipo}/{id}/pdf',[PdfEquipoController::class, 'generarPdf'])->name('equipos.pdf');
//asignar tecnico
Route::patch('/equipos/{tipo}/{id}/asignar-tecnico',[AsignacionTecnicoController::class, 'asignar'])->middleware('auth:sanctum');

//Cambio de estado
Route::post('/equipos/{tipo}/{id}/cambiar-estado', [EstadoEquipoController::class,'cambiarEstado'])->middleware('auth:sanctum');

//DASHBOARD
Route::get('/notificaciones/dashboard',[NotificacionesDashboardController::class, 'index'])->middleware('auth:sanctum');














//Route::get('/equipos/{tipo}/{id}/pdf', [PdfEquipoController::class,'generarPdf']);


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/cpus', [RegistroCpuController::class, 'index']);
    Route::get('/cpus/{id}', [RegistroCpuController::class, 'show']);

    Route::get('/audifono', [ImpresoraController::class, 'index']);
    Route::get('/audifono/{id}', [ImpresoraController::class, 'show']);

    Route::get('/impresora', [ImpresoraController::class, 'index']);
    Route::get('/impresora/{id}', [ImpresoraController::class, 'show']);

    Route::get('/estabilizador', [EstabilizadorController::class, 'index']);
    Route::get('/estabilizador/{id}', [EstabilizadorController::class, 'show']);

    Route::get('/laptop', [LaptopController::class, 'index']);
    Route::get('/laptop/{id}', [LaptopController::class, 'show']);

    Route::get('/monitor', [MonitorController::class, 'index']);
    Route::get('/monitor/{id}', [MonitorController::class, 'show']);

    Route::get('/raton', [RatonController::class, 'index']);
    Route::get('/raton/{id}', [RatonController::class, 'show']);

    Route::get('/teclado', [TecladoController::class, 'index']);
    Route::get('/teclado/{id}', [TecladoController::class, 'show']);

    Route::get('/parlante', [ParlanteController::class, 'index']);
    Route::get('/parlante/{id}', [ParlanteController::class, 'show']);

    Route::get('/ups', [UpeseController::class, 'index']);
    Route::get('/ups/{id}', [UpeseController::class, 'show']);

    Route::get('/dependencia', [DependenciaController::class, 'index']);
    Route::get('/dependencia/{id}', [DependenciaController::class, 'show']);

    Route::get('/funcionario', [FuncionarioController::class, 'index']);
    Route::get('/funcionario/{id}', [FuncionarioController::class, 'show']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);


});

//===================================================================================================================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});



Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



    // POST para registrar un funcionario

});

// Route::middleware('api.token')->group(function () {

    Route::post('/funcionarios', [FuncionarioController::class,'store']);

// });

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });



});