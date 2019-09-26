<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/habitaciones') !!}>
    Habitaciones
    @if ($estadoOpuesto)
      <span class="badge border-danger border text-danger">
        Papelera
      </span>  
    @else
      <span class="badge border-primary border text-primary">
        Activas
      </span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href={!! asset('/habitaciones/create') !!}>Nuevo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					@if ($tipo > -1)
						<a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto)) !!} class="dropdown-item">Todos</a>    
					@endif
					<a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto).'&tipo=1') !!} class="dropdown-item">Ingreso</a>
					<a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto).'&tipo=0') !!} class="dropdown-item">Observación</a>
					{{--  <a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto).'&tipo=2') !!} class="dropdown-item">Medio ingreso</a>  --}}
					<div class="dropdown-divider"></div>
          <a class="dropdown-item" href={!! asset('/habitaciones?estado='.$estadoOpuesto) !!}>
            @if ($estadoOpuesto)
              Activas
              <span class="badge badge-primary float-right">
                {{$activos}}
              </span>
            @else
              Papelera
              <span class="badge badge-warning float-right">
                {{$inactivos}}
              </span>
            @endif
          </a>  
        </div>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>