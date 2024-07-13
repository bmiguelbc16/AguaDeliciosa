@include('admin.partials.validation-errors')
<form class="form-doctor" id="form-doctor"
  @if (isset($doctor)) action="{{ route('admin.doctors.update', $doctor) }}"
  @else
      action="{{ route('admin.doctors.store') }}" @endif
  method="POST">

  @isset($doctor)
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
    {{--  Campos de información general  --}}
    <div class="card-body">
      <h6 class="card-title">Datos generales</h6>
      <div class="row">

        <div class="col-sm-3">
          <label class="form-label">N° de documento</label>
          <div class="input-group">
            <input type="number" name="document_number" minlength="8" class="form-control"
              placeholder="N° de documento" aria-label="N° de documento" required
              value="{{ $doctor->user->document_number ?? '' }}">
            <div class="input-group-prepend">
              <button type="button" class="btn btn-info input-group-text">
                <i data-feather="search"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="name" label="Nombres" placeholder="Nombres" value="{{ $doctor->user?->name ?? '' }}"
              enable-old-support />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="last_name" label="Apellidos" placeholder="Apellido"
              value="{{ $doctor->user?->last_name ?? '' }}" enable-old-support />
          </div>
        </div>
        <div class="col-sm-3">
          <x-form.radio-group name="gender" label="Genero" :options="['M' => 'Masculino', 'F' => 'Femenino']" :selected="isset($doctor) ? $doctor->user?->gender : 'M'" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <x-form.input-date name="birth_date" :config="$config_date" placeholder="Selecciona una fecha"
            label="Fecha de nacimiento"
            value="{{ old('birth_date', isset($doctor->user?->birth_date) ? \Carbon\Carbon::parse($doctor->user?->birth_date)->format('d/m/Y') : '') }}"
            enable-old-suport />
        </div>
        <div class="col-sm-3">
          <x-form.input type="email" name="email" label="Email" placeholder="Email" required
            value="{{ $doctor->user?->email ?? '' }}" enable-old-support />
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
            value="{{ $doctor->user->phone_number ?? '' }}" enable-old-support />
        </div>
        <div class="col-sm-3">
          <div class="pt-4">
            <x-form.input-switch name="active" :checked="isset($doctor) && $doctor->user->active ? true : (!isset($doctor) ? 'true' : false)" enable-old-support>
              <x-slot name="appendSlot">
                <label class="form-check-label" for="active">Activo</label>
              </x-slot>
            </x-form.input-switch>
          </div>
        </div>
        {{--  <div class="col-sm-3">
          <label for="foto" class="form-label">Seleccionar foto:</label>
          <input type="file" id="foto" name="foto" accept="image/*">
        </div>  --}}
      </div>
    </div>

    {{--  campos de redes sociales  --}}
    <div class="card-body">
      <h6 class="card-title">Redes Sociales</h6>
      <div class="row">

        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="facebook" label="Facebook" placeholder="Facebook" value="{{ $doctor->facebook ?? '' }}"
              enable-old-support />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="instagram" label="Instagram" placeholder="Instagram"
              value="{{ $doctor->instagram ?? '' }}" enable-old-support />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="whatsapp" label="Whatsapp" placeholder="Whatsapp" value="{{ $doctor->whatsapp ?? '' }}"
              enable-old-support />
          </div>
        </div>
      </div>

    </div>

    {{--  campos de información academica  --}}
    <div class="card-body">
      <h6 class="card-title">Información Academica</h6>
      <div class="row">
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="university" label="Universidad" placeholder="Facebook"
              value="{{ $doctor->university ?? '' }}" enable-old-support />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="mb-3">
            <x-form.input name="university_studies" label="Estudios Universitarios" placeholder=""
              value="{{ $doctor->university_studies ?? '' }}" enable-old-support />
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-form.button type="submit" label="Guardar" theme="primary" />
  <x-form.button label="Cancelar" theme="secondary"
    onclick="window.location = '{{ route('admin.doctors.index') }}'" />

</form>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-employee-validation.js') }}"></script>
@endpush
