
@extends('dashboard')
@section('layout')
  @if(Session::has('mensaje'))
    <?php $mensaje = Session::get('mensaje');
    echo "<script>swal('$mensaje', 'Acción realizada satisfactorimente', 'success')</script>";?>
  @endif
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Presentaciones
          @if ($estadoOpuesto)
            <small>Papelera</small>
          @else
            <small>Activas</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="btn-group">
              <a  class="btn btn-dark btn-ms" data-toggle="modal" data-target=".bs-modal-lg" id="nuevo"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/presentaciones?nombre='.$nombre.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-ms">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activas
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-ms" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            {!!Form::open(['route'=>'presentaciones.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
              @if ($estadoOpuesto)
                <input type="hidden" name="estado" value="0">
              @endif
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($presentaciones)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($presentaciones as $presentacion)
                <tr>
                  <td>{{ $correlativo }}</td>
                  <td>{{ $presentacion->nombre }}</td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Presentaciones.Formularios.activate')
                    @else
                      @include('Presentaciones.Formularios.desactivate')
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
          {!! str_replace ('/?', '?', $presentaciones->appends(Request::only(['nombre','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
  {{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Presentación <small>Nueva</small></h4>
        </div>
        <div class="modal-body">
          <div class="x_panel">
            <div class="form-group">
              <label class="control-label">Nombre *</label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('nombre_presentacion',null,['id'=>'nombre_presentacion','class'=>'form-control has-feedback-left','placeholder'=>'Nombre presentación']) !!}
              </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="accion" value="">
          <input type="hidden" id="idEditar" value="">
          <button id="guardar_presentacion" class="btn btn-primary" type="button">Guardar</button>
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
