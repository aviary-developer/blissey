@if(Auth::user()->tipoUsuario == "Farmacia")
  @php
    $conteoas= App\Transacion::where('tipo',5)->where('localizacion',0)->count();
    $ultima1= App\Transacion::where('tipo',5)->where('localizacion',0)->orderBy('id','asc')->get()->last();
    $conteore= App\Transacion::where('tipo',4)->where('localizacion',1)->count();
    $ultima2= App\Transacion::where('tipo',4)->where('localizacion',1)->orderBy('id','asc')->get()->last();
    $conteostock=App\DivisionProducto::conteo();
    $conteovencidos=App\CambioProducto::conteo();
    $conteoproximos=App\CambioProducto::proximos();
    $asignar=($conteoas>0)?1:0;
    $requisiciones=($conteore>0)?1:0;
    $stock=($conteostock>0)?1:0;
    $vencidos=($conteovencidos)?1:0;
    $porvencer=($conteoproximos)?1:0;
    $total=$asignar+$requisiciones+$stock+$porvencer+$vencidos;
  @endphp
  <li class="dropdown nav-item">
    <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
      <i class="fas fa-bell"></i>
      @if ($total > 0)
        <span class="badge badge-danger">{{$total}}</span>
      @else
        <span class="badge badge-success">{{$total}}</span>
      @endif
    </a>
    @if ($total > 0)
      <div class="dropdown-menu new-drop msg_list list-unstyled" aria-labelledby="navbarDropdownMenuLink">
        @if ($stock>0)
          <a class="dropdown-item" href="{{asset('/stockTodos')}}">
            <div class="flex-row">
              <center>
                <span class="text-uppercase text-monospace font-weight-light">Inventario bajo</span>
                <span class="badge badge-danger">
                  {{$conteostock}}
                </span>
              </center>
            </div>
            <span class="message">
              Existen <strong>{{$conteostock}} productos</strong>  bajo el stock mínimo
            </span>
          </a>
          <div class="dropdown-divider"></div>
        @endif

        @if ($asignar>0)
          <a class="dropdown-item" href="{{asset('/requisiciones?tipo=5')}}">
            <div class="flex-row">
              <center>
                <span class="text-uppercase text-monospace font-weight-light">Requisiciones por ubicar</span>
                <span class="badge badge-danger">{{$conteoas}}</span>
              </center>
            </div>
            <span class="message">
              Más reciente: <strong>{{$ultima1->created_at->diffForHumans()}}</strong>
            </span>
          </a>
          <div class="dropdown-divider"></div>
        @endif

        @if ($requisiciones>0)
          <a class="dropdown-item"href="{{asset('/verrequisiciones?tipo=4')}}">
            <div class="flex-row">
              <center>
                <span class="text-uppercase text-monospace font-weight-light">Requisiciones del hospital</span>
                <span class="badge badge-danger">{{$requisiciones}}</span>
              </center>
            </div>
            <span class="message">
              Más reciente: <strong>{{$ultima2->created_at->diffForHumans()}}</strong>
            </span>
          </a>
          <div class="dropdown-divider"></div>
        @endif

        @if ($vencidos>0)
          <a class="dropdown-item" href="{{asset('/cambio_productos?estado=0')}}">
            <div class="flex-row">
              <center>
                <span class="text-uppercase text-monospace font-weight-light">Lotes vencidos</span>
                <span class="badge badge-danger">{{$conteovencidos}}</span>
              </center>
            </div>
            <span class="message">
              Existen <strong>{{$conteovencidos}} lotes de productos vencidos</strong>, necesita confirmar  que fueron retirados de los estantes
            </span>
          </a>
          <div class="dropdown-divider"></div>
        @endif

        @if ($porvencer>0)
          <a class="dropdown-item" href="{{asset('/cambio_productos?estado=0')}}">
            <div class="flex-row">
              <center>
                <span class="text-uppercase text-monospace font-weight-light">Lotes próximos a vencer</span>
                <span class="badge badge-danger">{{$conteoproximos}}</span>
              </center>
            </div>
            <span class="message">
              Existen <strong>{{$conteoproximos}} lotes de productos próximos a vencer</strong>, para tomar alguna acción sobre estos
            </span>
          </a>
        @endif
      </div>
    @endif
  </li>
@endif