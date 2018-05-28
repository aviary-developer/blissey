@extends('dashboard')
@section('layout')
  @php
  $index = true;
  $fecha=Carbon\Carbon::now();
  @endphp
  <div class="col-md-10 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Respaldos</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-7 col-xs-12">
            <div class="btn-group">
              <a class="btn btn-dark btn-sm" href={{ url('/crearRespaldo') }}><i class="fa fa-plus"></i> Nuevo</a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-5 col-xs-12">
            {!!Form::open(['route'=>'respaldos.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
              </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <?php function formatoPeso($size, $precision = 2)
       {
           if ($size > 0) {
               $size = (int) $size;
               $base = log($size) / log(1024);
               $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

               return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
           } else {
               return $size;
           }
       } ?>
        <table class="table table-hover table-striped table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre de archivo</th>
              <th>Tamaño</th>
              <th>Fecha</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($respaldos)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($respaldos as $res)
                <tr>
                  <td>{{ $correlativo}}</td>
                  <td>
                    {{$res['nombre']}}
                  </td>
                  <td>
                    {{formatoPeso($res['tamanio'])}}
                  </td>
                  <td>
                    {{(Carbon\Carbon::createFromTimestamp($res['fecha']))->format('d-m-Y')}}
                  </td>
                  <td class="text-left">
                                <a class="btn btn-xs btn-default"
                                   href="{{ url('/descargarRespaldo/'.$res['nombre']) }}"><i
                                        class="fa fa-cloud-download"></i> Descargar</a>
                                <a class="btn btn-xs btn-primary"
                                    href="{{ url('/restaurarRespaldo/'.$res['nombre']) }}"><i
                                          class="fa fa-cloud-upload"></i> Restaurar</a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="{{ url('/eliminarRespaldo/'.$res['nombre']) }}"><i class="fa fa-trash-o"></i>
                                    Eliminar</a>
                            </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
            @else
              <tr>
                <td colspan="5">
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
          </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
  @endsection
  <!--<div class="modal-body">
  <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal4">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Respaldo<span class="label label-lg label-primary">Nuevo</span></h4>
        </div>
        @php
        $fecha=Carbon\Carbon::now();
        @endphp
          <div class="x_panel">
            <div class="row">
              <div class="col-md-2 col-xs-12">
              <label class="control-label col-sm-3 col-xs-12">Nombre: </label>
            </div>
              <div class="col-md-5 col-xs-12">
                <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre de respaldo']) !!}
              </div>
              <div class="col-md-5 col-xs-12">
              {!! Form::text('nombre',$fecha->format('_d-m-Y_h-i-s').'.sql',['readonly','class'=>'form-control']) !!}</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Hacer respaldo</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div>-->
