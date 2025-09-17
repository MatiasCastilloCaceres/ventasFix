@extends('layouts.admin')

@section('title', 'Crear Cliente')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Crear Nuevo Cliente</h5>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i>Volver
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('test.cliente.store') }}" method="POST" id="clienteForm">
                        <!-- Comentamos CSRF temporalmente para debug -->
                        {{-- @csrf --}}
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rut_empresa" class="form-label">RUT Empresa *</label>
                                    <input type="text" class="form-control @error('rut_empresa') is-invalid @enderror" 
                                           id="rut_empresa" name="rut_empresa" value="{{ old('rut_empresa') }}" 
                                           placeholder="12.345.678-9" required>
                                    @error('rut_empresa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rubro" class="form-label">Rubro *</label>
                                    <input type="text" class="form-control @error('rubro') is-invalid @enderror" 
                                           id="rubro" name="rubro" value="{{ old('rubro') }}" 
                                           placeholder="Tecnología, Retail, etc." required>
                                    @error('rubro')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="razon_social" class="form-label">Razón Social *</label>
                                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                           id="razon_social" name="razon_social" value="{{ old('razon_social') }}" 
                                           placeholder="Nombre completo de la empresa" required>
                                    @error('razon_social')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono *</label>
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                           id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                           placeholder="+56 9 1234 5678" required>
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección *</label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" 
                                           id="direccion" name="direccion" value="{{ old('direccion') }}" 
                                           placeholder="Dirección completa" required>
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre_contacto" class="form-label">Nombre de Contacto *</label>
                                    <input type="text" class="form-control @error('nombre_contacto') is-invalid @enderror" 
                                           id="nombre_contacto" name="nombre_contacto" value="{{ old('nombre_contacto') }}" 
                                           placeholder="Nombre completo del contacto" required>
                                    @error('nombre_contacto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email_contacto" class="form-label">Email de Contacto *</label>
                                    <input type="email" class="form-control @error('email_contacto') is-invalid @enderror" 
                                           id="email_contacto" name="email_contacto" value="{{ old('email_contacto') }}" 
                                           placeholder="contacto@empresa.cl" required>
                                    @error('email_contacto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i>Guardar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('clienteForm');
    
    form.addEventListener('submit', function(e) {
        console.log('Formulario enviado');
        
        // Verificar que todos los campos obligatorios estén llenos
        const rutEmpresa = document.getElementById('rut_empresa').value;
        const razonSocial = document.getElementById('razon_social').value;
        const rubro = document.getElementById('rubro').value;
        
        if (!rutEmpresa || !razonSocial || !rubro) {
            e.preventDefault();
            alert('Por favor complete todos los campos obligatorios');
            return false;
        }
        
        console.log('Datos del formulario:', {
            rut_empresa: rutEmpresa,
            razon_social: razonSocial,
            rubro: rubro
        });
    });
});
</script>
@endpush