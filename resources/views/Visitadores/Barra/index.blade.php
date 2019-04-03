<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/proveedores') !!}>
    Visitadores
    @if ($estadoOpuesto)
      <span class="badge border-danger border text-danger">
        Papelera
      </span>
    @else
      <span class="badge border-primary border text-primary">
        Activos
      </span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href={!! asset('/visitadores/create?id='.$id_proveedor) !!}>Nuevo</a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="#">Reporte</a>
      </li> --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href={!! asset('/visitadores?estado='.$estadoOpuesto.'&id='.$id_proveedor) !!}>
            @if ($estadoOpuesto)
              Activos
              <span class="badge badge-primary float-right">
                {{$activos}}
              </span>
            @else
              Papelera
              <span class="badge badge-warning float-right">
                {{$inactivos}}
              </span>
            @endif
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href={!! asset('/ayuda/general?tipo=visitadores') !!} target="_blank">Ayuda</a>            
      </li>
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
<input type="hidden" name="u" id="ubi" value="index">
