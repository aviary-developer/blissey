  <nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
      <a class="navbar-brand" href={!! asset('/detalleCajas/create') !!}>
        Estado de caja
        @if (!$apertura)
          <span class="badge border-danger border text-danger">
            Cerrada
          </span>
        @else
          <span class="badge border-primary border text-primary">
            Abierta
          </span>
        @endif
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
          {{-- <li class="nav-item">
            <a class="nav-link active" href="#">Reporte</a>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ir a...
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href={!! asset('/transacciones?tipo=0') !!}>
                Pedidos por confirmar
              </a>
              <a class="dropdown-item" href={!! asset('/transacciones/create?tipo=2') !!}>
                Realizar venta
              </a>
            </div>
          </li>
        </ul>
        @include('Dashboard.boton_salir')
      </div>
    </nav>
    <input type="hidden" name="u" id="ubi" value="index">
    