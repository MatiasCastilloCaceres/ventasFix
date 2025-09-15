<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ClienteApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas API v1
Route::prefix('v1')->group(function () {
    // Rutas públicas para autenticación
    Route::post('/login', [UserApiController::class, 'login']);
    Route::post('/register', [UserApiController::class, 'register']);

    // Rutas protegidas con Sanctum o Auth Web
    Route::middleware(['auth:sanctum,web'])->group(function () {

        // Rutas para Usuarios
        Route::apiResource('usuarios', UserApiController::class);

        // Rutas para Productos
        Route::apiResource('productos', ProductApiController::class);

        // Rutas para Clientes
        Route::apiResource('clientes', ClienteApiController::class);

        // Ruta para logout
        Route::post('/logout', [UserApiController::class, 'logout']);
    });
});
