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
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Examenes
          @if ($estadoOpuesto)
            <small>Papelera</small>
          @else
            <small>Activos</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/examenes/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/examenes?nombre='.$nombre.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activos
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12">
            {!!Form::open(['route'=>'examenes.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
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
              <th>Área</th>
              <th>Tipo de muestra</th>
              <th style="width: 200px">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($examenes)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($examenes as $examen)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/examenes/'.$examen->id)}}>
                      {{ $examen->nombreExamen }}
                    </a>
                  </td>
                  <td>
                    @if ($examen->area == "HEMATOLOGIA")
                      <span class="label label-lg label-danger col-xs-10">Hematológia</span>
                    @elseif($examen->area == "EXAMENES DE ORINA")
                      <span class="label label-lg label-warning col-xs-10">Exámenes de orina</span>
                    @elseif($examen->area == "EXAMENES DE HECES")
                      <span class="label label-lg label-default col-xs-10">Exámenes de heces</span>
                    @elseif($examen->area == "BACTERIOLOGIA")
                      <span class="label label-lg label-success col-xs-10">Bactereología</span>
                    @elseif($examen->area == "QUIMICA SANGUINEA")
                      <span class="label label-lg label-white red col-xs-10">Química sanguínea</span>
                    @elseif($examen->area == "INMUNOLOGIA")
                      <span class="label label-lg label-primary col-xs-10">Inmunología</span>
                    @elseif($examen->area == "ENZIMAS")
                      <span class="label label-lg label-purple col-xs-10">Enzimas</span>
                    @elseif($examen->area == "PRUEBAS ESPECIALES")
                      <span class="label label-lg label-info col-xs-10">Pruebas especiales</span>
                    @elseif($examen->area == "OTROS")
                      <span class="label label-lg label-dark-blue col-xs-10">Otros</span>
                    @endif
                  </td>
                  <td>
                    <a href={{asset('/muestras/'.$examen->tipoMuestra)}}>
                      {{ $examen->nombreMuestra($examen->tipoMuestra) }}
                    </a>
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Examenes.Formularios.activate')
                    @else
                      @include('Examenes.Formularios.desactivate')
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
          {!! str_replace ('/?', '?', $examenes->appends(Request::only(['nombre','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
