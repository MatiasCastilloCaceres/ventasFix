@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Gestión de Clientes</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClienteModal">
                        <i class="bx bx-plus me-1"></i> Nuevo Cliente
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="clientesTable">
                            <thead>
                                <tr>
                                    <th>RUT</th>
                                    <th>Razón Social</th>
                                    <th>Giro</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->rut_empresa }}</td>
                                    <td>{{ $cliente->razon_social }}</td>
                                    <td>{{ $cliente->rubro }}</td>
                                    <td>{{ $cliente->nombre_contacto }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            Activo
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('clientes.show', $cliente->id) }}">Ver</a></li>
                                                <li><a class="dropdown-item" href="{{ route('clientes.edit', $cliente->id) }}">Editar</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="confirmarEliminacion({{ $cliente->id }})">Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Cliente -->
<div class="modal fade" id="createClienteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createClienteForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rut" class="form-label">RUT</label>
                                <input type="text" class="form-control" id="rut" name="rut" required placeholder="Ej: 12345678-9">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="razon_social" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="giro" class="form-label">Giro</label>
                                <input type="text" class="form-control" id="giro" name="giro">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contacto" class="form-label">Contacto</label>
                                <input type="text" class="form-control" id="contacto" name="contacto">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Cliente -->
<div class="modal fade" id="editClienteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editClienteForm">
                <input type="hidden" id="edit_cliente_id" name="cliente_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_rut" class="form-label">RUT</label>
                                <input type="text" class="form-control" id="edit_rut" name="rut" required placeholder="Ej: 12345678-9">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_razon_social" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="edit_razon_social" name="razon_social" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_giro" class="form-label">Giro</label>
                                <input type="text" class="form-control" id="edit_giro" name="giro">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_contacto" class="form-label">Contacto</label>
                                <input type="text" class="form-control" id="edit_contacto" name="contacto">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="edit_direccion" name="direccion" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="edit_telefono" name="telefono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_activo" name="activo" value="1">
                            <label class="form-check-label" for="edit_activo">
                                Cliente Activo
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configurar DataTable
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#clientesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            },
            responsive: true,
            pageLength: 25
        });
    }

    // Manejar formulario de creación
    document.getElementById('createClienteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/clientes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al crear cliente');
        });
    });

    // Manejar formulario de edición
    document.getElementById('editClienteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const clienteId = data.cliente_id;
        delete data.cliente_id;

        // Convertir checkbox a boolean
        data.activo = data.activo ? true : false;

        fetch(`/api/clientes/${clienteId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar cliente');
        });
    });
});

function editCliente(clienteId) {
    fetch(`/api/clientes/${clienteId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cliente = data.data;
                document.getElementById('edit_cliente_id').value = cliente.id;
                document.getElementById('edit_rut').value = cliente.rut;
                document.getElementById('edit_razon_social').value = cliente.razon_social;
                document.getElementById('edit_giro').value = cliente.giro || '';
                document.getElementById('edit_contacto').value = cliente.contacto || '';
                document.getElementById('edit_direccion').value = cliente.direccion;
                document.getElementById('edit_telefono').value = cliente.telefono || '';
                document.getElementById('edit_email').value = cliente.email || '';
                document.getElementById('edit_activo').checked = cliente.activo;
                
                const modal = new bootstrap.Modal(document.getElementById('editClienteModal'));
                modal.show();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al obtener datos del cliente');
        });
}

function deleteCliente(clienteId) {
    if (confirm('¿Está seguro de que desea eliminar este cliente?')) {
        fetch(`/api/clientes/${clienteId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar cliente');
        });
    }
}
</script>
@endsection
