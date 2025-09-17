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
        $request->validate([
            'rut_empresa' => 'required|string|max:12|unique:clientes,rut_empresa',
            'razon_social' => 'required|string|max:255',
            'rubro' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'nombre_contacto' => 'nullable|string|max:255',
            'email_contacto' => 'nullable|email|max:255',
        ]);

        try {
            $cliente = Cliente::create($request->all());

            return redirect()->route('clientes.index')
                ->with('success', 'Cliente creado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear cliente: ' . $e->getMessage());
        }
    }

    /**
     * Método especial para crear clientes desde formularios externos usando GET
     */
    public function storeFromGet(Request $request)
    {
        try {
            // Mapear parámetros GET a los campos correctos
            $datos = [
                'rut_empresa' => $request->rut ?? $request->rut_empresa ?? null,
                'razon_social' => $request->razon_social ?? null,
                'rubro' => $request->giro ?? $request->rubro ?? null,
                'telefono' => $request->telefono ?? null,
                'direccion' => $request->direccion ?? null,
                'nombre_contacto' => $request->contacto ?? $request->nombre_contacto ?? null,
                'email_contacto' => $request->email ?? $request->email_contacto ?? null,
            ];

            // Validación básica
            if (empty($datos['rut_empresa'])) {
                return response()->json(['error' => 'RUT empresa es requerido'], 400);
            }

            if (empty($datos['razon_social'])) {
                return response()->json(['error' => 'Razón social es requerida'], 400);
            }

            // Crear cliente
            $clienteData = [
                'rut_empresa' => $datos['rut_empresa'],
                'razon_social' => $datos['razon_social'],
                'rubro' => $datos['rubro'] ?? 'Sin especificar',
                'telefono' => $datos['telefono'] ?? '',
                'direccion' => $datos['direccion'] ?? '',
                'nombre_contacto' => $datos['nombre_contacto'] ?? '',
                'email_contacto' => $datos['email_contacto'] ?? '',
            ];

            $cliente = Cliente::create($clienteData);

            // Responder con JSON para formularios externos
            return response()->json([
                'success' => true,
                'message' => 'Cliente creado exitosamente',
                'id' => $cliente->id,
                'cliente' => $cliente
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al crear cliente: ' . $e->getMessage()
            ], 500);
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
