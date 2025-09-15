<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    /**
     * Crear un nuevo cliente
     */
    public function crearCliente(array $data): Cliente
    {
        return Cliente::create([
            'razon_social' => $data['razon_social'],
            'rut' => $data['rut'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'] ?? null,
            'email' => $data['email'] ?? null,
            'contacto' => $data['contacto'] ?? null,
            'giro' => $data['giro'] ?? null,
            'activo' => $data['activo'] ?? true,
        ]);
    }

    /**
     * Actualizar un cliente existente
     */
    public function actualizarCliente(Cliente $cliente, array $data): Cliente
    {
        $updateData = [
            'razon_social' => $data['razon_social'] ?? $cliente->razon_social,
            'rut' => $data['rut'] ?? $cliente->rut,
            'direccion' => $data['direccion'] ?? $cliente->direccion,
            'telefono' => $data['telefono'] ?? $cliente->telefono,
            'email' => $data['email'] ?? $cliente->email,
            'contacto' => $data['contacto'] ?? $cliente->contacto,
            'giro' => $data['giro'] ?? $cliente->giro,
            'activo' => $data['activo'] ?? $cliente->activo,
        ];

        $cliente->update($updateData);
        return $cliente->fresh();
    }

    /**
     * Eliminar un cliente
     */
    public function eliminarCliente(Cliente $cliente): bool
    {
        return $cliente->delete();
    }

    /**
     * Obtener todos los clientes
     */
    public function obtenerTodosLosClientes()
    {
        return Cliente::all();
    }

    /**
     * Obtener un cliente por ID
     */
    public function obtenerClientePorId(int $id): Cliente
    {
        return Cliente::findOrFail($id);
    }

    /**
     * Contar total de clientes
     */
    public function contarClientes(): int
    {
        return Cliente::count();
    }

    /**
     * Obtener clientes activos
     */
    public function obtenerClientesActivos()
    {
        return Cliente::where('activo', true)->get();
    }

    /**
     * Buscar clientes por RUT
     */
    public function buscarPorRut(string $rut): ?Cliente
    {
        return Cliente::where('rut', $rut)->first();
    }
}
