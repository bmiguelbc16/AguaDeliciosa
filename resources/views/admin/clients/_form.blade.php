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
      <div class="row">
        <div class="col-sm-12">
          <x-form.select2 name="type" label="Tipo de cliente" data-placeholder="Seleccione opción" enable-old-support>
            <x-form.options :options="$options_type_client" :selected="isset($client) ? strtolower($client?->clientable_type_name) : 'person'" empty-option />
          </x-form.select2>
        </div>
      </div>

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
            <x-form.radio-group name="gender" label="Genero" :options="['M' => 'Masculino', 'F' => 'Femenino']" :selected="isset($client) ? $client->clientable->gender : null" />
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
            value="{{ $client->clientable->phone ?? '' }}" enable-old-support />
        </div>
        <div class="col-sm-4">
          <x-form.select2 name="street_id" label="Calle" data-placeholder="Seleccione opción" enable-old-support>
            <x-form.options :options="$streets" :selected="isset($client) ? $client?->street?->id : null" empty-option />
          </x-form.select2>
        </div>
        <div class="col-sm-4">
          <x-form.input type="number" name="number_block" label="Número de Cuadra" placeholder="Número de Cuadra"
            value="{{ $client->number_block ?? '' }}" enable-old-support />
        </div>
      </div>

      <div class="row">
        <div class="col-sm-4">
          <x-form.input type="number" name="number_house" label="Número de casa" placeholder="Número de casa"
            value="{{ $client->number_house ?? '' }}" enable-old-support />
        </div>

        <div class="col-sm-4">
          <x-form.input name="latitude" label="Latitud" placeholder="Latitud" value="{{ $client->latitude ?? '' }}"
            enable-old-support />
        </div>

        <div class="col-sm-4">
          <x-form.input name="longitude" label="Longitud" placeholder="Longitud"
            value="{{ $client->longitude ?? '' }}" enable-old-support />
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <x-form.input name="reference" label="Referencia" placeholder="Referencia"
            value="{{ $client->reference ?? '' }}" enable-old-support />
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <h6 class="card-title">Recibo digital</h6>
      <div class="row">
        <div class="col-sm-12">
          <x-form.input-switch name="digital_invoice" :checked="isset($client) && $client->digital_invoice ? true : (!isset($client) ? false : false)" enable-old-support>
            <x-slot name="appendSlot">
              <label class="form-check-label" for="digital_invoice">Desea que se le remita recibo digital?</label>
            </x-slot>
          </x-form.input-switch>
        </div>
      </div>

      <div id="digitalInvoiceFields"
        style="{{ isset($client) && $client->digital_invoice ? 'display: block;' : 'display: none;' }}">
        <div class="row">
          <div class="col-sm-6">
            <x-form.input name="email" label="Correo" placeholder="Correo" value="{{ $client->email ?? '' }}"
              enable-old-support />
          </div>

          <div class="col-sm-6">
            <x-form.input name="whatsapp" label="Whatsapp" placeholder="Whatsapp"
              value="{{ $client->whatsapp ?? '' }}" enable-old-support />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <h6 class="card-title">Casilla electrónica</h6>
      <div class="row">
        <div class="col-sm-4">
          <x-form.input-switch name="mail_box" :checked="isset($client) && $client->mail_box ? true : (!isset($client) ? false : false)" enable-old-support>
            <x-slot name="appendSlot">
              <label class="form-check-label" for="mail_box">Casilla Electronica?</label>
            </x-slot>
          </x-form.input-switch>
        </div>
        <div class="col-sm-4">
          <x-form.input type="file" name="affidavit_file" label="Declaración Jurada"
            placeholder="Declaración Jurada" value="{{ $client->file->original_name ?? '' }}" enable-old-support />

          @if (isset($client) && $client->file)
            <p>Archivo PDF Actual: {{ $client->file->original_name }}</p>
            <a href="{{ asset('storage/' . $client->file->path) }}" target="_blank">Ver PDF</a>
          @endif
        </div>
        <div class="col-sm-4">
          <x-form.input-switch name="active" :checked="isset($client) && $client->active ? true : (!isset($client) ? 'true' : false)" enable-old-support>
            <x-slot name="appendSlot">
              <label class="form-check-label" for="active">Activo</label>
            </x-slot>
          </x-form.input-switch>
        </div>
      </div>
    </div>
  </div>

  <x-form.button type="submit" label="Guardar" theme="primary" />
  <x-form.button label="Cancelar" theme="secondary"
    onclick="window.location = '{{ route('admin.clients.index') }}'" />

</form>

@push('custom-scripts')
  <script>
    $(document).ready(function() {
      $('#type').change(function() {
        if ($(this).val() == 'person') {
          $('#personFields').show();
          $('#companyFields').hide();
        } else {
          $('#personFields').hide();
          $('#companyFields').show();
        }
      });

      $('#type').trigger('change');


      $('#digital_invoice').change(function() {

        if ($(this).is(":checked")) {
          $('#digitalInvoiceFields').show();
          $('#digitalInvoiceFields input').prop('disabled', false);
        } else {
          $('#digitalInvoiceFields').hide();
          $('#digitalInvoiceFields input').prop('disabled', true);
        }

      });

      $('#type').trigger('change');

    });
  </script>
@endpush

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-client-validation.js') }}"></script>
@endpush
