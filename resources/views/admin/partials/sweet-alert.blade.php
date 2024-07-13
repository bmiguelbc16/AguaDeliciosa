@push('custom-scripts')
  @if (session('success'))
    <script>
      showCustomToast("{{ session('success') }}", 'success');
    </script>
  @endif

  @if (session('error'))
    <script>
      showCustomToast("{{ session('error') }}", 'error');
    </script>
  @endif
@endpush
