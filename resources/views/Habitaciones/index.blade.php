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
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Habitaciones
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
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/habitaciones/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/habitaciones?numero='.$numero.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activas
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-2 col-sm-5 col-xs-12">
            {!!Form::open(['route'=>'habitaciones.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('numero',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
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
              <th>Numero</th>
              <th>Precio</th>
              <th>Disponibilidad</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($habitaciones)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($habitaciones as $habitacion)
                <tr>
                  <td>{{ $correlativo }}</td>
                  <td>
                    <a href={{asset('/habitaciones/'.$habitacion->id)}}>
                      {{ 'Habitación '.$habitacion->numero }}
                    </a>
                  </td>
                  <td>{{ '$ '.number_format($habitacion->precio,2,'.',',')}}</td>
                  <td>
                    @if ($habitacion->ocupado)
                      <span class="label label-danger col-md-8 col-sm-8 col-xs-8 label-lg">Ocupada</span>
                    @else
                      <span class="label label-success col-md-8 col-sm-8 col-xs-8 label-lg">Disponible</span>
                    @endif
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Habitaciones.Formularios.activate')
                    @else
                      @include('Habitaciones.Formularios.desactivate')
                    @endif
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
          {!! str_replace ('/?', '?', $habitaciones->appends(Request::only(['numero','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
