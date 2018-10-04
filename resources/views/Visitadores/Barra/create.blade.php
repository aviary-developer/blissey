<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/visitadores?estado='.$estado.'&id='.$id) !!}>
    Visitador
      @if ($bandera==1)
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
    @include('Dashboard.boton_salir')
  </div>
</nav>
