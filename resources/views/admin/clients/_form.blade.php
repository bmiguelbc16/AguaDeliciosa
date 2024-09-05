@include('admin.partials.validation-errors')
<form class="forms-sample" id="form-client"
  @if (isset($client)) action="{{ route('admin.clients.update', $client) }}"
  @else
      action="{{ route('admin.clients.store') }}" @endif
  method="POST">

  @if (isset($client))
    @method('patch')
  @endif
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

      <div id="personFields">
        <div class="row">

          <div class="col-sm-4">
            <label class="form-label">N° de documento</label>
            <div class="input-group">
              <input type="number" name="document_number" minlength="8" class="form-control"
                placeholder="N° de documento" aria-label="N° de documento" required
                value="{{ $client->user->document_number ?? '' }}">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-info input-group-text">
                  <i data-feather="search"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <x-form.input name="name" label="Nombres" placeholder="Nombres" value="{{ $client->user->name ?? '' }}"
              enable-old-support />
          </div>

          <div class="col-sm-3">
            <div class="mb-3">
              <x-form.input name="last_name" label="Apellidos" placeholder="Apellidos"
                value="{{ $client->user?->last_name ?? '' }}" enable-old-support />
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-sm-4">
            <x-form.radio-group name="gender" label="Genero" :options="['M' => 'Masculino', 'F' => 'Femenino']" :selected="isset($client) ? $client->user?->gender : 'M'" />
          </div>

          <div class="col-sm-4">
            <x-form.input-date name="birth_date" :config="$config_date" placeholder="Selecciona una fecha"
              label="Fecha de nacimiento"
              value="{{ old('birth_date', isset($client->user->birth_date) ? \Carbon\Carbon::parse($client->user->birth_date)->format('d/m/Y') : '') }}"
              enable-old-suport />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-body">

      <h6 class="card-title">Datos de contacto</h6>

      <div class="row">

        <div class="col-sm-4">
          <x-form.input type="number" name="phone" label="Teléfono" placeholder="Teléfono"
            value="{{ $client->user->phone_number ?? '' }}" enable-old-support />
        </div>

      </div>
    </div>
  </div>

  <x-form.button type="submit" label="Guardar" theme="primary" />
  <x-form.button label="Cancelar" theme="secondary" onclick="window.location = '{{ route('admin.clients.index') }}'" />

</form>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-client-validation.js') }}"></script>
@endpush
