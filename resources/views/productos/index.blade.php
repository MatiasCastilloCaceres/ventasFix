@extends('layouts.admin')

@section('title', 'Lista de Productos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Lista de Productos</h5>
                    <a href="{{ route('productos.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>
                        Crear Producto
                    </a>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="productosTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Nombre</th>
                                <th>Precio Neto</th>
                                <th>Precio Venta</th>
                                <th>Stock</th>
                                <th>Descripción</th>
                                <th>Fecha Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>
                                        <span class="badge bg-label-primary">{{ $producto->sku }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial bg-label-info rounded">
                                                    <i class="ti ti-box"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $producto->nombre }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($producto->precio_neto, 0, ',', '.') }}</td>
                                    <td>${{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge bg-label-{{ $producto->stock_actual <= $producto->stock_bajo ? 'danger' : 'success' }}">
                                            {{ $producto->stock_actual }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($producto->descripcion_corta ?? 'Sin descripción', 50) }}</td>
                                    <td>
                                        <span class="badge bg-label-success">
                                            {{ $producto->created_at->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('productos.show', $producto->id) }}">
                                                    <i class="ti ti-eye me-1"></i>
                                                    Ver
                                                </a>
                                                <a class="dropdown-item" href="{{ route('productos.edit', $producto->id) }}">
                                                    <i class="ti ti-pencil me-1"></i>
                                                    Editar
                                                </a>
                                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este producto?')">
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
                                    <td colspan="9" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ti ti-box ti-4x text-muted mb-3"></i>
                                            <h6 class="text-muted">No hay productos registrados</h6>
                                            <p class="text-muted">Comienza creando tu primer producto</p>
                                            <a href="{{ route('productos.create') }}" class="btn btn-primary">
                                                <i class="ti ti-plus me-1"></i>
                                                Crear Producto
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
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
                                <i class="ti ti-box"></i>
                            </span>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <h5 class="mb-0 me-2">{{ count($productos) }}</h5>
                                <small class="text-success">(+12%)</small>
                            </div>
                            <span>Total Productos</span>
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
                                <i class="ti ti-trending-up"></i>
                            </span>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <h5 class="mb-0 me-2">
                                    ${{ number_format(collect($productos)->avg('precio_neto') ?? 0, 0, ',', '.') }}</h5>
                                <small class="text-success">(+8%)</small>
                            </div>
                            <span>Precio Promedio</span>
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
                                <h5 class="mb-0 me-2">2</h5>
                                <small class="text-info">(+15%)</small>
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
                                <i class="ti ti-star"></i>
                            </span>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <h5 class="mb-0 me-2">4.8</h5>
                                <small class="text-warning">(+0.2)</small>
                            </div>
                            <span>Rating Promedio</span>
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
        $(document).ready(function () {
            @if(count($productos) > 0)
                $('#productosTable').DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                    },
                    pageLength: 10,
                    order: [[0, 'desc']],
                    columnDefs: [
                        { orderable: false, targets: [6] }
                    ]
                });
            @endif
    });
    </script>
@endpush