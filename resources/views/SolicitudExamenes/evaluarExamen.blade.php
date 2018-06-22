@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','url' =>'guardarResultadosExamen','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-10 col-xs-12" style="margin: 0px 0px 40px 0px;">
    <div class="x_panel">
      <div class="x_title">
        <h2>Evaluación de examen</h2>
        <div class="clearfix"></div>
        <h4>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}   <strong>{{$solicitud->paciente->fechaNacimiento->age}} años </strong>   <span class="label label-lg label-default">{{$solicitud->examen->nombreExamen}}</span></h4>
      </div>
      <div class="col-xs-12">
        <input type="hidden" name="solicitud" value={{$solicitud->id}}>
        <input type="hidden" name="evaluar" value=true>
        <input type="hidden" name="idExamen" value={{$solicitud->f_examen}}>
        @foreach ($espr as $esp)
          <input type="hidden" name="espr[]" value={{$esp->id}}>
        @endforeach
        @foreach ($secciones as $variable)
          @php
          $contadorParametros = 1;
          @endphp
          <div class="">
            <h3><i class="fa fa-flask"></i> {{$espr->first()->nombreSeccion($variable)}}</h3>
            <div class="clearfix"></div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="width: 5%" rowspan="2">#</th>
                <th style="width: 15%" rowspan="2">Parametro</th>
                <th style="width: 25%" rowspan="2">Resultado</th>
                <th colspan="2">
                  <center>
                    @if ($solicitud->paciente->sexo==0)
                      <span class="label-lg label label-pink col-xs-12">Valores normales femeninos</span>
                    @else
                        <span class="label-lg label label-primary col-xs-12">Valores normales masculinos</span>
                    @endif
                  </center>
                </th>
                <th rowspan="2" style="width: 15%">Unidades</th>
                <th rowspan="2" style="width: 15%">Dato controlado</th>
              </tr>
              <tr>
                <th style="width: 10%">Mínimo</th>
                <th style="width: 10%">Máximo</th>
              </tr>
            </thead>
            <tbody>
              @if (count($espr)>0)
                @foreach ($espr as $esp)
                  @if ($esp->f_seccion==$variable)
                    <tr>
                      <td>{{$contadorParametros}}</td>
                      <td>{{$esp->nombreParametro($esp->f_parametro)}}</th>
                      <td><input type="text" class="form-control" name="resultados[]" value="{{$esp->parametro->valorPredeterminado}}"></input></td>
                      @if($esp->parametro->valorMinimo!=null)
                        <td>
                          <span class="label label-lg label-cian col-xs-12">
                            @if ($solicitud->paciente->sexo==0)
                              {{number_format($esp->parametro->valorMinimoFemenino, 2, '.', ',')}}
                          @else
                            {{number_format($esp->parametro->valorMinimo, 2, '.', ',')}}
                          @endif
                          </span>
                        </td>
                        <td>
                          <span class="label label-lg label-danger col-xs-12">
                            @if ($solicitud->paciente->sexo==0)
                              {{number_format($esp->parametro->valorMaximoFemenino, 2, '.', ',')}}
                          @else
                            {{number_format($esp->parametro->valorMaximo, 2, '.', ',')}}
                          @endif
                          </span>
                        </td>
                      @else
                        <td>
                          <span class="label label-lg label-gray col-xs-12">Ninguno</span>
                        </td>
                        <td>
                          <span class="label label-lg label-gray col-xs-12">Ninguno</span>
                        </td>
                      @endif
                      <td>
                        @if ($esp->nombreUnidad($esp->parametro->unidad) == "-")
                          <span class="label label-lg label-gray col-xs-12">Ninguna</span>
                        @else
                          {{$esp->nombreUnidad($esp->parametro->unidad)}}
                        @endif
                      </td>
                      @if ($esp->f_reactivo)
                        <td>{!!Form::selectRange('datoControlado[]', 0, 4, 0,['class'=>'form-control'])!!}</td>
                      @else
                        <td>
                          <span class="label label-lg label-gray col-xs-12">Ninguno</span>
                        </td>
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
      <div>
      <div class="form-group col-xs-12">
        <center>
          <div class="">
            <label>
              <input type="checkbox" name="checkObservacion" id="checkObservacion" class="js-switch" unchecked /> Añadir Observación
            </label>
          </div>
        </center>
        <div id="divObservacion" style="display:none;">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::textarea('observacion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Escriba la observación','rows'=>'3']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
    <button type="reset" name="button" class="btn btn-default">Limpiar</button>
    <a href={!! asset('/solicitudex') !!} class="btn btn-default">Cancelar</a>
  </center>
</div>
  {!!Form::close()!!}
@endsection
