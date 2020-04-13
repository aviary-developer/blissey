<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/tacs') !!}>
    Tomografía Axial Computarizada
    @if ($create)
      <span class="badge border-success border text-success">
        Nueva
      </span>  
    @else
      <span class="badge border-purple border text-purple">
        Editar
      </span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
			<li class="nav-item">
        <a class="nav-link active" href={!! asset('/ayuda/general?tipo=tac') !!} target="_blank">Ayuda</a>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>