<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="{{ env('APP_DESCRIPTION', 'Laravel APP') }}">
  <meta name="author" content="Devs">
  <meta name="keywords" content="">

  <title>{{ env('APP_NAME', 'Laravel APP') }} | {{ __('messages.welcome') }} </title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  @foreach (config('globals.libraries') as $library)
    @foreach ($library['css'] as $css)
      <link rel="stylesheet" href="{{ asset($css) }}">
    @endforeach
  @endforeach

  @stack('plugin-styles')
  @yield('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')
</head>

<body class="sidebar-dark" data-base-url="{{ url('/') }}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  @include('admin.partials.sweet-alert')

  <div class="main-wrapper" id="app">
    @include('layout.menu')
    <div class="page-wrapper">
      @include('layout.header')
      <div class="page-content">
        @yield('content')
      </div>
      @include('layout.footer')
    </div>
  </div>

  <!-- base js -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <!-- end base js -->

  @foreach (config('globals.libraries') as $library)
    @foreach ($library['js'] as $js)
      <script src="{{ asset($js) }}"></script>
    @endforeach
  @endforeach

  <!-- plugin js -->
  @stack('plugin-scripts')
  @yield('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <!-- end common js -->

  @stack('custom-scripts')
</body>

</html>
