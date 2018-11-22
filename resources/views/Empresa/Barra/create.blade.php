<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/grupo_promesa') !!}>
    Grupo Promesa
    @if ($create)
      <span class="badge border-success border text-success">
        Nuevo
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

    </ul>
    @if(Auth::check())
      @include('Dashboard.boton_salir')
    @endif
  </div>
</nav>