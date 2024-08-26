@include('admin.partials.validation-errors')
<form class="form-order" id="form-order"
  @if (isset($order)) action="{{ route('admin.orders.update', $order) }}"
  @else
      action="{{ route('admin.orders.store') }}" @endif
  method="POST">

  @isset($order)
    @method('patch')
  @endisset

  @csrf

  @php
    $config_date = [
        'dateFormat' => 'd/m/Y',
        'locale' => 'es',
    ];
  @endphp

  <div class="card mb-4">
    <div class="card-body">
      <h6 class="card-title">Datos generales</h6>
      <div class="row">

        <div class="col-sm-3">
          <label class="form-label">N° de documento</label>
          <div class="input-group">
            <input type="number" name="document_number" minlength="8" class="form-control"
              placeholder="N° de documento" aria-label="N° de documento" required
              value="{{ $order->user->document_number ?? '' }}">
            <div class="input-group-prepend">
              <button type="button" class="btn btn-info input-group-text">
                <i data-feather="search"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="name" label="Nombres" placeholder="Nombres" value="{{ $order->user?->name ?? '' }}"
              enable-old-support />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="last_name" label="Apellidos" placeholder="Apellido"
              value="{{ $order->user?->last_name ?? '' }}" enable-old-support />
          </div>
        </div>
        <div class="col-sm-3">
          <x-form.radio-group name="gender" label="Genero" :options="['M' => 'Masculino', 'F' => 'Femenino']" :selected="isset($order) ? $order->user?->gender : 'M'" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <x-form.input-date name="birth_date" :config="$config_date" placeholder="Selecciona una fecha"
            label="Fecha de nacimiento"
            value="{{ old('birth_date', isset($order->user?->birth_date) ? \Carbon\Carbon::parse($order->user?->birth_date)->format('d/m/Y') : '') }}"
            enable-old-suport />
        </div>
        <div class="col-sm-3">
          <x-form.input type="email" name="email" label="Email" placeholder="Email" required
            value="{{ $order->user?->email ?? '' }}" enable-old-support />
        </div>
        <div class="col-sm-3">
          <x-form.input type="password" name="password" label="Contraseña" />
        </div>
        <div class="col-sm-3">
          <x-form.input type="password" name="password_confirmation" label="Confirmar contraseña" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <x-form.input type="number" name="phone_number" label="Teléfono" placeholder="Teléfono"
            value="{{ $order->user->phone_number ?? '' }}" enable-old-support />
        </div>
        <div class="col-sm-3">
          <div class="pt-4">
            <x-form.input-switch name="active" :checked="isset($order) && $order->user->active ? true : (!isset($order) ? 'true' : false)" enable-old-support>
              <x-slot name="appendSlot">
                <label class="form-check-label" for="active">Activo</label>
              </x-slot>
            </x-form.input-switch>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-form.button type="submit" label="Guardar" theme="primary" />
  <x-form.button label="Cancelar" theme="secondary" onclick="window.location = '{{ route('admin.orders.index') }}'" />

</form>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-order-validation.js') }}"></script>
@endpush
