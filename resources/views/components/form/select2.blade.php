@extends('components.form.input-group-component')

{{-- Set errors bag internallly --}}

@php($setErrorsBag($errors ?? null))

{{-- Set input group item section --}}

@section('input_group_item')

  {{-- Select --}}
  <select id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => $makeItemClass()]) }}>
    {{ $slot }}
  </select>

@overwrite

{{-- Add plugin initialization and configuration code --}}

@push('plugin-scripts')
  <script>
    $(() => {
      $('#{{ $id }}').select2(@json($config));

      // Add support to auto select old submitted values in case of
      // validation errors.

      @if ($errors->any() && $enableOldSupport)

        let oldOptions = @json(collect($getOldValue($errorKey)));

        $('#{{ $id }} option').each(function() {
          let value = $(this).val() || $(this).text();
          $(this).prop('selected', oldOptions.includes(value));
        });

        $('#{{ $id }}').trigger('change');
      @endif
    })
  </script>
@endpush

{{-- CSS workarounds for the Select2 plugin --}}
{{-- NOTE: this may change with newer plugin versions --}}

@once
  @push('plugin-styles')
    <style type="text/css">

    </style>
  @endpush
@endonce
