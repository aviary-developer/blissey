@extends('dashboard')
@section('layout')
  @php
      setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Producto Vencidos y próximos a vencer
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              @if ($estado==0 && $estado!="" && count($retirados)>0)
                <a href={!! asset('/confirmarRetiroVencidos') !!} class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Confirmar que todos los lotes fueron retirados"><i class="fa fa-file"></i> Confirmar</a>
              @endif
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            {!!Form::open(['route'=>'cambio_productos.index','method'=>'GET','role'=>'search','class'=>'form-inline','id'=>'cambios'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!!Form::select('estado',['0'=>'Lotes vencidos sin retirar','1'=>'Lotes retirados','Lotes cambiados']
                ,null, ['class'=>'form-control has-feedback-left','id'=>'estado','placeholder'=>'Filtrar estado','onChange'=>'submitar();'])!!}
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
              <th>Código</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Lote</th>
              <th>Estante</th>
              <th>Nivel</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($retirados)>0)
              @php
                $contador=1;
              @endphp
              @foreach ($retirados as $retirado)
                <tr>
                  <td>
                    {{$contador+$pagina}}
                  </td>
                  @php
                    $dv=$retirado->transaccion->divisionProducto;//división producto
                  @endphp
                  <td>
                  {{$retirado->fecha->formatLocalized('%d de %B de %Y')}}
                  </td>
                  <td>
                    @if ($retirado->estado==0)
                      <span class="label label-danger label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="Falta retirar de estante">{{$dv->codigo}}</span>
                    @elseif($retirado->estado==1)
                      <span class="label label-dark-blue label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="Retirado sin cambio">{{$dv->codigo}}</span>
                    @else
                      <span class="label label-success label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="Cambiado">{{$dv->codigo}}</span>
                    @endif
                  </td>
                  <td>{{$dv->producto->nombre." ".$dv->division->nombre." "}}
                  @if ($dv->contenido!=null)
                    {{$dv->cantidad." ".$dv->unidad->nombre}}
                  @else
                    {{$dv->cantidad." ".$dv->producto->Presentacion->nombre}}
                  @endif
                  </td>
                  <td>{{$retirado->cantidad}}</td>
                  <td>{{$retirado->transaccion->lote}}</td>
                  <td>{{$retirado->transaccion->estante->codigo}}</td>
                  <td>{{$retirado->transaccion->nivel}}</td>
                  <td><a href={!! asset('/cambio_productos/'.$retirado->id)!!} class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Ver">
                    <i class="fa fa-info-circle"></i>
                    </a>
                  </td>
                </tr>
                @php
                  $contador++;
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
          {!! str_replace ('/?', '?', $retirados->appends(Request::only(['estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
  <script type="text/javascript">
    function submitar(){
      $('#cambios').submit();
    }
  </script>
@endsection
