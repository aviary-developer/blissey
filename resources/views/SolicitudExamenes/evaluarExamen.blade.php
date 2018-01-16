@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'examenes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}<small>{{$solicitud->examen->nombreExamen}}</small></h2>
        <div class='col-md-8 col-sm-6 col-xs-6'>
          @foreach ($espr as $variable)
            @php
            $contadorParametros = 1;
            @endphp
          <table class="table">
            <div class="x_title">
              <div class="clearfix">
                <h2>{{$variable->seccion->nombre}}</h2></div>
            </div>
            <thead>
              <th>#</th>
              <th>Parametro</th>
              <th>Resultado</th>
              <th>Valores normales</th>
              <th>Unidades</th>
            </thead>
            <tbody>
              @if (count($espr)>0)
                @foreach ($espr as $esp)
                  @if ($esp->f_seccion==$variable->seccion->id)
                  <tr>
                    <td>{{$contadorParametros}}</td>
                    <td>{{$esp->nombreParametro($esp->f_parametro)}}</th>
                    <th><input type="text" value="{{$esp->parametro->valorPredeterminado}}"></input></td>
                      @if ($esp->parametro->valorMinimo)
                        <th>{{number_format($esp->parametro->valorMinimo, 2, '.', '')." - ".number_format($esp->parametro->valorMaximo, 2, '.', '')}}</td><td>{{$esp->nombreUnidad($esp->parametro->unidad)}}</th>
                      @else
                      <th>No especificados</th><th>-</th>
                      @endif

                  </tr>
                @endif
                  @php
                    $contadorParametros++;
                  @endphp
                @endforeach
              @else
                <tr>
                  <td colspan="4">
                    <center>
                      No hay registros
                    </center>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        @endforeach
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
          <label>
            <input type="checkbox" name="checkObservacion" id="checkObservacion" class="js-switch" unchecked /> Añadir Observación
          </label>
        </div>
        <div id="divObservacion" style="display:none;">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::textarea('observacion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Escriba la observación','rows'=>'3']) !!}
            </div>
          </div>
        </div>
        </div>
        </div>
        <div class="clearfix"></div>
      </div>
      </div>
    </div>
  {!!Form::close()!!}
@endsection
