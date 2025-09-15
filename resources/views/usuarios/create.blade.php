@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
<div class="row">
    <div class="col-12">
        <x-card title="Crear Nuevo Usuario" icon="ti ti-user-plus">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input
                            name="name"
                            label="Nombre completo"
                            placeholder="Ingrese el nombre completo"
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            name="email"
                            type="email"
                            label="Email"
                            placeholder="usuario@ejemplo.com"
                            required
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form-input
                            name="password"
                            type="password"
                            label="Contraseña"
                            placeholder="Contraseña"
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            name="password_confirmation"
                            type="password"
                            label="Confirmar Contraseña"
                            placeholder="Confirmar contraseña"
                            required
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
                        Guardar Usuario
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</div>
@endsection
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    placeholder="Nombre completo"
                                    value="{{ old('name') }}" 
                                    required>
                                <label for="name">Nombre Completo</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    placeholder="usuario@ejemplo.com"
                                    value="{{ old('email') }}" 
                                    required>
                                <label for="email">Correo Electrónico</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Credenciales -->
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password" 
                                    placeholder="••••••••"
                                    required>
                                <label for="password">Contraseña</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <small>Mínimo 8 caracteres</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input 
                                    type="password" 
                                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    placeholder="••••••••"
                                    required>
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input 
                                    type="text" 
                                    class="form-control @error('telefono') is-invalid @enderror" 
                                    id="telefono" 
                                    name="telefono" 
                                    placeholder="+56 9 1234 5678"
                                    value="{{ old('telefono') }}">
                                <label for="telefono">Teléfono (Opcional)</label>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select @error('activo') is-invalid @enderror" id="activo" name="activo">
                                    <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                <label for="activo">Estado</label>
                                @error('activo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="ti ti-refresh me-1"></i>
                                    Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-1"></i>
                                    Crear Usuario
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Vista Previa -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Vista Previa</h6>
            </div>
            <div class="card-body text-center">
                <div class="avatar avatar-xl mx-auto mb-3">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                </div>
                <h6 class="mb-1" id="preview-name">Nombre Usuario</h6>
                <p class="text-muted mb-0" id="preview-email">email@ejemplo.com</p>
                <div class="mt-3">
                    <span class="badge bg-label-success" id="preview-status">Activo</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Información del Sistema</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial bg-label-primary rounded">
                                    <i class="ti ti-key"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0">Autenticación</h6>
                                <small class="text-muted">Laravel Breeze</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial bg-label-info rounded">
                                    <i class="ti ti-shield"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0">Seguridad</h6>
                                <small class="text-muted">Hash BCrypt</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial bg-label-success rounded">
                                    <i class="ti ti-database"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0">Almacenamiento</h6>
                                <small class="text-muted">MySQL Database</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial bg-label-warning rounded">
                                    <i class="ti ti-api"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0">API Access</h6>
                                <small class="text-muted">Token disponible</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

<script>
$(document).ready(function() {
    // Vista previa en tiempo real
    $('#name').on('input', function() {
        $('#preview-name').text($(this).val() || 'Nombre Usuario');
    });
    
    $('#email').on('input', function() {
        $('#preview-email').text($(this).val() || 'email@ejemplo.com');
    });
    
    $('#activo').on('change', function() {
        var status = $(this).val() == '1' ? 'Activo' : 'Inactivo';
        var badgeClass = $(this).val() == '1' ? 'bg-label-success' : 'bg-label-danger';
        $('#preview-status').removeClass('bg-label-success bg-label-danger').addClass(badgeClass).text(status);
    });

    // Validación de contraseñas
    $('#password_confirmation').on('input', function() {
        var password = $('#password').val();
        var confirmation = $(this).val();
        
        if (password !== confirmation && confirmation.length > 0) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // Formateo de teléfono
    $('#telefono').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.startsWith('56')) {
                value = '+' + value.substring(0, 2) + ' ' + value.substring(2, 3) + ' ' + 
                       value.substring(3, 7) + ' ' + value.substring(7, 11);
            } else {
                value = '+56 9 ' + value.substring(0, 4) + ' ' + value.substring(4, 8);
            }
            $(this).val(value);
        }
    });
});
</script>
@endpush
