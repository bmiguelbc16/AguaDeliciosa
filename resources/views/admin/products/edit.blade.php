@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <h3>Editar Producto</h3>
  </div>

  <div class="row">
    @include('admin.products._form', ['isEditable' => true])
  </div>
@endsection
