@extends('dashboard')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          @if($tipo==0)Pedidos
              <small>Por confirmar</small>
          @endif
          @if($tipo==1)Pedidos
              <small>Confirmados</small>
          @endif
          @if($tipo==2)Ventas
              <small>Realizadas</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-5 col-xs-12">
            <div class="btn-group">
              @if($tipo==0)
                  <a href={!! asset('/transacciones/create?tipo='.$tipo) !!} class="btn btn-dark btn-ms"><i class="fa fa-plus"></i> Nuevo</a>
                  <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
                  <a href={!! asset('/transacciones?tipo=1') !!} class="btn btn-dark btn-ms">
                    <i class="fa fa-file"></i> Comfirmados
                    <span class="label label-warning">{{ App\Transacion::where('tipo',1)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                  </a>
                @endif
                @if($tipo==1)
                    <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
                    <a href={!! asset('/transacciones?tipo=0') !!} class="btn btn-dark btn-ms">
                      <i class="fa fa-file"></i> Por confirmar
                      <span class="label label-warning">{{ App\Transacion::where('tipo',0)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                    </a>
                @endif
                @if($tipo==2)
                    <a href={!! asset('/transacciones/create?tipo=1') !!} class="btn btn-dark btn-ms"><i class="fa fa-plus"></i> Nuevo</a>
                    <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
                    <a href={!! asset('/transacciones?tipo=1') !!} class="btn btn-dark btn-ms">
                      <i class="fa fa-file"></i> Comfirmados
                      <span class="label label-warning">{{ App\Transacion::where('tipo',1)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                    </a>
                  @endif
            </div>
          </div>
          <div class="col-md-3 col-xs-12"></div>
          <div class="col-md-4 col-xs-12">
            {!!Form::open(['route'=>'transacciones.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('buscar',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
              <input type="hidden" value={{$tipo}} name="tipo">
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              @if ($tipo==0 || $tipo==1)
                <th>Proveedor</th>
              @endif
              @if($tipo==1)
                <th>Factura</th>
              @endif
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($transacciones)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($transacciones as $transaccion)
                <tr>
                  <td>{{ $correlativo }}</td>
                  <td>{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
                  @if ($tipo==0 || $tipo==1)
                    <td>{{$transaccion->proveedor->nombre}}</td>
                  @if($tipo==1)
                    <td>{{$transaccion->factura}}</td>
                  @endif
                    <td>@if($transaccion->factura==null)
                      {!!Form::open(['url'=>['confirmarPedido',$transaccion->id],'method'=>'POST'])!!}
                      <button type="submit" class="btn btn-success btn-xs"/>
                      <i class="fa fa-check"></i>
                    </button>
                    @include('Transacciones.Formularios.eliminarPedido')
                    {!!Form::close()!!}
                  @else
                    <a href={!! asset('/transacciones/'.$transaccion->id)!!} class="btn btn-xs btn-info">
                      <i class="fa fa-info-circle"></i>
                    </a>
                  @endif
                @endif
              </td>
            </tr>
            @php
            $correlativo++;
            @endphp
          @endforeach
        @else
          <tr>
            <td colspan="7">
              <center>
                No hay registros que coincidan con los terminos de busqueda indicados
              </center>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
    <div class="ln_solid"></div>
    <center>
      {!! str_replace ('/?', '?', $transacciones->appends(Request::only(['buscar','tipo']))->render ()) !!}
    </center>
  </div>
</div>
</div>
<!-- /page content -->
@endsection
