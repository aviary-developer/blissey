@extends('PDF.hoja')
@section('layout')
@php
	$fecha = Carbon\Carbon::now();
@endphp
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="">
		<center>
			<strong><h2>{{$solicitud->examen->nombreExamen}}</h2></strong>
		</center>
		<div>
			<span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span>
			<span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span>
		</div>
		<div>
			<span style="float: right">
				Fecha de evaluación: <b><u>{{$resultado->created_at->format('d/m/Y')}}</u></b>
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
						<table class="table-simple">
							<div class="x_title">
								<span><big>{{$espr->first()->nombreSeccion($variable)}}</big></span>
								<div class="clearfix"></div>
							</div>
							<thead>
								<th>Parametro</th>
								<th>Resultado</th>
								<th>Valores normales</th>
								<th>Unidades</th>
							</thead>
							<tbody>
								@if ($espr!=null)
									@foreach ($espr as $esp =>$valor)
										@if ($valor->f_seccion==$variable)
											<tr>
													<td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></th>
													<td><center>{{$detallesResultado[$esp]->resultado}}</center></td>
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
					<center>
						<div>
							<span> Realizó: <strong><i>{{$resultado->laboratorista->nombre}} {{$resultado->laboratorista->apellido}}</i></strong></span> &nbsp
							<span>
								<img src={{asset(Storage::url($resultado->laboratorista->sello))}} style="width:180px;">
								<img src={{asset(Storage::url($resultado->laboratorista->firma))}} style="width:180px;">
							</span>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>
@endsection