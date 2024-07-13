@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <div class="col-md-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
      <h3 class="mb-2 mb-sm-0">Roles</h3>
      <div class="d-flex flex-column flex-sm-row">
        <x-form.button label="Nuevo rol" theme="primary" data-bs-toggle="modal" data-bs-target="#onFormModal" />
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        <h6 class="card-title">Listado</h6>
        <div class="table-responsive">
          <table class="table table-hover">
            <caption>Listado de roles en total: {{ $items->total() }}</caption>
            <thead>
              <tr>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Nombre</th>
                <th class="text-center align-middle">Descripción</th>
                <th class="text-center align-middle">Estado</th>
                <th class="text-center align-middle">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
                <tr>
                  <td class="text-center align-middle">{{ $item->id }}</td>
                  <td class="align-middle">{{ $item->name }}</td>
                  <td class="align-middle">{{ $item->description }}</td>
                  <td class="text-center align-middle">{{ $item->active ? 'Activo' : 'Inactivo' }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Acciones">
                      <x-form.button theme="success" icon="edit" data-bs-toggle="modal" data-bs-target="#onFormModal"
                        data-bs-id-item="{{ $item->id }}" />
                      <button class="btn btn-danger btn-delete"
                        onclick="deleteItem('{{ route('admin.roles.destroy', $item->id) }}', '{{ route('admin.roles.index') }}')">
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

  @include('admin.roles._modal_form')
@endsection

@push('custom-scripts')
  <script src="{{ mix('js/form-modal.js') }}"></script>

  <script type="text/javascript">
    const options = {
      showUrl: "{{ route('admin.roles.show', ':id') }}",
      storeUrl: "{{ route('admin.roles.store') }}",
      updateUrl: "{{ route('admin.roles.update', ':id') }}",
      indexUrl: "{{ route('admin.roles.index') }}"
    };
  </script>
@endpush
