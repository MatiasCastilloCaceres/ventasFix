@extends('layouts.admin')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="row">
    <div class="col-12">
        <x-card title="Lista de Usuarios" icon="ti ti-users">
            <x-slot name="headerActions">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Nuevo Usuario
                </a>
            </x-slot>

            <div class="table-responsive">
                <table id="usuariosTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>
                                <div class="avatar avatar-xs">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-medium">{{ $usuario->name }}</span>
                                    <small class="text-muted">Usuario</small>
                                </div>
                            </td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <span class="badge bg-label-info">
                                    {{ $usuario->created_at->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-label-success">Activo</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('usuarios.show', $usuario->id) }}">
                                            <i class="ti ti-eye me-1"></i>
                                            Ver
                                        </a>
                                        <a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->id) }}">
                                            <i class="ti ti-pencil me-1"></i>
                                            Editar
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" 
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                <i class="ti ti-trash me-1"></i>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ti ti-users ti-4x text-muted mb-3"></i>
                                    <h6 class="text-muted">No hay usuarios registrados</h6>
                                    <p class="text-muted">Comienza creando tu primer usuario</p>
                                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                                        <i class="ti ti-plus me-1"></i>
                                        Crear Usuario
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>

<!-- Estadísticas -->
<div class="row mt-4">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial bg-label-primary rounded">
                            <i class="ti ti-users"></i>
                        </span>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <h5 class="mb-0 me-2">{{ count($usuarios) }}</h5>
                            <small class="text-success">(+8%)</small>
                        </div>
                        <span>Total Usuarios</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial bg-label-success rounded">
                            <i class="ti ti-user-check"></i>
                        </span>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <h5 class="mb-0 me-2">{{ count($usuarios) }}</h5>
                            <small class="text-success">(+15%)</small>
                        </div>
                        <span>Usuarios Activos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial bg-label-info rounded">
                            <i class="ti ti-calendar"></i>
                        </span>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <h5 class="mb-0 me-2">3</h5>
                            <small class="text-info">(+12%)</small>
                        </div>
                        <span>Este Mes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial bg-label-warning rounded">
                            <i class="ti ti-clock"></i>
                        </span>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <h5 class="mb-0 me-2">1</h5>
                            <small class="text-warning">(+5%)</small>
                        </div>
                        <span>Hoy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script>
$(document).ready(function() {
    @if(count($usuarios) > 0)
    $('#usuariosTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        pageLength: 10,
        order: [[0, 'desc']],
        columnDefs: [
            { orderable: false, targets: [1, 6] }
        ]
    });
    @endif
});
</script>
@endpush
