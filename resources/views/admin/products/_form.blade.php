@include('admin.partials.validation-errors')

<form class="form-product" id="form-product"
  @if (isset($product)) action="{{ route('admin.products.update', $product) }}"
  @else
    action="{{ route('admin.products.store') }}" @endif
  method="POST">

  @isset($product)
    @method('patch')
  @endisset

  @csrf

  <div class="card mb-4">
    <div class="card-body">
      <h6 class="card-title">Datos del Producto</h6>
      <div class="row">
        <!-- Campo Nombre del Producto -->
        <div class="col-sm-4">
          <div class="mb-3">
            <x-form.input name="name" label="Nombre del Producto" placeholder="Nombre del Producto"
              value="{{ old('name', $product->name ?? '') }}" enable-old-support />
          </div>
        </div>

        <!-- Campo Precio Unitario -->
        <div class="col-sm-4">
          <div class="mb-3">
            <x-form.input type="number" name="unit_price" label="Precio Unitario" placeholder="Precio Unitario"
              value="{{ old('unit_price', $product->unit_price ?? '') }}" step="0.01" min="0"
              enable-old-support />
          </div>
        </div>

        <!-- Otros campos aquí -->

        <div class="col-sm-3">
          <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control"
              value="{{ old('stock', isset($product) ? $product->stock : '') }}"
              {{ $isStockEditable ? '' : 'readonly' }} />
          </div>
        </div>

      </div>
    </div>
  </div>

  <x-form.button type="submit" label="Guardar" theme="primary" />
  <x-form.button label="Cancelar" theme="secondary" onclick="window.location = '{{ route('admin.products.index') }}'" />

</form>
