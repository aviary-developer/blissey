@extends('dashboard')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>
            @if($tipo==0)Pedidos
              <small class="label-white badge blue ">Por confirmar</small>
            @endif
            @if($tipo==1)Pedidos
              <small class="label-white badge green ">Confirmados</small>
            @endif
            @if($tipo==2)Ventas
              <small class="label-white badge green ">Realizadas</small>
            @endif
            @if($tipo==3)Ventas
              <small class="label-white badge red ">Anuladas</small>
            @endif
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              @if($tipo==0)
              <li>
                <a href={!! asset('/transacciones/create?tipo='.$tipo) !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
              </li>
              <li>
                <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa2 fa-eye"></i> Ver
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href={!! asset('/transacciones?tipo=1') !!}>
                        Confirmados
                        <span class="label label-success">{{ App\Transacion::where('tipo',1)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
              </li>
              @endif
              @if ($tipo==1)
                <li>
                  <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa2 fa-eye"></i> Ver
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href={!! asset('/transacciones?tipo=0') !!}>
                          Por confirmar
                          <span class="label label-info">{{ App\Transacion::where('tipo',0)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
                </li>
              @endif
              @if ($tipo==2)
                <li>
                  <a href={!! asset('/transacciones/create?tipo=2') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
                </li>
                <li>
                  <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa2 fa-eye"></i> Ver
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href={!! asset('/transacciones?tipo=3') !!}>
                          Anuladas
                          <span class="label label-danger">{{ App\Transacion::where('tipo',3)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
                </li>
              @endif
              @if ($tipo==3)
                <li>
                  <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa2 fa-eye"></i> Ver
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href={!! asset('/transacciones?tipo=2') !!}>
                          Realizadas
                          <span class="label label-success">{{ App\Transacion::where('tipo',2)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
                </li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
        <table class="table table-striped" id="index-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              @if ($tipo==0 || $tipo==1)
                <th>Proveedor</th>
              @endif
              @if($tipo==1 || $tipo==2 || $tipo==3)
                <th>Factura</th>
              @endif
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($transacciones as $transaccion)
                <tr>
                  <td>{{ $correlativo + $pagina}}</td>
                  <td>{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
                  @if ($tipo==0 || $tipo==1)
                    <td>{{$transaccion->proveedor->nombre}}</td>
                  @endif
                  @if($tipo==1 || $tipo==2 || $tipo==3)
                      <td>{{$transaccion->factura}}</td>
                  @endif
                      @if($tipo==0)
                        <td>
                        {!!Form::open(['url'=>['confirmarPedido',$transaccion->id],'method'=>'POST'])!!}
                        <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Confirmar"/>
                        <i class="fa fa-check"></i>
                      </button>
                      @include('Transacciones.Formularios.eliminarPedido')
                      {!!Form::close()!!}
                      </td>
                    @endif
                @if ($tipo==1 || $tipo==2 || $tipo==3)
                  <td>
                    <a href={!! asset('/transacciones/'.$transaccion->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
                      <i class="fa fa-info-circle"></i>
                    </a>
                    @php
                    $fecha=\Carbon\Carbon::now()->subHours(2);
                    @endphp
                    @if ($tipo==2 && $fecha<$transaccion->updated_at)
                      @include('Transacciones.Formularios.anularVenta')
                    @endif
                  </td>
                @endif
              </tr>
              @php
              $correlativo++;
              @endphp
            @endforeach
        </tbody>
      </table>
    </div>
      <div class="ln_solid"></div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection
