@extends('layouts.lyt_gumadesk')
@section('content')    
<main class="main" id="top">
  <div class="container-fluid">
    <div class="row min-vh-100 flex-center g-0">
      <div class="col-lg-8 col-xxl-5 py-3 position-relative">
          <img class="bg-auth-circle-shape" src="{{ asset('images/theme_gumadesk/bg-shape.png') }}" alt="" width="250">
          <img class="bg-auth-circle-shape-2" src="{{ asset('images/theme_gumadesk/shape-1.png') }}" alt="" width="150">
        <div class="card overflow-hidden z-index-1">
          <div class="card-body p-0">
            <div class="row g-0 h-100">
              <div class="col-md-5 text-center bg-card-gradient">
                <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                  <div class="bg-holder bg-auth-card-shape" style="background-image:url({{ asset('images/theme_gumadesk/half-circle.png') }});"></div>
                  <div class="z-index-1 position-relative"><a class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder" href="./">GumaDesk</a>
                    <p class="opacity-75 text-white">Genere sus solicitudes de manera practica y directa hacia las personas correspondientes</p>
                  </div>
                </div>
                <div class="mt-3 mb-4 mt-md-4 mb-md-5 light">
                  <p class="text-white">¿No tiene cuenta?<br><a class="text-decoration-underline link-light" href="../../../pages/authentication/card/register.html">Solicita </a></p>
                  <p class="mb-0 mt-4 mt-md-5 fs--1 fw-semi-bold text-white opacity-75">Todos los Derechos Reservados </a></p>
                </div>
              </div>
              <div class="col-md-7 d-flex flex-center">
                <div class="p-4 p-md-5 flex-grow-1">
                  <div class="row flex-between-center">
                    <div class="col-auto">
                      <h3>Formulario Acceso</h3>
                    </div>
                  </div>
                  <form method="POST" action="{{ route('login') }}">
                  @csrf
                    <div class="mb-3">
                    <label class="form-label" for="username">Usuario</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Nombre de usuario">

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3">
                    <div class="d-flex justify-content-between">
                            <label class="form-label" for="card-password">Contraseña</label>
                          </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="row flex-between-center">
                      <div class="col-auto">
                        <div class="form-check mb-0">
                          
                          <label class="form-check-label mb-0" for="card-checkbox"></label>
                        </div>
                      </div>
                      
                    </div>
                    <div class="mb-3">
                      <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">
                      {{ __('Inicio') }}
                      </button>
                    </div>
                  </form>
                  <div class="position-relative mt-4">
                    <hr class="bg-300" />
                    <div class="divider-content-center"></div>
                  </div>
                  <div class="row g-2 mt-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
