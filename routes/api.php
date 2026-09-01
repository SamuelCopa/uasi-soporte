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



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/impresoras', [ImpresoraController::class, 'index']);
    Route::get('/impresoras/{id}', [ImpresoraController::class, 'show']);

});



Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/audifonos', [ImpresoraController::class, 'index']);
    Route::get('/audifonos/{id}', [ImpresoraController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/estabilizadors', [EstabilizadorController::class, 'index']);
    Route::get('/estabilizadors/{id}', [EstabilizadorController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/laptops', [LaptopController::class, 'index']);
    Route::get('/laptops/{id}', [LaptopController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/monitors', [MonitorController::class, 'index']);
    Route::get('/monitors/{id}', [MonitorController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/ratons', [RatonController::class, 'index']);
    Route::get('/ratons/{id}', [RatonController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/teclados', [TecladoController::class, 'index']);
    Route::get('/teclados/{id}', [TecladoController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/parlantes', [ParlanteController::class, 'index']);
    Route::get('/parlantes/{id}', [ParlanteController::class, 'show']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/ups', [UpeseController::class, 'index']);
    Route::get('/ups/{id}', [UpeseController::class, 'show']);

});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/dependencias', [DependenciaController::class, 'index']);
    Route::get('/dependencias/{id}', [DependenciaController::class, 'show']);

});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/funcionarios', [FuncionarioController::class, 'index']);
    Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show']);

    // POST para registrar un funcionario

});
Route::middleware('api.token')->group(function () {

    Route::post('/funcionarios', [FuncionarioController::class,'store']);

});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usuario', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

});