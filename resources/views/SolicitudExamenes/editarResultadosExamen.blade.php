@extends('principal')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','url' =>'guardarResultadosExamen','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  @include('SolicitudExamenes.Barra.edited')
  <div class="col-md-10">
    <div class="x_panel">
      <div class="flex-row">
        <span class="font-weight-light text-monospace">
          Paciente
        </span>
      </div>
      <div class="flex-row">
        <h6 class="font-weight-bold">
          {{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}
          @if ($solicitud->paciente->sexo)
            <span class="badge badge-pill badge-primary">
          @else  
            <span class="badge badge-pill badge-pink">
          @endif
            {{$solicitud->paciente->fechaNacimiento->age.' años' }}
          </span>
        </h6>
      </div>
    </div>

    <input type="hidden" name="solicitud" value={{$solicitud->id}}>
    <input type="hidden" name="idExamen" value={{$solicitud->f_examen}}>
    @foreach ($espr as $esp)
      <input type="hidden" name="espr[]" value={{$esp->id}}>
    @endforeach
    @if ($solicitud->examen->imagen)
      <div class="x_panel">
        <div class="form-group">
          <label class="" for="imagenExamen">Imagen de {{$solicitud->examen->nombreExamen}} </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="custom-file input-group">
              <input type="file" name="imagenExamen" class="custom-file-input" id="imagenExamen" lang="es" accept="image/*" >
              <label class="form-control-sm custom-file-label " for="customFileLang">Seleccionar Archivo</label>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="flex-row">
            <center>
              <output id="listExamen" style="height:400px">
                  <img src={{asset(Storage::url($resultado->imagen))}} style="height: 400px; width: 400px; object-fit: scale-down">
              </output>
            </center>
          </div>
        </div>
      </div>
    @endif
    @foreach ($secciones as $variable)
      <div class="x_panel">
        @php
        $contadorParametros = 1;
        @endphp
        <div class="flex-row">
          <center>
            <h5>
              <i class="fa fa-flask"></i> 
              {{$espr->first()->nombreSeccion($variable)}}
            </h5>
          </center>
        </div>
        <table class="table table-sm table-hover table-stripped">
          <thead>
            <th style="width: 5%">#</th>
            <th style="width: 25%">Parametro</th>
            <th style="width: 20%">Resultado</th>
            <th style="width: 10%" title="Valor Normal mínimo">VNm</th>
            <th style="width: 10%" title="Valor Normal Máximo">VNM</th>
            <th style="width: 15%">Unidades</th>
            <th style="width: 10%">DC</th>
          </thead>
          <tbody>
            @if (count($espr)>0)
              @foreach ($espr as $esp=>$valor)
                @if ($valor->f_seccion==$variable)
                  <tr>
                    <td>{{$contadorParametros}}</td>
                    <td>{{$valor->nombreParametro($valor->f_parametro)}}</th>
                    <td><input type="text" class="form-control form-control-sm" name="resultados[]" value="{{$detallesResultado[$esp]->resultado}}"></input></td>
                    @if($valor->parametro->valorMinimo)
                      <td>
                        <span class="badge border border-primary text-primary col-12">
                          {{number_format($valor->parametro->valorMinimo, 2, '.', ',')}}
                        </span>
                      </td>
                      <td>
                        <span class="badge border border-danger text-danger col-12">
                          {{number_format($valor->parametro->valorMaximo, 2, '.', ',')}}
                        </span>
                      </td>
                    @else
                      <td>
                        <span class="badge border border-secondary text-secondary">Ninguno</span>
                      </td>
                      <td>
                        <span class="badge border border-secondary text-secondary">Ninguno</span>
                      </td>
                    @endif
                    <td>
                      @if ($valor->nombreUnidad($valor->parametro->unidad) == "-")
                        <span class="badge border border-secondary text-secondary">Ninguna</span>
                      @else
                        {{$valor->nombreUnidad($valor->parametro->unidad)}}
                      @endif
                    </td>
                    @if ($valor->f_reactivo)
                      <td>{!!Form::selectRange('datoControlado[]',0, 4, $detallesResultado[$esp]->dato_controlado,['class'=>'form-control form-control-sm'])!!}</td>
                    @else
                      <td>
                        <span class="badge border border-secondary text-secondary">Ninguno</span>
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
                <td colspan="7">
                  <center>
                    No hay registros
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div>
          @if ($solicitud->paciente->sexo)
            <span class="badge badge-primary">
              Valores normales masculinos
            </span>
          @else
            <span class="badge badge-pink">
              Valores normales femeninos
            </span>
          @endif
        </div>
      </div>
    @endforeach

    <div class="x_panel">
      <center>
        <div class="">
          <label>
            <input type="checkbox" name="checkObservacion" id="checkObservacion" class="js-switch" {{($resultado->observacion)?"checked":"unchecked"}} /> Añadir Observación
          </label>
        </div>
      </center>
      <div class="form-group" id="divObservacion" style={{($resultado->observacion)?"display:block;":"display:none;"}}>
        <label class="" for="direccion">Observación</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-search"></i></div>
          </div>
          {!! Form::textarea(
            'observacion',
            $resultado->observacion,
            ['class'=>'form-control form-control-sm',
            'placeholder'=>'Escriba la observación',
            'rows'=>'2']) !!}
        </div>
      </div>
    </div>
      
    <div class="x_panel">
      <center>
        {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
        <button type="reset" name="button" class="btn  btn-light btn-sm">Limpiar</button>
        <a href={!! asset('/examenesEvaluados?vista=paciente') !!} class="btn btn-light btn-sm">Cancelar</a>
      </center>
    </div>
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
