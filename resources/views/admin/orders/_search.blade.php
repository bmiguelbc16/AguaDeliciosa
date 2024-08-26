<form id="search" name="search" action="{{ route('admin.orders.index') }}" method="GET">
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="mb-3">
        <label class="form-label">Nombre: </label>
        <input type="text" name="name" class="form-control" placeholder="Ingrese nombre"
          value="{{ old('name', $request->name ?? '') }}">
      </div>
    </div>
    <div class="col-auto d-flex align-items-end form-group ">
      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Buscar</button>
      </div>
    </div>
  </div>
</form>
