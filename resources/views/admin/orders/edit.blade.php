@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <h3>Editar Pedido</h3>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @include('admin.orders._form', ['order' => $order])
      </div>
    </div>
  </div>
@endsection

@push('custom-scripts')
  <!-- Puedes agregar scripts específicos para esta página aquí si es necesario -->
@endpush
