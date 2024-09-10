@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <h3>Registrar Producto</h3>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @include('admin.products._form', ['isEditable' => false])
      </div>
    </div>
  </div>
@endsection
