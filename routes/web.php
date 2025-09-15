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

Route::middleware('auth')->group(function () {
    // Rutas para gestión de usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas para gestión de productos
    Route::resource('productos', ProductController::class);

    // Rutas para gestión de clientes
    Route::resource('clientes', ClienteController::class);
    
    // Ruta especial para crear cliente con GET (para formularios externos)
    Route::get('/clientes-create-get', [ClienteController::class, 'store'])->name('clientes.store.get');
});

require __DIR__ . '/auth.php';
