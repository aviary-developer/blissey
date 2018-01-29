@extends('PDF.laboratorio')
@section('layout')
	@php
  $fecha = Carbon\Carbon::now();
@endphp
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">{{$fecha->format('d-m-Y h:i:s A')}}<center>
      <h2>Examen Realizado:	{{$solicitud->examen->nombreExamen}}</h2>
			<h2>Tipo de Muestra:	{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}} Codigo:	{{$solicitud->codigo_muestra}}</h2>
      <h3>Paciente:	{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</h3>
			<h3>Edad:	{{$solicitud->paciente->fechaNacimiento->age}} años</h3>
    </center>
    <div class='col-md-8 col-sm-6 col-xs-6'>
      @foreach ($espr as $esp)
        <input type="hidden" name="espr[]" value={{$esp->id}}>
      @endforeach
      @foreach ($secciones as $variable)
        @php
        $contadorParametros = 1;
        @endphp
				<div class="row">
        <table class="table" border="0">
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
            </thead>
            <tbody>
              @if (count($espr)>0)
                @foreach ($espr as $esp =>$valor)
                  @if ($valor->f_seccion==$variable)
                    <tr>
                      <td><center>{{$contadorParametros}}</center></td>
                      <td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></th>
                        <td><center>{{$detallesResultado[$esp]->resultado}}</center></td>
                        @if ($valor->parametro->valorMinimo!=null)
                          <td><center>{{number_format($valor->parametro->valorMinimo, 2, '.', '')." - ".number_format($valor->parametro->valorMaximo, 2, '.', '')}}</center></td>
                          <td><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
                        @else
                          <th>-</th><th>-</th>
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
					</div>
          @endforeach
        </div>
        <div id="divObservacion" style="display:block;">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::textarea('observacion',$resultado->observacion,['class'=>'form-control has-feedback-left','placeholder'=>'','rows'=>'3']) !!}
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
	@endsection
