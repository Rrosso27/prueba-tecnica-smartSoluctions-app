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

// Rutas protegidas que requieren autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);

    // Rutas de encuestas protegidas
    Route::group(['prefix' => 'surveys'], function () {
        Route::get('/', [SurveysController::class, 'index']);
        Route::get('/{id}', [SurveysController::class, 'show']);
        Route::post('/', [SurveysController::class, 'store']);
        Route::put('/{id}', [SurveysController::class, 'update']);
        Route::delete('/{id}', [SurveysController::class, 'destroy']);
    });

    // Aquí puedes agregar más rutas protegidas
});
