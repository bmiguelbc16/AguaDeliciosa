{{-- Setup the input group component structure --}}

<div class="{{ $makeFormGroupClass() }}">

  {{-- Input label --}}
  @isset($label)
    <label for="{{ $id }}" class="form-label {{ $labelClass ?? '' }}">
      {{ $label }}
    </label>
  @endisset

  {{-- Input group --}}
  <div class="{{ $makeInputGroupClass() }}">

    {{-- Input prepend slot --}}
    @isset($prependSlot)
      <div class="input-group-prepend">{{ $prependSlot }}</div>
    @endisset

    {{-- Input group item --}}
    @yield('input_group_item')

    {{-- Input append slot --}}
    @isset($appendSlot)
      <div class="input-group-append">{{ $appendSlot }}</div>
    @endisset

  </div>

  {{-- Error feedback --}}
  @if ($isInvalid())
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $errors->first($errorKey) }}</strong>
    </span>
  @endif

  {{-- Bottom slot --}}
  @isset($bottomSlot)
    {{ $bottomSlot }}
  @endisset

</div>

{{-- Extra style customization for invalid input groups --}}

@once
  @push('plugin-styles')
    <style type="text/css">
      {{-- Highlight invalid input groups with a box-shadow --}} .form-invalid-igroup {
        box-shadow: 0 .25rem 0.5rem rgba(0, 0, 0, .1);
      }

      {{-- Setup a red border on elements inside prepend/append add-ons --}} .form-invalid-igroup>.input-group-prepend>*,
      .form-invalid-igroup>.input-group-append>* {
        border-color: #dc3545 !important;
      }
    </style>
  @endpush
@endonce
