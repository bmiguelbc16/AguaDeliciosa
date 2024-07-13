@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <div class="col-md-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
      <h3 class="mb-2 mb-sm-0">Pacientes</h3>
      <div class="d-flex flex-column flex-sm-row">
        <a href="{{ route('admin.patients.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Usuario</a>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Buscar</h6>
        @include('admin.patients._search')
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        <h6 class="card-title">Listado</h6>
        <div class="table-responsive">
          <table class="table table-hover">
            <caption>Listado de pacientes en total: {{ $items->total() }}</caption>
            <thead>
              <tr>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Nombre</th>
                <th class="text-center align-middle">Email</th>
                <th class="text-center align-middle">Estado</th>
                <th class="text-center align-middle">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
                <tr>
                  <td class="text-center align-middle">{{ $item->id }}</td>
                  <td class="text-center align-middle">
                    {{ $item->userable?->person?->fullName() ?? ($item->fullName() ?? '') }}
                  </td>
                  <td class="text-center align-middle">{{ $item->email }}</td>
                  <td class="text-center align-middle">{{ $item->active ? 'Activo' : 'Inactivo' }}</td>
                  <td class="text-center">
                    <div class="btn-group" user="group" aria-label="Acciones">
                      <a href="{{ route('admin.patients.edit', $item->id) }}" class="btn btn-success">
                        <i data-feather="edit"></i>
                      </a>
                      <button class="btn btn-danger btn-delete"
                        onclick="deleteItem('{{ route('admin.patients.destroy', $item->id) }}', '{{ route('admin.patients.index') }}')">
                        <i data-feather="trash-2"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-2">
            {{ $items->appends(request()->all())->onEachSide(2)->links('admin.partials.pagination') }}
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('custom-scripts')
  <script type="text/javascript"></script>
@endpush
