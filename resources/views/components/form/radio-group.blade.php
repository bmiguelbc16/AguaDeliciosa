<div class="mb-3">
  @isset($label)
    <label for="{{ $id }}" class="form-label {{ $labelClass ?? '' }}">
      {{ $label }}
    </label>
  @endisset
  <div>
    @foreach ($options as $value => $label)
      <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" name="{{ $name }}"
          id="{{ $name }}_{{ $value }}" value="{{ $value }}"
          {{ $value == $selected ? 'checked' : '' }}>
        <label class="form-check-label" for="{{ $name }}_{{ $value }}">
          {{ $label }}
        </label>
      </div>
    @endforeach
  </div>
  {{-- Error feedback --}}
  @if ($isInvalid())
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $errors->first($errorKey) }}</strong>
    </span>
  @endif
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
