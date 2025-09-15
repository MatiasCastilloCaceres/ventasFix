<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
        ];
    }

    public function messages(): array
    {
        return [
            'sku.required' => 'El SKU es obligatorio.',
            'sku.unique' => 'Este SKU ya existe.',
            'sku.max' => 'El SKU no puede tener más de 50 caracteres.',
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'descripcion_corta.required' => 'La descripción corta es obligatoria.',
            'descripcion_corta.max' => 'La descripción corta no puede tener más de 500 caracteres.',
            'descripcion_larga.required' => 'La descripción larga es obligatoria.',
            'imagen.required' => 'La URL de la imagen es obligatoria.',
            'imagen.max' => 'La URL de la imagen no puede tener más de 500 caracteres.',
            'precio_neto.required' => 'El precio neto es obligatorio.',
            'precio_neto.numeric' => 'El precio neto debe ser un número.',
            'precio_neto.min' => 'El precio neto no puede ser negativo.',
            'stock_actual.required' => 'El stock actual es obligatorio.',
            'stock_actual.integer' => 'El stock actual debe ser un número entero.',
            'stock_actual.min' => 'El stock actual no puede ser negativo.',
            'stock_minimo.required' => 'El stock mínimo es obligatorio.',
            'stock_minimo.integer' => 'El stock mínimo debe ser un número entero.',
            'stock_minimo.min' => 'El stock mínimo no puede ser negativo.',
            'stock_bajo.required' => 'El stock bajo es obligatorio.',
            'stock_bajo.integer' => 'El stock bajo debe ser un número entero.',
            'stock_bajo.min' => 'El stock bajo no puede ser negativo.',
            'stock_alto.required' => 'El stock alto es obligatorio.',
            'stock_alto.integer' => 'El stock alto debe ser un número entero.',
            'stock_alto.min' => 'El stock alto no puede ser negativo.',
        ];
    }
}
