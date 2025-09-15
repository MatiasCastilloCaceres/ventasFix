@extends('layouts.admin')

@section('title', 'Dashboard - VentasFix')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Panel de Control</h4>
                        <p class="card-text text-muted">Bienvenido al sistema de gestión VentasFix</p>
                    </div>
                    <div class="avatar avatar-lg bg-primary rounded">
                        <i class="ti ti-dashboard ti-lg text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-4 mt-2">
    <!-- Estadísticas -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Usuarios</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{ $stats['users'] ?? '0' }}</h4>
                            <p class="text-success mb-0">(+12%)</p>
                        </div>
                        <p class="mb-0 text-muted">Total registrados</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-users ti-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Productos</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{ $stats['products'] ?? '0' }}</h4>
                            <p class="text-success mb-0">(+8%)</p>
                        </div>
                        <p class="mb-0 text-muted">En catálogo</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-info">
                            <i class="ti ti-box ti-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">Clientes</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{ $stats['clients'] ?? '0' }}</h4>
                            <p class="text-success mb-0">(+18%)</p>
                        </div>
                        <p class="mb-0 text-muted">Registrados</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-briefcase ti-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <span class="text-heading">API Calls</span>
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{ $stats['api_calls'] ?? '0' }}</h4>
                            <p class="text-success mb-0">(+22%)</p>
                        </div>
                        <p class="mb-0 text-muted">Este mes</p>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-api ti-lg"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-4 mt-2">
    <!-- Actividad Reciente -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0">Actividad Reciente</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="activityDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="activityDropdown">
                            <a class="dropdown-item" href="#">Ver todo</a>
                            <a class="dropdown-item" href="#">Filtrar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="timeline">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-0">Nuevo usuario registrado</h6>
                                <small class="text-muted">Hace 2 minutos</small>
                            </div>
                            <p class="mb-2">Juan Pérez se registró en el sistema</p>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-0">Producto actualizado</h6>
                                <small class="text-muted">Hace 15 minutos</small>
                            </div>
                            <p class="mb-2">Se actualizó el precio del producto "Laptop Dell"</p>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-warning"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-0">Cliente agregado</h6>
                                <small class="text-muted">Hace 1 hora</small>
                            </div>
                            <p class="mb-2">Nuevo cliente "Empresa ABC" registrado</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Accesos Rápidos -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0">Accesos Rápidos</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-user-plus me-2"></i>
                        <span>Crear Usuario</span>
                    </a>
                    <a href="{{ route('productos.create') }}" class="btn btn-info d-flex align-items-center">
                        <i class="ti ti-box-model me-2"></i>
                        <span>Agregar Producto</span>
                    </a>
                    <a href="{{ route('clientes.create') }}" class="btn btn-warning d-flex align-items-center">
                        <i class="ti ti-building-store me-2"></i>
                        <span>Registrar Cliente</span>
                    </a>
                    <a href="/api/v1/documentation" target="_blank" class="btn btn-success d-flex align-items-center">
                        <i class="ti ti-api me-2"></i>
                        <span>Documentación API</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="card-title m-0">Estado del Sistema</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="badge bg-label-success rounded-circle me-2 p-1">
                        <i class="ti ti-check ti-xs"></i>
                    </div>
                    <span class="text-muted">Base de datos</span>
                    <span class="ms-auto badge bg-success">Online</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="badge bg-label-success rounded-circle me-2 p-1">
                        <i class="ti ti-check ti-xs"></i>
                    </div>
                    <span class="text-muted">API REST</span>
                    <span class="ms-auto badge bg-success">Activa</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="badge bg-label-success rounded-circle me-2 p-1">
                        <i class="ti ti-check ti-xs"></i>
                    </div>
                    <span class="text-muted">Autenticación</span>
                    <span class="ms-auto badge bg-success">Funcional</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    console.log('Dashboard cargado correctamente');
</script>
@endpush
