<!-- Way 1play All Error Messages -->
@if ($errors->any())

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h5><strong>Algo salió mal!</strong></h5>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
    <p>Verifica los siguientes campos:</p>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>

@endif
