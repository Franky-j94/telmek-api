<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConfiguracionCargaController;
use App\Http\Controllers\Api\SolicitudesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/configuracion-carga', [ConfiguracionCargaController::class, 'index']);
    Route::post('/configuracion-carga', [ConfiguracionCargaController::class, 'add']);
    Route::put('/configuracion-carga/{id}', [ConfiguracionCargaController::class, 'upd']);
    Route::delete('/configuracion-carga/{id}', [ConfiguracionCargaController::class, 'deleted']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/solicitudes', [SolicitudesController::class, 'index']);
    Route::get('/solicitudes/users-ventas', [SolicitudesController::class, 'usersAsesorVentas']);
    Route::post('/solicitudes', [SolicitudesController::class, 'add']);
    Route::put('/solicitudes/{id}', [SolicitudesController::class, 'upd']);
    Route::delete('/solicitudes/cancelar/{id}', [SolicitudesController::class, 'cancelar']);
    Route::delete('/solicitudes/{id}', [SolicitudesController::class, 'deleted']);
});