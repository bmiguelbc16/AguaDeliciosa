@extends('layout.master')

@section('content')
  <div class="row mb-4">
    <h3>Editar usuario</h3>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        @include('admin.patients._form')

      </div>
    </div>
  </div>
@endsection

@push('custom-scripts')
@endpush
