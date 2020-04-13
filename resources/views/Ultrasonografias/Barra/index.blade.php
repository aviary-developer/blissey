<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/ultrasonografias') !!}>
    Ultrasonografías
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
        <a class="nav-link active" href={!! asset('/ultrasonografias/create') !!}>Nuevo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href={!! asset('/ultrasonografias?estado='.$estadoOpuesto) !!}>
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
			<li class="nav-item">
        <a class="nav-link active" href={!! asset('/ayuda/general?tipo=ultra') !!} target="_blank">Ayuda</a>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>