<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  @if ($solicitud->estado == 2)  
    <a class="navbar-brand" href={!! asset('/examenesEvaluados?tipo=examenes&vista=paciente') !!}>
  @else
    <a class="navbar-brand" href={!! asset('/examenesEntregados?vista=paciente') !!}>
  @endif
    Laboratorio Clínico
    <span class="badge badge-info">
      Información
    </span>
    <span class="badge border-dark border text-dark">
      {{$solicitud->examen->nombreExamen}}
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      @if ($solicitud->estado == 2)
        <li class="nav-item">
          <a class="nav-link active" href= {!! asset('/editarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!}>Editar</a>
        </li>
      @endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>