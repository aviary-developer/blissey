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
	$banderaObservacion=false;
	$observacion="";
@endphp
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="">
		<center>
			<strong><h4 style="font-weight: 600;">Química Sanguinea</h4></strong>
		</center>
		<div>
			<span style="float:right">Fecha de evaluación: <b>{{$resultadoConSolicitudCorrecta->created_at->format('d/m/Y')}}</b></span>
			<span>Paciente: <strong>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</strong> &nbsp;
				@if($solicitud->paciente->fechaNacimiento->age!=0)
				  Edad: <strong>{{$solicitud->paciente->fechaNacimiento->age}} años</strong>
				@endif
			</span>
		</div>
		<div>
			<span> Muestra: <strong>{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}}</strong></span>
		</div>
		<br>
		<div class="row">
		@if ($banderaParametroLargo==true)
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
		@else
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
		@endif
					<center>
						<table class="table-simple">
							<thead>
								<th>Parámetro</th>
								<th>Resultado</th>
								<th>Valores normales</th>
								<th>Unidades</th>
							</thead>
							<tbody>
								@if ($esprQuimicaSanguinea!=null)
									@foreach ($esprQuimicaSanguinea as $esp =>$valor)
											<tr>
													<td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></td>
													<td><center>{{$detallesResultadosQuimicaSanguinea[$esp]}}</center></td>
													@if (strlen($valor->parametro->valorMinimo)>0)
														@if ($solicitud->paciente->sexo==0)
															@if (strlen($valor->parametro->valorMinimoFemenino)>0)
															<td><center>{{number_format($valor->parametro->valorMinimoFemenino, 2, '.', '')." - ".number_format($valor->parametro->valorMaximoFemenino, 2, '.', '')}}</center></td>
															@else
															<td>-</td>
															@endif
														@else
															@if (strlen($valor->parametro->valorMinimo)>0)
															<td><center>{{number_format($valor->parametro->valorMinimo, 2, '.', '')." - ".number_format($valor->parametro->valorMaximo, 2, '.', '')}}</center></td>
															@else
															<td>-</td>
															@endif
														@endif
														<td><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
													@else
														<td><center>-</center></td><td><center>-</center></td>
													@endif
													@if ($tieneDatoControlado[$esp]!=-1)
														<td><center>D.C.={{$tieneDatoControlado[$esp]}}</center></td>
													@endif
												</tr>
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
					@php
					if($resultadoConSolicitudCorrecta->observacion!=null){
						/* if($observacion==""){
							$observacion=$rqs->observacion;	
						}else{
							$observacion=$observacion.", ".$rqs->observacion;
						}*/
						$observacionGeneral=$resultadoConSolicitudCorrecta->observacion;
						$banderaObservacion=true;
					}
					@endphp
			@if($banderaObservacion)
				<br>
				<div class="col-xs-12">
					<ul class="list-unstyled timeline widget">
						<li>
							<div class="block">
								<div class="block_content">
									<h2 class="title"><a>OBSERVACIONES:</a></h2>
									<p class="excerpt">{{$observacionGeneral}}</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			@endif
				<div class="col-md-12 col-sm-12 col-12" style="margin-top: 20px">
					<div>
							<span>
								<img src={{asset(Storage::url($resultadoConSolicitudCorrecta->laboratorista->sello))}} style="width:250px">
								<img src={{asset(Storage::url($resultadoConSolicitudCorrecta->laboratorista->firma))}} style="width:180px;">
								@php
									$empresa=App\Empresa::find(1);
								@endphp
								<img src={{asset(Storage::url($empresa->sello_laboratorio))}} style="width:260px;">
							</span>
						</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>