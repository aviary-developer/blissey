<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href={!! asset('/cajas/'.$detalle->datosCaja->id) !!}>
      @if($tipoArqueo==1)
        Arqueo
      @else
        Operaciones realizadas en
      @endif
          <span class="badge border-success border text-success">
                Caja {{$detalle->datosCaja->nombre}}
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              @if($tipoArqueo==1)
              <a class="nav-link active" target='_blank' href={!! asset('/informe_arqueo') !!}>Reporte</a>
            @else
              <a class="nav-link active" target='_blank' href={!! asset('/buscararqueo/'.$f_apertura.'/2') !!}>Reporte</a>
            @endif
          </li>
      </ul>
      @include('Dashboard.boton_salir')
    </div>
  </nav>
  