@extends('dashboard')
@section('layout')
  @if ($estado != 2 || $estado == null)
    @php
      $estadoOpuesto = 2;
    @endphp
  @else
    @php
      $estadoOpuesto = 0;
    @endphp
  @endif

  @php
    $index = true;
  @endphp

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Ingresos
          @if ($estadoOpuesto != 2)
            <small>Alta médica</small>
          @else
            <small>Actuales</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="btn-group">
              <a href={{asset('/ingresos/create')}} class="btn btn-ms btn-dark">
                <i class="fa fa-plus"></i> Nuevo
              </a>
              <a href={{asset('#')}} class="btn btn-ms btn-dark">
                <i class="fa fa-file"></i> Reporte
              </a>
              <a href={{asset('/ingresos?estado='.$estadoOpuesto)}} class="btn btn-ms btn-dark">
                @if ($estadoOpuesto != 2)
                  <i class="fa fa-medkit"></i> Actuales
                  <span class="label label-success">{{$activos}}</span>
                @else
                  <i class="fa fa-check"></i> En alta
                @endif
              </a>
              <a href={{'#'}} class="btn btn-primary btn-ms">
                <i class="fa fa-question"></i> Ayuda
              </a>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <th>#</th>
              <th>Paciente</th>
              <th>Médico</th>
              <th>Habitación</th>
              <th>Fecha de Ingreso</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              @if (count($ingresos)>0)
                @php
                  $correlativo = 1;
                @endphp
                @foreach ($ingresos as $ingreso)
                  <tr>
                    <td>{{$correlativo}}</td>
                    <th>{{$ingreos->nombrePaciente($ingreso->f_paciente)}}</th>
                    <th>{{$ingreso->nombreMedico($ingreso->f_medico)}}</th>
                    <th>{{$ingreso->numeroHabitacion($ingreso->f_habitacion)}}</th>
                    <th>{{$ingreso->fecha_ingreso->format('d / M / Y')}}</th>
                    <th><a href="#" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></a></th>
                  </tr>
                  @php
                    $correlativo++;
                  @endphp
                @endforeach
              @else
                <tr>
                  <td colspan="6">
                    <center>
                      No hay registros que coincidan con los terminos de busqueda indicados
                    </center>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
          <div class="ln_solid"></div>
          {{ str_replace('/?', '?', $ingresos->appends(Request::only(['estado']))->render())}}
        </div>
      </div>
    </div>
  </div>
@endsection
