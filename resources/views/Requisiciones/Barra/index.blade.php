<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/requisiciones') !!}>
    Requisiciones Enviadas
    @if ($tipo == 4)
      <span class="badge border-danger border text-danger">
        Pendientes
      </span>  
    @elseif ($tipo == 5)
      <span class="badge border-primary border text-primary">
        Atendidas
      </span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active" href={!! asset('/requisiciones/create') !!}>Nuevo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href={!! asset('/requisiciones?tipo='.$estadoOpuesto) !!}>
            @if ($estadoOpuesto==5)
							Atendidas
							<span class="badge badge-success float-right">{{ App\Transacion::whereIn('tipo',[5,6])->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
						@else
							Pendientes
							<span class="badge badge-warning float-right">{{ App\Transacion::where('tipo',4)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
						@endif
          </a>  
        </div>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>