@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="row">
    <div class="col-12">
        <x-card title="Editar Usuario" icon="ti ti-pencil">
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input
                            name="name"
                            label="Nombre completo"
                            placeholder="Ingrese el nombre completo"
                            :value="$usuario->name"
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            name="email"
                            type="email"
                            label="Email"
                            placeholder="usuario@ejemplo.com"
                            :value="$usuario->email"
                            required
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form-input
                            name="password"
                            type="password"
                            label="Nueva Contraseña"
                            placeholder="Dejar vacío para mantener actual"
                            help="Dejar vacío si no desea cambiar la contraseña"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            name="password_confirmation"
                            type="password"
                            label="Confirmar Nueva Contraseña"
                            placeholder="Confirmar nueva contraseña"
                        />
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i>
                        Volver
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i>
                        Actualizar Usuario
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</div>
@endsection
