<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'razon_social' => 'required|string|max:255',
            'rut' => 'required|string|unique:clientes,rut',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'contacto' => 'nullable|string|max:255',
            'giro' => 'nullable|string|max:255',
            'activo' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'rut.unique' => 'Este RUT ya está registrado',
            'razon_social.required' => 'La razón social es obligatoria',
            'direccion.required' => 'La dirección es obligatoria',
        ];
    }
}
