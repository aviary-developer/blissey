<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/solicitudex?tipo=examenes') !!}>
    Laboratorio Clínico
    <span class="badge badge-primary">
      Solcitudes
    </span>
    @if ($vista == "paciente")
      <span class="badge border-info border text-info">
        Paciente
      </span>  
    @else
      <span class="badge border-primary border text-primary">
        Exámenes
      </span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href={!! asset('/solicitudex/create?tipo=examenes') !!}>Nuevo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href={!! asset('/solicitudex?tipo=examenes&vista='.(($vista!="paciente")?"paciente":"")) !!}>
            @if ($vista != "paciente")
              Por Paciente
            @else
              Por Exámenes
            @endif
          </a>  
        </div>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>