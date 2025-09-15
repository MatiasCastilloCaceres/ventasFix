<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\Log;

class ProductoService
{
    /**
     * Listar productos con filtros
     */
    public function listarProductos(array $filtros = [])
    {
        $query = Producto::query();

        if (isset($filtros['search'])) {
            $search = $filtros['search'];
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('descripcion_corta', 'like', "%{$search}%");
            });
        }

        if (isset($filtros['categoria'])) {
            $query->where('descripcion_larga', 'like', "%{$filtros['categoria']}%");
        }

        if (isset($filtros['stock_bajo'])) {
            $query->stockBajo();
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Crear un nuevo producto
     */
    public function crearProducto(array $data): Producto
    {
        return Producto::create([
            'sku' => $data['sku'],
            'nombre' => $data['nombre'],
            'descripcion_corta' => $data['descripcion_corta'],
            'descripcion_larga' => $data['descripcion_larga'],
            'imagen' => $data['imagen'],
            'precio_neto' => $data['precio_neto'],
            'stock_actual' => $data['stock_actual'] ?? 0,
            'stock_minimo' => $data['stock_minimo'] ?? 0,
            'stock_bajo' => $data['stock_bajo'] ?? 0,
            'stock_alto' => $data['stock_alto'] ?? 0,
        ]);
    }

    /**
     * Actualizar un producto existente
     */
    public function actualizarProducto(Producto $producto, array $data): Producto
    {
        $updateData = [
            'sku' => $data['sku'] ?? $producto->sku,
            'nombre' => $data['nombre'] ?? $producto->nombre,
            'descripcion_corta' => $data['descripcion_corta'] ?? $producto->descripcion_corta,
            'descripcion_larga' => $data['descripcion_larga'] ?? $producto->descripcion_larga,
            'imagen' => $data['imagen'] ?? $producto->imagen,
            'precio_neto' => $data['precio_neto'] ?? $producto->precio_neto,
            'stock_actual' => $data['stock_actual'] ?? $producto->stock_actual,
            'stock_minimo' => $data['stock_minimo'] ?? $producto->stock_minimo,
            'stock_bajo' => $data['stock_bajo'] ?? $producto->stock_bajo,
            'stock_alto' => $data['stock_alto'] ?? $producto->stock_alto,
        ];

        $producto->update($updateData);
        return $producto->fresh();
    }

    /**
     * Eliminar un producto
     */
    public function eliminarProducto(Producto $producto): bool
    {
        return $producto->delete();
    }

    /**
     * Obtener todos los productos
     */
    public function obtenerTodosLosProductos()
    {
        return Producto::all();
    }

    /**
     * Obtener un producto por ID
     */
    public function obtenerProductoPorId(int $id): Producto
    {
        return Producto::findOrFail($id);
    }

    /**
     * Contar total de productos
     */
    public function contarProductos(): int
    {
        return Producto::count();
    }

    /**
     * Obtener productos con stock
     */
    public function obtenerProductosConStock()
    {
        return Producto::conStock()->get();
    }

    /**
     * Obtener productos con stock bajo
     */
    public function obtenerProductosStockBajo()
    {
        return Producto::stockBajo()->get();
    }
}
