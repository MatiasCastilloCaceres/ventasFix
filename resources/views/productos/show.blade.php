@extends('layouts.admin')

@section('title', 'Ver Producto')

@section('content')
<div class="row">
    <div class="col-12">
        <x-card title="Detalles del Producto" icon="ti ti-eye">
            <div class="row">
                <!-- Información Principal -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Código</label>
                                <p class="form-control-static">{{ $producto->codigo }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nombre</label>
                                <p class="form-control-static">{{ $producto->nombre }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Descripción</label>
                                <p class="form-control-static">
                                    {{ $producto->descripcion ?: 'Sin descripción' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Precio</label>
                                <p class="form-control-static text-success fw-bold">
                                    ${{ number_format($producto->precio, 2, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Stock</label>
                                <p class="form-control-static">
                                    <span class="badge {{ $producto->stock > 10 ? 'bg-success' : ($producto->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $producto->stock }} unidades
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Estado</label>
                                <p class="form-control-static">
                                    <span class="badge {{ $producto->activo ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Categoría</label>
                                <p class="form-control-static">
                                    {{ $producto->categoria ?: 'Sin categoría' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Marca</label>
                                <p class="form-control-static">
                                    {{ $producto->marca ?: 'Sin marca' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="ti ti-info-circle me-1"></i>
                                Información del Sistema
                            </h6>
                            
                            <div class="mb-3">
                                <small class="text-muted">ID del Producto</small>
                                <p class="mb-1"># {{ $producto->id }}</p>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Fecha de Creación</small>
                                <p class="mb-1">{{ $producto->created_at->format('d/m/Y') }}</p>
                                <small class="text-muted">{{ $producto->created_at->format('H:i:s') }}</small>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Última Actualización</small>
                                <p class="mb-1">{{ $producto->updated_at->format('d/m/Y') }}</p>
                                <small class="text-muted">{{ $producto->updated_at->format('H:i:s') }}</small>
                            </div>

                            <hr>

                            <div class="mb-0">
                                <small class="text-muted">Valor Total en Stock</small>
                                <p class="mb-0 text-primary fw-bold">
                                    ${{ number_format($producto->precio * $producto->stock, 2, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2 justify-content-between">
                        <div>
                            <a href="{{ route('productos.index') }}" class="btn btn-label-secondary">
                                <i class="ti ti-arrow-left me-1"></i>
                                Volver al Listado
                            </a>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-primary">
                                <i class="ti ti-edit me-1"></i>
                                Editar Producto
                            </a>
                            
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="ti ti-trash me-1"></i>
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="ti ti-alert-triangle text-warning" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">¿Está seguro?</h4>
                    <p class="text-muted">
                        Esta acción eliminará permanentemente el producto:<br>
                        <strong>{{ $producto->nombre }}</strong> ({{ $producto->codigo }})
                    </p>
                    <p class="text-danger small">
                        <i class="ti ti-exclamation-mark me-1"></i>
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>
                    Cancelar
                </button>
                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-trash me-1"></i>
                        Sí, Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-style')
<style>
    .form-control-static {
        padding: 0.4375rem 0;
        color: #566a7f;
        font-size: 0.9375rem;
        line-height: 1.53;
        margin-bottom: 0;
    }
    
    .card {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        border: 1px solid #d9dee3;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .fw-semibold {
        font-weight: 600 !important;
    }
    
    .badge {
        font-size: 0.8125rem;
        font-weight: 500;
    }
    
    .text-success {
        color: #71dd37 !important;
    }
    
    .text-primary {
        color: #696cff !important;
    }
    
    .modal-content {
        border: 0;
        box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
    }
    
    .btn {
        font-weight: 500;
    }
    
    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: currentColor;
        border: 0;
        opacity: 0.25;
    }
</style>
@endsection

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmación adicional antes de eliminar
    const deleteForm = document.querySelector('#deleteModal form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            // Doble confirmación para productos con stock alto
            const stock = {{ $producto->stock }};
            if (stock > 50) {
                if (!confirm('Este producto tiene stock alto (' + stock + ' unidades). ¿Está completamente seguro de eliminarlo?')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    }
});
</script>
@endsection
