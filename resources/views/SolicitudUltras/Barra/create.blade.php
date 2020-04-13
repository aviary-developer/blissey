<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/solicitudex?tipo=ultras') !!}>
    Ultrsonografía
    <span class="badge badge-primary">
      Solcitud
    </span>
    <span class="badge border-success border text-success">
      Nueva
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Nuevo
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a href="#" class="dropdown-item" data-target="#modal_paciente_mini" data-toggle="modal">
            Paciente
          </a>
        </div>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>