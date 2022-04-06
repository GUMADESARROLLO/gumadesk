<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: #3f4d67;color: #a9b7d0;">
    <a class="ml-4 font-weight-bold  text-light " href="home">IMPORTACIONES</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
            @if(Auth::User()->activeRole()== 1 )
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-cog"></i> Configuracióon 
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">    
                    <a class="dropdown-item waves-effect waves-light" href="rol">
                            <i class="fas fa-user mr-2"></i> Rol
                    </a>
                    <a class="dropdown-item waves-effect waves-light" href="menu">
                        <i class="fas fa-user mr-2"></i> Menu                    
                    </a>
                    <a class="dropdown-item waves-effect waves-light" href="usuario">
                        <i class="fas fa-user mr-2"></i> Usuarios                    
                    </a>            
                </div>
            </li>
            @endif     
            <li class="nav-item active">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="nav-link waves-effect waves-light" >
                    <i  class="feather icon-log-out mr-2"></i> Salir            
                </a>
            </li>
            
        </ul>
    </div>
</nav>