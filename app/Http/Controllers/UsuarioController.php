<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index(Request $request)
    {
        try {
            $usuarios = $this->usuarioService->listarUsuarios($request->all());

            // Si es una petición AJAX (para DataTables), devolver JSON
            if ($request->ajax()) {
                return response()->json([
                    'data' => $usuarios->map(function ($usuario) {
                        return [
                            'id' => $usuario->id,
                            'name' => $usuario->name,
                            'email' => $usuario->email,
                            'created_at' => $usuario->created_at->format('d/m/Y'),
                            'actions' => '<div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="' . route('usuarios.show', $usuario->id) . '">Ver</a></li>
                                    <li><a class="dropdown-item" href="' . route('usuarios.edit', $usuario->id) . '">Editar</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="confirmarEliminacion(' . $usuario->id . ')">Eliminar</a></li>
                                </ul>
                            </div>'
                        ];
                    })
                ]);
            }

            return view('usuarios.index', compact('usuarios'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar usuarios: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|unique:users,rut',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $usuario = $this->usuarioService->crearUsuario($request->all());
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
            return view('usuarios.show', compact('usuario'));
        } catch (\Exception $e) {
            return back()->with('error', 'Usuario no encontrado');
        }
    }

    public function edit($id)
    {
        try {
            $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
            return view('usuarios.edit', compact('usuario'));
        } catch (\Exception $e) {
            return back()->with('error', 'Usuario no encontrado');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
            $this->usuarioService->actualizarUsuario($usuario, $request->all());
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar usuario: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
            $this->usuarioService->eliminarUsuario($usuario);
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('error', 'Error al eliminar usuario: ' . $e->getMessage());
        }
    }
}
