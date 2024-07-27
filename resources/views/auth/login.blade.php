@extends('layout.master2')

@section('content')
  <div class="page-content d-flex align-items-center justify-content-center">

    <div class="row w-100 mx-0 auth-page">
      <div class="col-md-10 col-xl-6 mx-auto">
        <div class="card">
          <div class="row">
            <div class="col-md-5 pe-md-0">
              <div class="auth-side-wrapper" style="background-image: url({{ asset('/images/login-admin.png') }})">

              </div>
            </div>
            <div class="col-md-7 ps-md-0">
              <div class="auth-form-wrapper px-4 py-5">
                <a href="#" class="noble-ui-logo d-block mb-2">AGUA DELICIOSA</a>
                <h5 class="text-muted fw-normal mb-4">¡Bienvenido de nuevo al sistema! Ingrese a su cuenta.</h5>
                <form method="POST" action="{{ route('login') }}" class="forms-sample">
                  @csrf
                  @error('email')
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                  <div class="mb-3">
                    <label for="userEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email">
                  </div>
                  <div class="mb-3">
                    <label for="userPassword" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="userPassword"
                      autocomplete="current-password" placeholder="Password">
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="authCheck">
                    <label class="form-check-label" for="authCheck">
                      {{ __('Recuerdame') }}
                    </label>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-primary">
                      {{ __('Ingresar') }}
                    </button>
                    @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Olvido la contraseña?') }}
                      </a>
                    @endif
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
