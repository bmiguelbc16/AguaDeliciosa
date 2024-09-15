@extends('layout.master')

@section('content')
  @include('admin.partials.validation-errors')

  <form class="form-order" id="form-order"
    @if (isset($order)) action="{{ route('admin.orders.update', $order) }}"
    @method('patch')
  @else
    action="{{ route('admin.orders.store') }}" @endif
    method="POST">
    @csrf

    <div class="card mb-4">
      <div class="card-body">
        <h6 class="card-title">Datos del Pedido</h6>
        <div class="row">
          <!-- Seleccionar Cliente -->
          <div class="col-sm-6">
            <label class="form-label">Cliente</label>
            <select name="client_id" id="client_id" class="form-control" required>
              <option value="">Seleccione un cliente</option>
              @foreach ($clients as $client)
                <option value="{{ $client->id }}" @if (isset($order) && $order->client_id == $client->id) selected @endif>
                  {{ $client->user->fullName() }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Dirección de Entrega -->
          <div class="col-sm-6">
            <label class="form-label">Dirección de Entrega</label>
            <input type="text" name="delivery_address" id="delivery_address" class="form-control"
              value="{{ isset($order) ? $order->delivery_address : '' }}" required>
          </div>

          <!-- Tabla de Productos -->
          <div class="col-md-12">
            <h6 class="card-title">Productos</h6>
            <table class="table" id="products-table">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio Unitario</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <!-- Aquí se agregarán las filas dinámicamente -->
                @if (isset($order) && $order->orderDetails)
                  @foreach ($order->orderDetails as $detail)
                    <tr data-product-id="{{ $detail->product_id }}">
                      <td>{{ $detail->product->name }}</td>
                      <td>S/{{ $detail->product->unit_price }}</td>
                      <td><input type="number" class="form-control quantity-input" name="quantity[]"
                          value="{{ $detail->quantity }}" min="1"></td>
                      <td class="row-total">{{ number_format($detail->product->unit_price * $detail->quantity, 2) }}</td>
                      <td>
                        <button type="button" class="btn btn-danger btn-sm remove-product">Eliminar</button>
                      </td>
                      <input type="hidden" name="product_id[]" value="{{ $detail->product_id }}">
                      <input type="hidden" name="unit_price[]" value="{{ $detail->product->unit_price }}">
                      <!-- Agregar este campo -->
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="add-product-btn">Agregar Producto</button>
          </div>

          <!-- Total Calculado -->
          <div class="col-sm-6">
            <label class="form-label">Total del Pedido</label>
            <input type="text" name="total_amount" id="total" class="form-control"
              value="{{ isset($order) ? $order->total_amount : '0' }}" readonly>
          </div>
        </div>
      </div>
    </div>

    <x-form.button type="submit" label="Guardar" theme="primary" />
    <x-form.button label="Cancelar" theme="secondary" onclick="window.location = '{{ route('admin.orders.index') }}'" />
  </form>

  <!-- Diálogo para Seleccionar Producto -->
  @include('admin.orders.partials.select-product-modal')

@endsection

@push('custom-scripts')
  @include('admin.orders.partials.order-scripts')
@endpush
