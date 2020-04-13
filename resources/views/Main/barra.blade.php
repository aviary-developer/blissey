<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/') !!}>
    Inicio
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
			@if (Auth::user()->tipoUsuario == "Recepción")
				<li class="nav-item">
					<a class="nav-link active" href={!! asset('#') !!} data-target="#turno" data-toggle="modal">Reporte de turno</a>
				</li>
			@endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
@include('Main.modal_turno')