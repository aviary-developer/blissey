<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/ingresos') !!}>
    Hospitalización y consultas
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="btn btn-outline-success btn-sm" href={!! asset('#') !!} data-target="#calculadora" data-toggle="modal">
						Calculadora
				</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-outline-success btn-sm" href="#" data-toggle="modal" data-target="#filtro_pac" id="abrir_filtro">Buscar paciente</a>
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
@include('Ingresos.index.modal.calculadora')
@php
    $estadoOpuesto=0;
    $fin=0;
    $inicio=2020;
    $desde=0;
    $hasta=2020;
@endphp
@include('Pacientes.Formularios.modal_filtro')