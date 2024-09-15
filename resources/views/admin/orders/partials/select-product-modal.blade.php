<div class="modal fade" id="select-product-modal" tabindex="-1" aria-labelledby="selectProductModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectProductModalLabel">Seleccionar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Campo de búsqueda -->
        <div class="mb-3">
          <input type="text" class="form-control" id="product-search" placeholder="Buscar producto...">
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody id="product-list">
            @foreach ($products as $product)
              <tr data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                data-product-price="{{ $product->unit_price }}">
                <td>{{ $product->name }}</td>
                <td>S/{{ $product->unit_price }}</td>
                <td>
                  <button type="button" class="btn btn-primary btn-select-product" data-bs-dismiss="modal">
                    Seleccionar
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
