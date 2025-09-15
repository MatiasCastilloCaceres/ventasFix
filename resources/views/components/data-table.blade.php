@props([
    'id' => 'datatable',
    'columns' => [],
    'route' => null,
    'showCreate' => true,
    'createRoute' => null,
    'title' => 'Listado'
])

<x-card :title="$title" icon="ti ti-list">
    <x-slot name="headerActions">
        @if($showCreate && $createRoute)
        <a href="{{ route($createRoute) }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Nuevo
        </a>
        @endif
    </x-slot>

    <div class="table-responsive">
        <table id="{{ $id }}" class="table table-bordered table-hover">
            <thead>
                <tr>
                    @foreach($columns as $column)
                    <th>{{ $column['title'] ?? $column['data'] }}</th>
                    @endforeach
                    <th width="120">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</x-card>

@push('scripts')
<script>
$(document).ready(function() {
    $('#{{ $id }}').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        },
        ajax: '{{ $route }}',
        columns: [
            @foreach($columns as $column)
            {
                data: '{{ $column['data'] }}',
                name: '{{ $column['name'] ?? $column['data'] }}',
                @if(isset($column['orderable']) && !$column['orderable'])
                orderable: false,
                @endif
                @if(isset($column['searchable']) && !$column['searchable'])
                searchable: false,
                @endif
                @if(isset($column['render']))
                render: {!! $column['render'] !!}
                @endif
            },
            @endforeach
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ],
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
    });
});
</script>
@endpush
