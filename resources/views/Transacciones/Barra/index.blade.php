<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/transacciones?tipo='.$tipo) !!}>
    @if($tipo==0)Pedidos
      <span class="badge border-primary border text-primary">Por confirmar</span>
    @endif
    @if($tipo==1)Pedidos
      <span class="badge border-success border text-success">Confirmados</span>
    @endif
    @if($tipo==2)Ventas
      <span class="badge border-success border text-success">Realizadas</span>
    @endif
    @if($tipo==3)Ventas
      <span class="badge border-danger border text-danger">Anuladas</span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
@if($tipo==0)
  <li class="nav-item">
    <a class="nav-link active" href={!! asset('/transacciones/create?tipo='.$tipo) !!}>Nuevo</a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link active" href={!! asset('#') !!}>Reporte</a>
  </li> --}}
  <li class="nav-item dropdown">
    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ver
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href={!! asset('/transacciones?tipo=1') !!}>
        Confirmados
        <span class="badge badge-success float-right">
          {{ App\Transacion::where('tipo',1)->where('localizacion',App\Transacion::tipoUsuario())->count() }}
        </span>
      </a>
    </div>
  </li>
@endif

@if($tipo==1)
  {{-- <li class="nav-item">
    <a class="nav-link active" href={!! asset('#') !!}>Reporte</a>
  </li> --}}
  <li class="nav-item dropdown">
    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ver
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href={!! asset('/transacciones?tipo=0') !!}>
        Por confirmar
        <span class="badge badge-primary float-right">
          {{ App\Transacion::where('tipo',0)->where('localizacion',App\Transacion::tipoUsuario())->count() }}
        </span>
      </a>
    </div>
  </li>
@endif

@if($tipo==2)
  <li class="nav-item">
    <a class="nav-link active" href={!! asset('/transacciones/create?tipo='.$tipo) !!}>Nuevo</a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link active" href={!! asset('#') !!}>Reporte</a>
  </li> --}}
  <li class="nav-item dropdown">
    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ver
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href={!! asset('/transacciones?tipo=3') !!}>
        Anuladas
        <span class="badge badge-danger float-right">
          {{ App\Transacion::where('tipo',3)->where('localizacion',App\Transacion::tipoUsuario())->count() }}
        </span>
      </a>
    </div>
  </li>
@endif

@if($tipo==3)
  {{-- <li class="nav-item">
    <a class="nav-link active" href={!! asset('#') !!}>Reporte</a>
  </li> --}}
  <li class="nav-item dropdown">
    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ver
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href={!! asset('/transacciones?tipo=2') !!}>
        Realizadas
        <span class="badge badge-success float-right">
          {{ App\Transacion::where('tipo',2)->where('localizacion',App\Transacion::tipoUsuario())->count() }}
        </span>
      </a>
    </div>
  </li>
@endif
<li class="nav-item">
    <a class="nav-link active" href={!! asset('/ayuda/transacciones') !!} target="_blank">Ayuda</a>            
</li>
</ul>
@include('Dashboard.boton_salir')
</div>
</nav>
<input type="hidden" name="u" id="ubi" value="index">
