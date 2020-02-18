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
          <span><big>Examen realizado: <strong><u>{{$solicitud->examen['nombreExamen']}}</u></strong></big><span>
    		</center>
    		<div><span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span><span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span></div>
      	<span> Muestra: <strong><u>{{$solicitud->examen->nombreMuestra($solicitud->examen['tipoMuestra'])}}</u></strong></span>
    		<div class="clearfix"></div>
        <div class="row">
          @php
						$cantidadSecciones=count($secciones[$key]);
					@endphp
            @foreach ($secciones[$key] as $keySec => $seccion)
              @if($cantidadSecciones==1)
                <div class="col-xs-3">
                </div>
              @endif
              @if($keySec%2==0)
    						<div class="row">
    						@endif
      					<div class="col-xs-6">
      				<center>
              <table class="table-simple">
                <div class="x_title">
                    <span><big>{{$espr[$key][$keySec]->nombreSeccion($seccion)}}</big></span>
                    <div class="clearfix"></div>
                  </div>
                  <thead>
                    <th>Parámetro</th>
                    <th>Resultado</th>
                    <th>Valores normales</th>
                    <th>Unidades</th>
                  </thead>
                  <tbody>
                    @if ($espr[$key]!=null)
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
                              @if ($detallesResultado[$key][$esp]->dato_controlado!=null)
                                <td><center>D.C.={{$detallesResultado[$key][$esp]->dato_controlado}}</center></td>
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
              @if($keySec%2!=0)
              </div>
                @endif
                @endforeach
                @if($resultados[$key]->observacion!=null)
                  <br>
                  <div class="col-xs-12">
                  <ul class="list-unstyled timeline widget">
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>OBSERVACIONES:</a>
                                            </h2>
                              <p class="excerpt">{{$resultados[$key]->observacion}}</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
      			@endif
      			<div class="col-md-12 col-sm-12 col-12">
      				<center>
                <div><span> Realizó: <strong><i>{{$resultado->laboratorista->nombre}} {{$resultado->laboratorista->apellido}}</i></strong></span> &nbsp
                  <span> Sello:<img src={{asset(Storage::url($resultado->laboratorista->sello))}} class="logo-pdf"> Firma:<img src={{asset(Storage::url($resultado->laboratorista->firma))}} width="150" height="110"></span>
                  <span> Fecha: <strong><i>{{$resultado->created_at->format('d/m/Y')}}</i></strong></span>
                </div>
      			</center>
      			</div>
          </div>
          </div>
          </div>
          </div>
  @endforeach
	@endsection
