<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rut' => 'required|string|unique:users,rut',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z]+\.[a-zA-Z]+@ventasfix\.cl$/'
            ],
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.regex' => 'El email debe tener el formato nombre.apellido@ventasfix.cl',
            'rut.unique' => 'Este RUT ya está registrado',
            'email.unique' => 'Este email ya está registrado',
        ];
    }
}
