<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/examenesEvaluados?vista=paciente&tipo=tac') !!}>
    TAC
    <span class="badge badge-warning">
      Editar
    </span>
    <span class="badge border-dark border text-dark">
      {{$solicitud->tac->nombre}}
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>