<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
    @if (!$componente->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <a class="navbar-brand" href={!! asset('/transacciones?tipo='.$transaccion->tipo) !!}>
      Componente
      <span class="badge border-info border text-info">
        Información
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href={!! asset('/componentes/'.$componente->id.'/edit') !!}>Editar</a>
        </li>
        @if ($componente->estado)
          <li class="nav-item">
            <a class="nav-link" href="#" onclick={{"baja(".$componente->id.")"}}>Papelera</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="#" onclick={!! "'alta(".$componente->id.");'"!!}>Activar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  onclick={!! "'eliminar(".$componente->id.");'" !!}>Eliminar</a>
          </li>
              @endif
              <li class="nav-item">
          <a class="nav-link" href={!! asset('/ayuda/general?tipo=componentes') !!} target="_blank">Ayuda</a>
        </li>
      </ul>
      @include('Dashboard.boton_salir')
    </div>
  </nav>
  <input type="hidden" name="u" id="ubi" value="show">