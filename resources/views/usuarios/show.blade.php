@extends('layouts.admin')

@section('title', 'Ver Usuario')

@section('content')
    <div class="row">
        <div class="col-12">
            <x-card title="Detalles del Usuario" icon="ti ti-user">
                <x-slot name="headerActions">
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary">
                        <i class="ti ti-pencil me-1"></i> Editar
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Volver
                    </a>
                </x-slot>

                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="avatar avatar-xl mx-auto">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                        </div>
                        <h5 class="mt-3">{{ $usuario->name }}</h5>
                        <span class="badge bg-label-success">Activo</span>
                    </div>

                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium">ID:</td>
                                        <td>{{ $usuario->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Nombre:</td>
                                        <td>{{ $usuario->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Email:</td>
                                        <td>{{ $usuario->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Fecha de Registro:</td>
                                        <td>{{ $usuario->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Última Actualización:</td>
                                        <td>{{ $usuario->updated_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection