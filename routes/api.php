<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveysController;
use Illuminate\Support\Facades\Route;

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

// Rutas públicas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas públicas de surveys (sin autenticación)
Route::get('/surveys', [SurveysController::class, 'index']); // Lista pública
Route::get('/surveys/{id}', [SurveysController::class, 'show']); // Ver survey público

// Rutas protegidas que requieren autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);

    // Rutas de encuestas que requieren autenticación (crear, editar)
    Route::post('/surveys', [SurveysController::class, 'store']); // Crear survey
    Route::put('/surveys/{id}', [SurveysController::class, 'update']); // Editar survey
    Route::delete('/surveys/{id}', [SurveysController::class, 'destroy']); // Eliminar survey

    // Aquí puedes agregar más rutas protegidas
});
