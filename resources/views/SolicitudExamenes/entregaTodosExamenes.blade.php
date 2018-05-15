@extends('PDF.hoja')
@section('layout')
@php
  $fecha = Carbon\Carbon::now();
@endphp
  @foreach ($solicitudes as $key => $solicitud)
    <div class="page">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <center>
          <span><big>Examen realizado: <strong><u>{{$solicitud->examen->nombreExamen}}</u></strong></big><span>
    		</center>
    		<div><span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span><span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span></div>
      	<span> Muestra: <strong><u>{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}}</u></strong></span>
    		<div class="clearfix"></div>
    	<center><p><big><i>RESULTADO:</i></big><p></center>
            @foreach ($secciones[$key] as $keySec => $seccion)
              <div class="x_content">
      				<div class="row">
      					<div class="col-md-12 col-sm-12 col-12">
      				<center>
              <table class="table">
                <div class="x_title">
                    <span><big>{{$espr[$key][$keySec]->nombreSeccion($seccion)}}</big></span>
                    <div class="clearfix"></div>
                  </div>
                  <thead>
                    <th>Parametro</th>
                    <th>Resultado</th>
                    <th>Valores normales</th>
                    <th>Unidades</th>
                  </thead>
                  <tbody>
                    @if (count($espr[$key])>0)
                      @foreach ($espr[$key] as $esp =>$valor)
                        @if ($valor->f_seccion==$seccion)
                          <tr>
                            <td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></th>
                              <td><center>{{$detallesResultado[$key][$esp]->resultado}}</center></td>
                              @if ($valor->parametro->valorMinimo!=null)
                                <td><center>{{number_format($valor->parametro->valorMinimo, 2, '.', '')." - ".number_format($valor->parametro->valorMaximo, 2, '.', '')}}</center></td>
                                <td><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
                              @else
                                <th>-</th><th>-</th>
                              @endif
                            </tr>
                          @endif
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
      					</center>
              </div>
                @endforeach
                @if($resultados[$key]->observacion!=null)
              <div id="divObservacion" style="display:block;">
                <div class="form-group">
                  <center><label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones:</label></center>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                  <p>{{$resultados[$key]->observacion}}</p>
                  </div>
      					</div>
      				</div>
      			@endif
      			<div class="col-md-12 col-sm-12 col-12">
      				<center>
      				<div><span> Realizó: <strong><i>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</i></strong></span> &nbsp
      					<span> Sello:<img src={{asset(Storage::url(Auth::user()->sello))}} class="logo-pdf"> Firma:<img src={{asset(Storage::url(Auth::user()->firma))}} width="150" height="110"></span>
      					<span> Fecha: <strong><i>{{$resultados[$key]->created_at->format('d/m/Y')}}</i></strong></span>
      				</div>
      			</center>
      			</div>
          </div>
          </div>
          </div>
          </div>
          </div>
  @endforeach
	@endsection
