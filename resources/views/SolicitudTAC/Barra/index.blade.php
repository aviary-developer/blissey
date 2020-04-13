<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/solicitudex?tipo=tac') !!}>
    TAC
    @if ($est =="evaluados")
      <span class="badge badge-success">
        Evaluados
      </span>
    @elseif($est == "entregados")
      <span class="badge badge-info">
        Entregados
      </span>
    @else
      <span class="badge badge-primary">
        Solcitudes
      </span>
    @endif
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
        <a class="nav-link active" href={!! asset('/solicitudex/create?tipo=tac') !!}>Nuevo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          @if ($est == "solicitudes")
            <a class="dropdown-item" href={!! asset('/examenesEvaluados?vista='.$vista.'&tipo=tac') !!}>
              Evaluados
            </a>
            <a class="dropdown-item" href={!! asset('/examenesEntregados?vista='.$vista.'&tipo=tac') !!}>
              Entregados
            </a>
          @elseif($est == "entregados")
            <a class="dropdown-item" href={!! asset('/solicitudex?vista='.$vista.'&tipo=tac') !!}>
              Solicitudes
            </a>
            <a class="dropdown-item" href={!! asset('/examenesEvaluados?vista='.$vista.'&tipo=tac') !!}>
              Evaluados
            </a>
          @else
            <a class="dropdown-item" href={!! asset('/solicitudex?vista='.$vista.'&tipo=tac') !!}>
              Solicitudes
            </a>
            <a class="dropdown-item" href={!! asset('/examenesEntregados?vista='.$vista.'&tipo=tac') !!}>
              Entregados
            </a>
          @endif  
          <div class="dropdown-divider"></div>
          @if ($est == "evaluados")
            <a class="dropdown-item" href={!! asset('/examenesEvaluados?tipo=tac&vista='.(($vista!="paciente")?"paciente":"")) !!}>
          @elseif($est == "entregados")
            <a class="dropdown-item" href={!! asset('/examenesEntregados?tipo=tac&vista='.(($vista!="paciente")?"paciente":"")) !!}>
          @else
            <a class="dropdown-item" href={!! asset('/solicitudex?tipo=tac&vista='.(($vista!="paciente")?"paciente":"")) !!}>
          @endif
            @if ($vista != "paciente")
              Por Paciente
            @else
              Por Exámenes
            @endif
          </a> 
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href={!! asset('/ayuda/solicitudExamenes') !!} target="_blank">Ayuda</a>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>