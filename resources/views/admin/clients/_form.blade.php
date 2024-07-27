@include('admin.partials.validation-errors')
<form class="forms-sample" id="form-client"
  @if (isset($client)) action="{{ route('admin.clients.update', $client) }}"
  @else
      action="{{ route('admin.clients.store') }}" @endif
  method="POST" enctype="multipart/form-data">

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
                value="{{ $client->clientable->document_number ?? '' }}">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-info input-group-text">
                  <i data-feather="search"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <x-form.input name="first_name" label="Nombre" placeholder="Nombre"
              value="{{ $client->clientable->first_name ?? '' }}" enable-old-support />
          </div>

          <div class="col-sm-4">
            <x-form.input name="last_name_father" label="Apellido paterno" placeholder="Apellido paterno"
              value="{{ $client->clientable->last_name_father ?? '' }}" enable-old-support />
          </div>

        </div>

        <div class="row">
          <div class="col-sm-4">
            <x-form.input name="last_name_mother" label="Apellido materno" placeholder="Apellido materno"
              value="{{ $client->clientable->last_name_mother ?? '' }}" enable-old-support />
          </div>

          <div class="col-sm-4">
            <x-form.radio-group name="gender" label="Genero" :options="['M' => 'Masculino', 'F' => 'Femenino']" :selected="isset($client) ? $client->user?->gender : 'M'" />
          </div>

          <div class="col-sm-4">
            <x-form.input-date name="birth_date" :config="$config_date" placeholder="Selecciona una fecha"
              label="Fecha de nacimiento"
              value="{{ old('birth_date', isset($client->clientable->birth_date) ? \Carbon\Carbon::parse($client->clientable->birth_date)->format('d/m/Y') : '') }}"
              enable-old-suport />
          </div>
        </div>
      </div>

      <div id="companyFields" style="display:none;">
        <div class="row">
          <div class="col-sm-4">
            <label class="form-label">N° de RUC</label>
            <div class="input-group">
              <input type="number" name="ruc" minlength="8" class="form-control" placeholder="N° de RUC"
                aria-label="N° de RUC" required value="{{ $client->clientable->ruc ?? '' }}">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-info input-group-text">
                  <i data-feather="search"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <x-form.input name="company_name" label="Razon social" placeholder="Razon social"
              value="{{ $client->clientable->company_name ?? '' }}" enable-old-support />
          </div>

          <div class="col-sm-4">
            <x-form.input name="social_name" label="Nombre de Negocio" placeholder="Nombre de Negocio"
              value="{{ $client->clientable->social_name ?? '' }}" enable-old-support />
          </div>

        </div>

        <div class="row">
          <div class="col-sm-4">
            <x-form.input name="ubigeo_code" label="Ubigeo" placeholder="Ubigeo"
              value="{{ $client->clientable->ubigeo_code ?? '' }}" enable-old-support />
          </div>

          <div class="col-sm-4">
            <x-form.input name="representative" label="Representante" placeholder="Representante"
              value="{{ $client->clientable->representative ?? '' }}" enable-old-support />
          </div>

          <div class="col-sm-4">
            <x-form.input name="representative_position" label="Cargo" placeholder="Cargo"
              value="{{ $client->clientable->representative_position ?? '' }}" enable-old-support />
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
  <x-form.button label="Cancelar" theme="secondary"
    onclick="window.location = '{{ route('admin.clients.index') }}'" />

</form>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-client-validation.js') }}"></script>
@endpush
