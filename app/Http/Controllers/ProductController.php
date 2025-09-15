<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index(Request $request)
    {
        try {
            $productos = $this->productoService->listarProductos($request->all());
            return view('productos.index', compact('productos'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar productos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|unique:productos,sku|max:50',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:500',
            'descripcion_larga' => 'required|string',
            'imagen' => 'required|string|max:500',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        try {
            $producto = $this->productoService->crearProducto($request->all());
            return redirect()->route('productos.index')
                ->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear producto: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $producto = $this->productoService->obtenerProductoPorId($id);
            return view('productos.show', compact('producto'));
        } catch (\Exception $e) {
            return back()->with('error', 'Producto no encontrado');
        }
    }

    public function edit($id)
    {
        try {
            $producto = $this->productoService->obtenerProductoPorId($id);
            return view('productos.edit', compact('producto'));
        } catch (\Exception $e) {
            return back()->with('error', 'Producto no encontrado');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|string|unique:productos,codigo,' . $id,
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'nullable|string',
            'marca' => 'nullable|string',
        ]);

        try {
            $producto = $this->productoService->obtenerProductoPorId($id);
            $this->productoService->actualizarProducto($producto, $request->all());
            return redirect()->route('productos.index')
                ->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar producto: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $producto = $this->productoService->obtenerProductoPorId($id);
            $this->productoService->eliminarProducto($producto);
            return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')
                ->with('error', 'Error al eliminar producto: ' . $e->getMessage());
        }
    }
}
