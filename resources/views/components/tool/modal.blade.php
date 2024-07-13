<div {{ $attributes->merge(['class' => $makeModalClass(), 'id' => $id]) }}
  @isset($staticBackdrop) data-bs-backdrop="static" data-bs-keyboard="false" @endisset tabindex="-1"
  aria-labelledby={{ $id }} aria-hidden="true">

  <div class="{{ $makeModalDialogClass() }}">
    <div class="modal-content">

      {{-- Modal header --}}
      <div class="{{ $makeModalHeaderClass() }}">
        <h5 class="modal-title">
          @isset($icon)
            <i class="{{ $icon }} mr-2"></i>
          @endisset
          @isset($title)
            {{ $title }}
          @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>

      {{-- Modal body --}}
      @if (!$slot->isEmpty())
        <div class="modal-body">{{ $slot }}</div>
      @endif

      {{-- Modal footer --}}
      <div class="modal-footer">
        @isset($footerSlot)
          {{ $footerSlot }}
        @else
          <x-form.button class="{{ $makeCloseButtonClass }}" data-bs-dismiss="modal" label="Cerrar" />
        @endisset
      </div>

    </div>
  </div>

</div>
