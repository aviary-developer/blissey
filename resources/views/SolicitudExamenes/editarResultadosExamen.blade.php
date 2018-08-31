@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','url' =>'guardarResultadosExamen','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-10 col-xs-12" style="margin: 0px 0px 40px 0px;">
    <div class="x_panel">
      <div class="x_title">
        <h2>Edición de resultados de examen</h2>
        <div class="clearfix"></div>
        <h4>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}} <span class="label label-lg label-default">{{$solicitud->examen->nombreExamen}}</span></h4>
      </div>
      <div class="col-xs-12">
        <input type="hidden" name="solicitud" value={{$solicitud->id}}>
        <input type="hidden" name="idExamen" value={{$solicitud->f_examen}}>
        @foreach ($espr as $esp)
          <input type="hidden" name="espr[]" value={{$esp->id}}>
        @endforeach
        @if ($solicitud->examen->imagen)
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagen de {{$solicitud->examen->nombreExamen}}:</label>
          <div class="col-md-8 col-sm-8 col-xs-12">
            <span class="fa fa-camera form-control-feedback left" aria-hidden="true"></span>
            <input type="file" name="imagenExamen" id="imagenExamen" accept="image/*" class="form-control has-feedback-left"></input>
          </div>
        </div>
        <div class="col-md-12 col-xs-12">
          <div class="">
            <center>
              <output id="listExamen" style="height:400px">
                  <img src={{asset(Storage::url($resultado->imagen))}} style="height: 400px; width: 400px; object-fit: scale-down">
              </output>
            </center>
          </div>
        </div>
      @endif
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
                    Valores normales
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
                @foreach ($espr as $esp=>$valor)
                  @if ($valor->f_seccion==$variable)
                    <tr>
                      <td>{{$contadorParametros}}</td>
                      <td>{{$valor->nombreParametro($valor->f_parametro)}}</th>
                      <td><input type="text" class="form-control" name="resultados[]" value="{{$detallesResultado[$esp]->resultado}}"></input></td>
                      @if($valor->parametro->valorMinimo)
                        <td>
                          <span class="label label-lg label-cian col-xs-12">
                            {{number_format($valor->parametro->valorMinimo, 2, '.', ',')}}
                          </span>
                        </td>
                        <td>
                          <span class="label label-lg label-danger col-xs-12">{{number_format($valor->parametro->valorMaximo, 2, '.', ',')}}</span>
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
                        @if ($valor->nombreUnidad($valor->parametro->unidad) == "-")
                          <span class="label label-lg label-gray col-xs-12">Ninguna</span>
                        @else
                          {{$valor->nombreUnidad($valor->parametro->unidad)}}
                        @endif
                      </td>
                      @if ($valor->f_reactivo)
                        <td>{!!Form::selectRange('datoControlado[]',0, 4, $detallesResultado[$esp]->dato_controlado,['class'=>'form-control'])!!}</td>
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
              <input type="checkbox" name="checkObservacion" id="checkObservacion" class="js-switch" {{($resultado->observacion)?"checked":"unchecked"}} /> Añadir Observación
            </label>
          </div>
        </center>
        <div id="divObservacion" style={{($resultado->observacion)?"display:block;":"display:none;"}}>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::textarea('observacion',$resultado->observacion,['class'=>'form-control has-feedback-left','placeholder'=>'Escriba la observación','rows'=>'3']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <center>
    {!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
    <button type="reset" name="button" class="btn btn-default">Limpiar</button>
    <a href={!! asset('/solicitudex') !!} class="btn btn-default">Cancelar</a>
  </center>
</div>
  {!!Form::close()!!}
  <script>
  function imagenExamenFuncion(evt){
    var files = evt.target.files;

    for(var i = 0, f; f = files[i]; i++){
      if(!f.type.match('image.*')){
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile){
        return function(e){
          document.getElementById('listExamen').innerHTML = ['<img style="height: 400px; width: 400px; object-fit: scale-down" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('imagenExamen').addEventListener('change', imagenExamenFuncion, false);
</script>
@endsection
