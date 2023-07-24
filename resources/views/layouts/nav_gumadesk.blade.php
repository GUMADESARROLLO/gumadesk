<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
<a class="navbar-brand me-1 me-sm-3" href="home">
  <div class="d-flex align-items-center"><span class="font-sans-serif">GumaStats</span> 
  <div class="spinner visible" id="id_spinner_load">
      <div class="dot1"></div>
      <div class="dot2"></div>
      <div class="dot3"></div>
    </div>
  </div>
</a>

<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

 
  <li class="nav-item dropdown"><a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   
      <div class="d-flex align-items-center position-relative">
        <div class="flex-1">
          <h6 class="mb-0 fw-semi-bold"><div class="stretched-link text-900">{{Session::get('name_session')}}</div></h6>
        </div>
        <div class="avatar avatar-xl ms-3">
          <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}"   />
        </div>
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
      <div class="bg-white dark__bg-1000 rounded-2 py-2">
        <a class="dropdown-item" href="{{ route('ventas') }}"><span class="fas fa-calendar"></span><span> Articulos</span></a>

        @if(Session::get('rol') == '1')
        <a class="dropdown-item" href="{{ route('Comiciones') }}"><span class="fas fa-calendar"></span><span>Comisión</span></a>
        <a class="dropdown-item" href="{{ route('Promocion') }}"><span class="fas fa-calendar"></span><span> Promociones</span></a>
        @endif
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item" >Salir
                <span class="pcoded-micon ml-2">
                    <i class="feather icon-log-out"></i>
                </span>
        </a>
      </div>
    </div>
  </li>
</ul>
</nav>