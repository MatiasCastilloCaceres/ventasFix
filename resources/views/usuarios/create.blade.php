@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
            <x-card title="Crear Nuevo Usuario" icon="ti ti-user-plus">
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="nombre" label="Nombre" placeholder="Ingrese el nombre" required />
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="apellido" label="Apellido" placeholder="Ingrese el apellido" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="email" type="email" label="Email" placeholder="usuario@ejemplo.com"
                                required />
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="rut" label="RUT" placeholder="12.345.678-9" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="password" type="password" label="Contraseña"
                                placeholder="Mínimo 8 caracteres" required />
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="password_confirmation" type="password" label="Confirmar Contraseña"
                                placeholder="Repita la contraseña" required />
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>
                                    Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-2"></i>
                                    Guardar Usuario
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection