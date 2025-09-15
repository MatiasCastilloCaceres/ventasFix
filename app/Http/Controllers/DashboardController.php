<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'products' => Producto::count(),
            'clients' => Cliente::count(),
            'api_calls' => 1247 // Simulado
        ];

        return view('dashboard', compact('stats'));
    }
}
