<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    /**
     * Crear un nuevo usuario
     */
    public function crearUsuario(array $data): User
    {
        return User::create([
            'rut' => $data['rut'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Actualizar un usuario existente
     */
    public function actualizarUsuario(User $usuario, array $data): User
    {
        $updateData = [
            'rut' => $data['rut'] ?? $usuario->rut,
            'nombre' => $data['nombre'] ?? $usuario->nombre,
            'apellido' => $data['apellido'] ?? $usuario->apellido,
            'email' => $data['email'] ?? $usuario->email,
        ];

        if (isset($data['password']) && !empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $usuario->update($updateData);
        return $usuario->fresh();
    }

    /**
     * Eliminar un usuario
     */
    public function eliminarUsuario(User $usuario): bool
    {
        return $usuario->delete();
    }

    /**
     * Listar usuarios con filtros y paginación
     */
    public function listarUsuarios(array $filtros = [])
    {
        $query = User::query();

        // Aplicar filtros si existen
        if (isset($filtros['search'])) {
            $search = $filtros['search'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (isset($filtros['activo'])) {
            $query->where('activo', $filtros['activo']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Obtener todos los usuarios
     */
    public function obtenerTodosLosUsuarios()
    {
        return User::all();
    }

    /**
     * Obtener un usuario por ID
     */
    public function obtenerUsuarioPorId(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * Validar que el email termine en @ventasfix.cl
     */
    private function validarDominioEmail(string $email): bool
    {
        return str_ends_with($email, '@ventasfix.cl');
    }

    /**
     * Contar total de usuarios
     */
    public function contarUsuarios(): int
    {
        return User::count();
    }
}
