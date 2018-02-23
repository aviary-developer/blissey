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
          @if($tipo==4)Requisiciones
            <small>Pendientes</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-5 col-xs-12">
            <div class="btn-group">
              @if($tipo==4)
                <a href={!! asset('/requisiciones/create') !!} class="btn btn-dark btn-ms"><i class="fa fa-plus"></i> Nuevo</a>
                <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
                <a href={!! asset('/transacciones?tipo=1') !!} class="btn btn-dark btn-ms">
                  <i class="fa fa-file"></i> Atendidos
                  <span class="label label-warning">{{ App\Transacion::where('tipo',5)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
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
                  <td>
                    <a href={!! asset('/requisiciones/'.$transaccion->id)!!} class="btn btn-xs btn-info">
                      <i class="fa fa-info-circle"></i>
                    </a>
                    @if ($tipo=4)
                      @include('Requisiciones.Formularios.eliminarRequisicion')
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
