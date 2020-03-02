@extends('PDF.hoja')
@section('layout')
	<div class="row">
		<div>
			<center>
				<h3>Informe de turno de recepción</h3>
			</center>
		</div>
	</div>
	<hr class="my">
	<div class="row">
		<div class="col-xs-6">
			Usuario:
			<b>{{$user->nombre.' '.$user->apellido}}</b>
		</div>
		<div class="col-xs-6">
			Fecha:
			<b>{{$fecha_min->format('d/m/Y h:i a')}}</b> -
			<b>{{$fecha_max->format('d/m/Y h:i a')}}</b>
		</div>
	</div>
	<hr class="my">
	<div class="row">
		<!--Listar medicamentos-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>Medicamentos</h4>
					</center>
				</div>
			</div>

			@foreach ($l_productos as $k => $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad.' '}}
							@if($detalle->divisionProducto->unidad==null)
								{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
							@else
								{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
							@endif
						</small>
						<b>
							{{$detalle->divisionProducto->producto->nombre}}
						</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>

<!--Listar Examen de honorario-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>Honorarios Médicos</h4>
					</center>
				</div>
			</div>

			@foreach ($l_honorarios as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>

		<!--Listar Examen de Paquetes hospitalarios-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>Paquetes Hospitalarios</h4>
					</center>
				</div>
			</div>

			@foreach ($l_paquetes as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>

		<!--Listar Examen de laboratorio clínico-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>Laboratorio Clínico</h4>
					</center>
				</div>
			</div>

			@foreach ($l_laboratorios as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>

		
	</div>
	<hr class="my">
	<div class="row">
		<!--Listar Examen de Ultrasonografía-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>Ultrasonografía</h4>
					</center>
				</div>
			</div>

			@foreach ($l_ultras as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>

		<!--Listar Examen de Rayos X-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>Rayos X</h4>
					</center>
				</div>
			</div>

			@foreach ($l_rayos as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>	

		<!--Listar Examen de TACS-->
		<div class="col-xs-3">
			<div class="row">
				<div>
					<center>
						<h4>TAC</h4>
					</center>
				</div>
			</div>

			@foreach ($l_tacs as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
		</div>


		
	</div>
@endsection