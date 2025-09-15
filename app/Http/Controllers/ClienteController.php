<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clientes = Cliente::all();

            // Si es una petición AJAX (DataTable)
            if (request()->ajax()) {
                return response()->json([
                    'data' => $clientes->map(function ($cliente) {
                        return [
                            'id' => $cliente->id,
                            'rut_empresa' => $cliente->rut_empresa,
                            'razon_social' => $cliente->razon_social,
                            'rubro' => $cliente->rubro,
                            'telefono' => $cliente->telefono,
                            'email_contacto' => $cliente->email_contacto,
                            'created_at' => $cliente->created_at->format('d/m/Y'),
                            'actions' => '<div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="' . route('clientes.show', $cliente->id) . '">Ver</a></li>
                                    <li><a class="dropdown-item" href="' . route('clientes.edit', $cliente->id) . '">Editar</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="confirmarEliminacion(' . $cliente->id . ')">Eliminar</a></li>
                                </ul>
                            </div>'
                        ];
                    })
                ]);
            }

            return view('clientes.index', compact('clientes'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar clientes: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mapear nombres de campos de diferentes formularios
        $datos = [
            'rut_empresa' => $request->rut_empresa ?? $request->rut ?? null,
            'rubro' => $request->rubro ?? $request->giro ?? null,
            'razon_social' => $request->razon_social ?? null,
            'telefono' => $request->telefono ?? null,
            'direccion' => $request->direccion ?? null,
            'nombre_contacto' => $request->nombre_contacto ?? $request->contacto ?? null,
            'email_contacto' => $request->email_contacto ?? $request->email ?? null,
        ];

        try {
            // Validación básica
            if (empty($datos['rut_empresa'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'RUT Empresa es requerido');
            }

            if (empty($datos['razon_social'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Razón Social es requerida');
            }

            // Crear cliente directamente
            $cliente = new Cliente();
            $cliente->rut_empresa = $datos['rut_empresa'];
            $cliente->rubro = $datos['rubro'] ?? 'Sin especificar';
            $cliente->razon_social = $datos['razon_social'];
            $cliente->telefono = $datos['telefono'] ?? '';
            $cliente->direccion = $datos['direccion'] ?? '';
            $cliente->nombre_contacto = $datos['nombre_contacto'] ?? 'Sin especificar';
            $cliente->email_contacto = $datos['email_contacto'] ?? '';
            $cliente->save();

            return redirect()->route('clientes.index')
                ->with('success', 'Cliente creado exitosamente con ID: ' . $cliente->id);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear cliente: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return view('clientes.show', compact('cliente'));
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')
                ->with('error', 'Cliente no encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return view('clientes.edit', compact('cliente'));
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')
                ->with('error', 'Cliente no encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:12|unique:clientes,rut_empresa,' . $id,
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar cliente: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')
                ->with('error', 'Error al eliminar cliente: ' . $e->getMessage());
        }
    }
}
