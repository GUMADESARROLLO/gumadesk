<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

<button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
<a class="navbar-brand me-1 me-sm-3" href="dashboard">
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
      <div class="avatar avatar-xl">
        <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}" />
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
      <div class="bg-white dark__bg-1000 rounded-2 py-2">
       <!--<div class="bg-white dark__bg-1000 rounded-2 py-2">
      <a class="dropdown-item fw-bold text-warning" href="#!"><span class="fas fa-crown me-1"></span><span>Nombre Usuario</span></a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="tickets">Vista Usuario</a>
      <a class="dropdown-item" href="stats">eSTADISTICAS</a>
        <a class="dropdown-item" href="UnidadNegocio">Unidades de Negocio</a>
        <a class="dropdown-item" href="Departamentos">Departamentos</a>
        <a class="dropdown-item" href="categorias">Categorias</a>
        <a class="dropdown-item" href="Usuarios">Usuarios</a>-->
        <a class="dropdown-item" href="ventas">Articulos  / Viñetas</a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit()">Salir
                <span class="pcoded-micon ml-2">
                    <i class="feather icon-log-out"></i>
                </span>
        </a>
      </div>
    </div>
  </li>
</ul>
</nav>