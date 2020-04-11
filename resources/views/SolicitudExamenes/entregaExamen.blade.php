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
			<strong><h3>{{$solicitud->examen->nombreExamen}}</h3></strong>
		</center>
		<div>
			<span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span>
			<span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span>
		</div>
		<div>
			<span style="float: right">
				Fecha de evaluación: <b>{{$resultado->updated_at->format('d/m/Y h:i a')}}</b>
			</span>
			<span> Muestra: <strong><u>{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}}</u></strong></span>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			@php
				$cantidadSecciones=count($secciones);
			@endphp
			@if ($cantidadSecciones==1)
				<div class="col-xs-3"></div>
			@endif
			@foreach ($secciones as $k=>$variable)
				@if($k%2==0)
					<div class="row">
				@endif

				<div class="col-xs-6">
					<center>
						<table  class="table-simple">
							<div class="x_title">
								<span><big>{{$espr->first()->nombreSeccion($variable)}}</big></span>
								<div class="clearfix"></div>
							</div>
							<thead>
								<th>Parámetro</th>
								<th>Resultado</th>
								@if ($banderaValores==1)
								<th>Valores normales</th>	
								@endif
								@if ($banderaUnidad==1)
								<th>Unidades</th>
								@endif
							</thead>
							<tbody>
								@if ($espr!=null)
									@foreach ($espr as $esp =>$valor)
										@if ($valor->f_seccion==$variable)
											<tr>
													<td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></th>
													<td><center>{{$detallesResultado[$esp]->resultado}}</center></td>
													@if($banderaValores==1)
															@if ($valor->parametro->valorMinimo!=null)
																@if ($solicitud->paciente->sexo==0)
																	<td><center>{{number_format($valor->parametro->valorMinimoFemenino, 2, '.', '')." - ".number_format($valor->parametro->valorMaximoFemenino, 2, '.', '')}}</center></td>
																@else
																	<td><center>{{number_format($valor->parametro->valorMinimo, 2, '.', '')." - ".number_format($valor->parametro->valorMaximo, 2, '.', '')}}</center></td>
																@endif
																<td><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
															@else
																<th>-</th><th>-</th>
															@endif
													@else
															@if($banderaUnidad==1)
															<td><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
															@endif
													@endif
													@if ($detallesResultado[$esp]->dato_controlado!=null)
														<td><center>D.C.={{$detallesResultado[$esp]->dato_controlado}}</center></td>
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
				@if($k%2!=0)
					</div>
				@endif
			@endforeach
			@if($resultado->observacion!=null)
				<br>
				<div class="col-xs-12">
					<ul class="list-unstyled timeline widget">
						<li>
							<div class="block">
								<div class="block_content">
									<h2 class="title"><a>OBSERVACIONES:</a></h2>
									<p class="excerpt">{{$resultado->observacion}}</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			@endif
				<div class="col-md-12 col-sm-12 col-12" style="margin-top: 20px">
						<span> Realizó: <strong><i>{{$resultado->laboratorista->nombre}} {{$resultado->laboratorista->apellido}}</i></strong></span>
						<div>
							<span>
								<img src={{asset(Storage::url($resultado->laboratorista->sello))}} style="width:250px">
								<img src={{asset(Storage::url($resultado->laboratorista->firma))}} style="width:180px;">
								@php
									$empresa=App\Empresa::find(1);
								@endphp
								<img src={{asset(Storage::url($empresa->sello_laboratorio))}} style="width:180px;">
							</span>
						</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>