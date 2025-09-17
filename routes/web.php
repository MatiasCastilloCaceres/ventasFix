<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Rutas públicas para formularios externos
Route::get('/cliente-crear', [App\Http\Controllers\ClienteController::class, 'storeFromGet'])->name('cliente.crear.get');
Route::post('/clientes-create-external', [App\Http\Controllers\ClienteController::class, 'store'])->name('clientes.store.external');
Route::get('/clientes-lista', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.lista.publica');

Route::middleware('auth')->group(function () {
    // Rutas para gestión de usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas para gestión de productos
    Route::resource('productos', ProductController::class);

    // Rutas para gestión de clientes (requieren autenticación)
    Route::resource('clientes', ClienteController::class);
});

require __DIR__ . '/auth.php';
