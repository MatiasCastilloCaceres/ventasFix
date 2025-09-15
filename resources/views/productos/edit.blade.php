@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')
<div class="row">
    <div class="col-12">
        <x-card title="Editar Producto: {{ $producto->nombre }}" icon="ti ti-edit">
            <form action="{{ route('productos.update', $producto) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input
                            name="codigo"
                            label="Código del Producto"
                            placeholder="Ingrese el código único"
                            value="{{ old('codigo', $producto->codigo) }}"
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            name="nombre"
                            label="Nombre del Producto"
                            placeholder="Ingrese el nombre del producto"
                            value="{{ old('nombre', $producto->nombre) }}"
                            required
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea 
                                class="form-control @error('descripcion') is-invalid @enderror" 
                                id="descripcion" 
                                name="descripcion" 
                                rows="3" 
                                placeholder="Ingrese la descripción del producto">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form-input
                            name="precio"
                            type="number"
                            step="0.01"
                            label="Precio"
                            placeholder="0.00"
                            value="{{ old('precio', $producto->precio) }}"
                            required
                        />
                    </div>
                    <div class="col-md-4">
                        <x-form-input
                            name="stock"
                            type="number"
                            label="Stock"
                            placeholder="0"
                            value="{{ old('stock', $producto->stock) }}"
                            required
                        />
                    </div>
                    <div class="col-md-4">
                        <x-form-input
                            name="categoria"
                            label="Categoría"
                            placeholder="Ingrese la categoría"
                            value="{{ old('categoria', $producto->categoria) }}"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form-input
                            name="marca"
                            label="Marca"
                            placeholder="Ingrese la marca"
                            value="{{ old('marca', $producto->marca) }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="activo" class="form-label">Estado</label>
                            <select class="form-select @error('activo') is-invalid @enderror" id="activo" name="activo">
                                <option value="1" {{ old('activo', $producto->activo) == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('activo', $producto->activo) == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('activo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Fecha de Creación</label>
                            <p class="form-control-plaintext">{{ $producto->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Última Actualización</label>
                            <p class="form-control-plaintext">{{ $producto->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('productos.index') }}" class="btn btn-label-secondary">
                        <i class="ti ti-arrow-left me-1"></i>
                        Cancelar
                    </a>
                    <a href="{{ route('productos.show', $producto) }}" class="btn btn-label-info">
                        <i class="ti ti-eye me-1"></i>
                        Ver Producto
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i>
                        Actualizar Producto
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</div>

@endsection

@section('page-style')
<style>
    .form-label {
        font-weight: 500;
        color: #566a7f;
        margin-bottom: 0.375rem;
    }
    
    .card {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        border: 1px solid #d9dee3;
    }
    
    .btn {
        font-weight: 500;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #696cff;
        box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
    }
    
    .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        color: #ff3e1d;
    }
    
    .is-invalid {
        border-color: #ff3e1d;
    }
    
    .form-control-plaintext {
        padding: 0.4375rem 0;
        color: #566a7f;
        background-color: transparent;
        border: 0;
        font-size: 0.9375rem;
    }
</style>
@endsection

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const form = document.querySelector('form');
    const codigoInput = document.querySelector('input[name="codigo"]');
    const precioInput = document.querySelector('input[name="precio"]');
    const stockInput = document.querySelector('input[name="stock"]');
    
    // Validar código único
    if (codigoInput) {
        codigoInput.addEventListener('blur', function() {
            const codigo = this.value.trim();
            if (codigo) {
                this.value = codigo.toUpperCase().replace(/\s+/g, '');
            }
        });
    }
    
    // Validar precio
    if (precioInput) {
        precioInput.addEventListener('input', function() {
            let value = this.value;
            if (value < 0) {
                this.value = 0;
            }
        });
    }
    
    // Validar stock
    if (stockInput) {
        stockInput.addEventListener('input', function() {
            let value = this.value;
            if (value < 0) {
                this.value = 0;
            }
        });
    }
    
    // Validación antes de enviar
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            if (typeof toastr !== 'undefined') {
                toastr.error('Por favor, complete todos los campos requeridos.');
            }
        }
    });
    
    // Remover clase de error al escribir
    const inputs = form.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endsection
