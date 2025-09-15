@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('content')
    <div class="row">
        <div class="col-12">
            <x-card title="Crear Nuevo Producto" icon="ti ti-package">
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="sku" label="SKU del Producto" placeholder="Ingrese el SKU único"
                                required />
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="nombre" label="Nombre del Producto"
                                placeholder="Ingrese el nombre del producto" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="descripcion_corta" class="form-label">Descripción Corta *</label>
                                <textarea class="form-control @error('descripcion_corta') is-invalid @enderror" id="descripcion_corta"
                                    name="descripcion_corta" rows="2" maxlength="500"
                                    placeholder="Descripción breve del producto (máx. 500 caracteres)">{{ old('descripcion_corta') }}</textarea>
                                @error('descripcion_corta')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="descripcion_larga" class="form-label">Descripción Detallada *</label>
                                <textarea class="form-control @error('descripcion_larga') is-invalid @enderror" id="descripcion_larga"
                                    name="descripcion_larga" rows="4"
                                    placeholder="Descripción completa y detallada del producto">{{ old('descripcion_larga') }}</textarea>
                                @error('descripcion_larga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <x-form-input name="imagen" label="URL de la Imagen" placeholder="https://ejemplo.com/imagen.jpg" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="precio_neto" type="number" step="1" label="Precio Neto" placeholder="0"
                                required />
                            <small class="text-muted">El precio con IVA se calculará automáticamente</small>
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="stock_actual" type="number" label="Stock Actual" placeholder="0" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <x-form-input name="stock_minimo" type="number" label="Stock Mínimo" placeholder="0" required />
                        </div>
                        <div class="col-md-3">
                            <x-form-input name="stock_bajo" type="number" label="Stock Bajo" placeholder="0" required />
                        </div>
                        <div class="col-md-3">
                            <x-form-input name="stock_alto" type="number" label="Stock Alto" placeholder="0" required />
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Precio con IVA</label>
                                <input type="text" class="form-control" id="precio_venta" readonly placeholder="Se calcula automáticamente">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-form-input name="marca" label="Marca" placeholder="Ingrese la marca" />
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="activo" class="form-label">Estado</label>
                                <select class="form-select @error('activo') is-invalid @enderror" id="activo" name="activo">
                                    <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('activo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('productos.index') }}" class="btn btn-label-secondary">
                            <i class="ti ti-arrow-left me-1"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i>
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>

@endsection

@section('vendor-style')
    <!-- Estilos específicos para la página de creación de productos -->
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
    </style>
@endsection

@section('vendor-script')
    <!-- Scripts específicos para la página de creación de productos -->
@endsection

@section('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Validación del formulario
            const form = document.querySelector('form');
            const skuInput = document.querySelector('input[name="sku"]');
            const precioNetoInput = document.querySelector('input[name="precio_neto"]');

            // Validar SKU único
            if (skuInput) {
                skuInput.addEventListener('blur', function () {
                    const sku = this.value.trim();
                    if (sku) {
                        // Convertir a mayúsculas y remover espacios
                        this.value = sku.toUpperCase().replace(/\s+/g, '');
                    }
                });
            }

            // Calcular precio con IVA automáticamente y validar precio neto
            if (precioNetoInput) {
                precioNetoInput.addEventListener('input', function () {
                    let precioNeto = parseFloat(this.value) || 0;
                    if (precioNeto < 0) {
                        this.value = 0;
                        precioNeto = 0;
                    }
                    
                    // Calcular y mostrar precio con IVA
                    const precioVentaInput = document.getElementById('precio_venta');
                    if (precioVentaInput) {
                        const precioConIva = precioNeto * 1.19;
                        precioVentaInput.value = '$' + new Intl.NumberFormat('es-CL').format(Math.round(precioConIva));
                    }
                });
            }

            // Validar campos de stock
            const stockInputs = ['stock_actual', 'stock_minimo', 'stock_bajo', 'stock_alto'];
            stockInputs.forEach(fieldName => {
                const input = document.querySelector(`input[name="${fieldName}"]`);
                if (input) {
                    input.addEventListener('input', function () {
                        let value = parseInt(this.value);
                        if (value < 0 || isNaN(value)) {
                            this.value = 0;
                        }
                    });
                }
            });

            // Validación antes de enviar
            form.addEventListener('submit', function (e) {
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
                    // Mostrar notificación de error
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Por favor, complete todos los campos requeridos.');
                    }
                }
            });

            // Remover clase de error al escribir
            const inputs = form.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    this.classList.remove('is-invalid');
                });
            });
        });
    </script>
@endsection