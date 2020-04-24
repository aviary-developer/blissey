<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>
    <!-- Bootstrap -->
    {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
    <!-- Font Awesome -->
    {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}


    {!!Html::style('assets/build/css/custom.css')!!}
    {!!Html::style('css/pdfexamenes.css')!!}

    <style type="text/css">
      div.page
      {
          page-break-after: always;
          page-break-inside: avoid;
      }
    </style>
  </head>

  <body class="bg-white">
@php
	$fecha = Carbon\Carbon::now();
@endphp
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="">
		<center>
			<strong><h4 style="font-weight: 900;">{{$solicitud->examen->nombreExamen}}</h4></strong>
		</center>
		<div>
			<span style="float:right">Fecha de evaluación: <b>{{$resultado->updated_at->format('d/m/Y')}}</b></span>
			<span>Paciente: <strong>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</strong>&nbsp;
				@if($solicitud->paciente->fechaNacimiento->age!=0)
				Edad: <strong>{{$solicitud->paciente->fechaNacimiento->age}} años</strong>
			  @endif
				</span>
		</div>
		<div>
			<span> Muestra: <strong>{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}}</strong></span>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			@php
				$cantidadSecciones=count($secciones);
				$cantidadFilas = count($espr);
				$aux = 0;
			@endphp
			@if ($cantidadSecciones==1)
				<div class="col-xs-3"></div>
			@endif
			@foreach ($secciones as $k=>$variable)
				@if($k%2==0 && $cantidadFilas < 12)
					<div class="row">
				@endif
				@if (($cantidadFilas >= 12 && $k == 0) || ($cantidadFilas < 12))	
					<div class="col-xs-6">
				@endif
					<center>
							<span class="font-plus">
								<b>
									<i class="fa fa-flask"></i>
									{{$espr->first()->nombreSeccion($variable)}}
								</b>
							</span>
							<div class="clearfix"></div>
						<table  class="table-simple">
							<thead>
								<th style="width:35%">Parámetro</th>
								<th style="width:20%">Resultado</th>
								@if ($banderaValores==1)
								<th style="width:30%">Valores normales</th>	
								@endif
								@if ($banderaUnidad==1)
								<th style="width:20%">Unidades</th>
								@endif
							</thead>
							<tbody>
								@if ($espr!=null)
									@foreach ($espr as $esp =>$valor)
										@if ($valor->f_seccion==$variable)
											<tr>
													<td style="width:35%"><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></td>
													<td style="width:20%"><center>{{$detallesResultado[$esp]->resultado}}</center></td>
													@if($banderaValores==1)
															@if (strlen($valor->parametro->valorMinimo)>0 || strlen($valor->parametro->unidad)>0)
																@if ($solicitud->paciente->sexo==0)
																	@if (strlen($valor->parametro->valorMinimoFemenino)>0)
																		<td style="width:30%"><center>{{number_format($valor->parametro->valorMinimoFemenino, 2, '.', '')." - ".number_format($valor->parametro->valorMaximoFemenino, 2, '.', '')}}</center></td>
																	@else
																		<td>-</td>
																	@endif
																@else
																	@if (strlen($valor->parametro->valorMinimo)>0)
																		<td style="width:30%"><center>{{number_format($valor->parametro->valorMinimo, 2, '.', '')." - ".number_format($valor->parametro->valorMaximo, 2, '.', '')}}</center></td>
																	@else
																		<td>-</td>
																	@endif
																@endif
																<td style="width:20%"><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
															@else
																<td style="width:30%">
																	<center>-</center>
																</td>
																<td style="width:20%">
																	<center>-</center>
																</td>
															@endif
													@else
															@if($banderaUnidad==1)
															<td style="width:20%"><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
															@endif
													@endif
													@if ($detallesResultado[$esp]->dato_controlado!=null)
														<td style="width:15%"><center>D.C.={{$detallesResultado[$esp]->dato_controlado}}</center></td>
													@endif
												</tr>
												@if ($cantidadFilas > 12 && $esp == round(($cantidadFilas/2)-1))
																</tbody>
															</table>
														</center>
													</div>
													<div class="col-xs-6">
														<center>
															<table  class="table-simple">
																<thead>
																	<thead>
																		<th style="width:35%">Parámetro</th>
																		<th style="width:20%">Resultado</th>
																		@if ($banderaValores==1)
																			<th style="width:30%">Valores normales</th>	
																		@endif
																		@if ($banderaUnidad==1)
																			<th style="width:20%">Unidades</th>
																		@endif
																</thead>
																<tbody>
												@endif
												@php
														if($cantidadFilas-1 == $esp){
															$aux = 1;
														}
												@endphp
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
				@if ($cantidadFilas < 12)	
					</div>
				@endif
				@if(($k%2!=0 && $cantidadFilas < 12) || $aux == 1)
					</div><!--Ey-->
				@endif
			@endforeach
			@if($resultado->observacion!=null)
				<div class="row">
					<div class="col-xs-12" style="margin-top: 15px">
						<p class=""><span class="text-primary"><b>OBSERVACIONES: </b></span> {{$resultado->observacion}}</p>
					</div>
				</div>
			@endif
			<div class="row">
				<div class="col-md-12 col-sm-12 col-12" style="margin-top: 15px">
						<div>
							<span>
								<img src={{asset(Storage::url($resultado->laboratorista->sello))}} style="width:250px">
								<img src={{asset(Storage::url($resultado->laboratorista->firma))}} style="width:180px;">
								@php
									$empresa=App\Empresa::find(1);
								@endphp
								<img src={{asset(Storage::url($empresa->sello_laboratorio))}} style="width:250px;">
							</span>
						</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>
</html>