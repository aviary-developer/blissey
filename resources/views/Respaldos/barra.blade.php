<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/respaldos') !!}>
    Administración de Base de Datos
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="confirmarRespaldo()">Nuevo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-respaldo">Subir</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href={!! asset('/ayuda/basedatos') !!} target="_blank">Ayuda</a>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>