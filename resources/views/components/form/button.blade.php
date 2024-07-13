<button type="{{ $type }}" {{ $attributes->merge(['class' => "btn btn-{$theme}"]) }}>
  @isset($icon)
    <i data-feather="{{ $icon }}"></i>
  @endisset
  @isset($label)
    {{ $label }}
  @endisset
</button>
