<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href={!! asset('/transacciones?tipo='.$transaccion->tipo) !!}>
      @if($transaccion->tipo==1)
      Pedido
      <span class="badge border-success border text-success">
        Confirmado
      </span>
      @endif
      @if($transaccion->tipo==2)
      Venta
      <span class="badge border-success border text-success">
        Realizada
      </span>
      @endif
      @if($transaccion->tipo==3)
      Venta
      <span class="badge border-danger border text-danger">
        Anulada
      </span>
      @endif
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
          @if($transaccion->tipo==1 || $transaccion->tipo==2)
            <li class="nav-item">
              <a class="nav-link active" href={!! asset('/devoluciones/'.$transaccion->id)!!}>Devoluciones</a>
            </li>
          @endif     
        <li class="nav-item">
          <a class="nav-link active" href={!! asset('#') !!}>Ayuda</a>
        </li>
      </ul>
      @include('Dashboard.boton_salir')
    </div>
  </nav>
  <input type="hidden" name="u" id="ubi" value="show">