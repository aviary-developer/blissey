@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','url' =>'guardarResultadosExamen','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}<small>{{$solicitud->examen->nombreExamen}}</small></h2>
        <div class='col-md-8 col-sm-6 col-xs-6'>
          <input type="hidden" name="solicitud" value={{$solicitud->id}}>
          <input type="hidden" name="examen" value={{$solicitud->examen->id}}>
          <input type="hidden" name="secciones" value={{$secciones}}>
          @foreach ($espr as $esp)
            <input type="hidden" name="espr[]" value={{$esp->id}}>
          @endforeach
          @foreach ($secciones as $variable)
            @php
            $contadorParametros = 1;
            @endphp
          <table class="table">
            <div class="x_title">
              <div class="clearfix">
                <h2>{{$espr->first()->nombreSeccion($variable)}}</h2></div>
            </div>
            <thead>
              <th>#</th>
              <th>Parametro</th>
              <th>Resultado</th>
              <th>Valores normales</th>
              <th>Unidades</th>
              <th>Dato controlado</th>
            </thead>
            <tbody>
              @if (count($espr)>0)
                @foreach ($espr as $esp)
                  @if ($esp->f_seccion==$variable)
                  <tr>
                    <td>{{$contadorParametros}}</td>
                    <td>{{$esp->nombreParametro($esp->f_parametro)}}</th>
                    <td><input type="text" name="resultados{{$variable}}[]" value="{{$esp->parametro->valorPredeterminado}}"></input></td>
                      @if ($esp->parametro->valorMinimo)
                        <td>{{number_format($esp->parametro->valorMinimo, 2, '.', '')." - ".number_format($esp->parametro->valorMaximo, 2, '.', '')}}</td>
                        <td>{{$esp->nombreUnidad($esp->parametro->unidad)}}</td>
                      @else
                      <th>-</th><th>-</th>
                      @endif
                        @if ($esp->f_reactivo)
                      <td>{!!Form::selectRange('datoControlado'.$esp->parametro->id, 0, 4,['class'=>'form-control has-feedback-left'])!!}</td>
                    @else
                      <td>-</td>
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
        <center>
          {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
          <button type="reset" name="button" class="btn btn-default">Limpiar</button>
          <a href={!! asset('/solicitudex') !!} class="btn btn-default">Cancelar</a>
        </center>
        </div>
        </div>
        <div class="clearfix"></div>
      </div>
      </div>
    </div>
  {!!Form::close()!!}
@endsection
