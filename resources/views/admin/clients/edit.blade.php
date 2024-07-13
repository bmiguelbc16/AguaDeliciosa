@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <h3>Editar cliente</h3>
  </div>

  <div class="row">

    @include('admin.clients._form')

  </div>
@endsection

@push('custom-scripts')
@endpush
