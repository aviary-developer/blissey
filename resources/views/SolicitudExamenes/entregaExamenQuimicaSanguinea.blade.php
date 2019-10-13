@extends('PDF.hoja')
@section('layout')
@php
	$fecha = Carbon\Carbon::now();
	$banderaObservacion=false;
	$observacion="";
@endphp
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="">
		<center>
			<strong><h3>Química Sanguinea</h3></strong>
		</center>
		<div>
			<span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span>
			<span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span>
		</div>
		<div>
			<span style="float: right">
				Fecha de evaluación: <b><u>{{$resultadosQuimicaSanguinea[0]->created_at->format('d/m/Y')}}</u></b>
			</span>
			<span> Muestra: <strong><u>{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}}</u></strong></span>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		<div class="col-xs-3"></div>
				<div class="col-xs-6">
					<center>
						<table class="table-simple">
							<div class="x_title">
								<span><big>Química Sanguinea</big></span>
								<div class="clearfix"></div>
							</div>
							<thead>
								<th>Parametro</th>
								<th>Resultado</th>
								<th>Valores normales</th>
								<th>Unidades</th>
							</thead>
							<tbody>
								@if ($esprQuimicaSanguinea!=null)
									@foreach ($esprQuimicaSanguinea as $esp =>$valor)
											<tr>
													<td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></th>
													<td><center>{{$detallesResultadosQuimicaSanguinea[$esp]->resultado}}</center></td>
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
													@if ($detallesResultadosQuimicaSanguinea[$esp]->dato_controlado!=null)
														<td><center>D.C.={{$detallesResultado[$esp]->dato_controlado}}</center></td>
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
				@foreach ($resultadosQuimicaSanguinea as $item => $rqs)
					@php
					if($rqs->observacion!=null){
						if($observacion==""){
							$observacion=$rqs->observacion;	
						}else{
							$observacion=$observacion.", ".$rqs->observacion;
						}
						$banderaObservacion=true;
					}
					@endphp
				@endforeach
			@if($banderaObservacion)
				<br>
				<div class="col-xs-12">
					<ul class="list-unstyled timeline widget">
						<li>
							<div class="block">
								<div class="block_content">
									<h2 class="title"><a>OBSERVACIONES:</a></h2>
									<p class="excerpt">{{$observacion}}</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			@endif
				<div class="col-md-12 col-sm-12 col-12" style="margin-top: 20px">
					<center>
						<div>
							<span> Realizó: <strong><i>{{$resultadosQuimicaSanguinea[0]->laboratorista->nombre}} {{$resultadosQuimicaSanguinea[0]->laboratorista->apellido}}</i></strong></span> &nbsp
							<span>
								<img src={{asset(Storage::url($resultadosQuimicaSanguinea[0]->laboratorista->sello))}} style="width:180px;">
								<img src={{asset(Storage::url($resultadosQuimicaSanguinea[0]->laboratorista->firma))}} style="width:180px;">
							</span>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>
@endsection