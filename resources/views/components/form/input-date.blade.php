@extends('components.form.input-group-component')

{{-- Set errors bag internallly --}}

@php($setErrorsBag($errors ?? null))

{{-- Set input group item section --}}

@section('input_group_item')

  {{-- Input Date --}}
  <input type="text" id="{{ $id }}" name="{{ $name }}" data-target="#{{ $id }}" data-input
    {{ $attributes->merge(['class' => $makeItemClass()]) }}>
  <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>

@overwrite

{{-- Add plugin initialization and configuration code --}}

@push('plugin-scripts')
  <script>
    $(() => {

      let usrCfg = _Custom_InputDate.parseCfg(@json($config));
      $('#{{ $id }}').flatpickr(usrCfg);

      // Add support to auto display the old submitted value or values in case
      // of validation errors.

      let value = @json($getOldValue($errorKey, $attributes->get('value')));
      $('#{{ $id }}').val(value || "");
    })
  </script>
@endpush

{{-- Register Javascript utility class for this component --}}

@once
  @push('plugin-scripts')
    <script>
      class _Custom_InputDate {

        /**
         * Parse the php plugin configuration and eval the javascript code.
         *
         * cfg: A json with the php side configuration.
         */
        static parseCfg(cfg) {
          for (const prop in cfg) {

            let v = cfg[prop];

            if (typeof v === 'string' && v.startsWith('js:')) {
              cfg[prop] = eval(v.slice(3));
              console.log(v);
            } else if (typeof v === 'object') {
              cfg[prop] = _Custom_InputDate.parseCfg(v);
            }
          }

          return cfg;
        }
      }
    </script>
  @endpush
@endonce
