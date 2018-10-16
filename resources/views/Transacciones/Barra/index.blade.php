<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/transacciones?tipo='.$tipo) !!}>
    @if($tipo==0)Pedidos
      <span class="badge border-primary border text-primary">Por confirmar</span>
    @endif
    @if($tipo==1)Pedidos
      <span class="badge border-primary border text-success">Confirmados</span>
    @endif
    @if($tipo==2)Ventas
      <span class="badge border-primary border text-success">Realizadas</span>
    @endif
    @if($tipo==3)Ventas
      <span class="badge border-primary border text-danger">Anuladas</span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href={!! asset('/divisiones/create') !!}>Nuevo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reporte</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href={!! asset('/divisiones?estado='.$estadoOpuesto) !!}>
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
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
<input type="hidden" name="u" id="ubi" value="index">
