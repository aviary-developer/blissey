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
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Medicamentos</h4>
					</center>
				</div>
			</div>

			@php
					$c_producto = 0;
			@endphp
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
						@php
								$c_producto += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_producto,2,'.',',')}}
				</div>
			</div>
		</div>

<!--Listar Examen de honorario-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Honorarios Médicos</h4>
					</center>
				</div>
			</div>

			@php
					$c_honorario = 0;
			@endphp
			@foreach ($l_honorarios as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_honorario += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_honorario,2,'.',',')}}
				</div>
			</div>
		</div>

		<!--Listar Examen de Paquetes hospitalarios-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Paquetes Hospitalarios</h4>
					</center>
				</div>
			</div>

			@php
					$c_paquetes = 0;
			@endphp
			@foreach ($l_paquetes as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_paquetes += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_paquetes,2,'.',',')}}
				</div>
			</div>
		</div>

		<!--Listar Examen de laboratorio clínico-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Laboratorio Clínico</h4>
					</center>
				</div>
			</div>

			@php
					$c_laboratorio = 0;
			@endphp
			@foreach ($l_laboratorios as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_laboratorio += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_laboratorio,2,'.',',')}}
				</div>
			</div>
		</div>	
	</div>

	<hr>

	<div class="row">
		<!--Listar Examen de Ultrasonografía-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Ultrasonografía</h4>
					</center>
				</div>
			</div>

			@php
					$c_ultra = 0;
			@endphp
			@foreach ($l_ultras as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_ultra += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_ultra,2,'.',',')}}
				</div>
			</div>
		</div>

		<!--Listar Examen de Rayos X-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Rayos X</h4>
					</center>
				</div>
			</div>

			@php
					$c_rayos = 0;
			@endphp
			@foreach ($l_rayos as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_rayos += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_rayos,2,'.',',')}}
				</div>
			</div>
		</div>	

		<!--Listar Examen de TACS-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>TAC</h4>
					</center>
				</div>
			</div>

			@php
					$c_tac = 0;
			@endphp
			@foreach ($l_tacs as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_tac += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_tac,2,'.',',')}}
				</div>
			</div>
		</div>

		<!--Listar Examen de Servicios-->
		<div class="col-xs-3 bordered">
			<div class="row">
				<div>
					<center>
						<h4>Servicios</h4>
					</center>
				</div>
			</div>

			@php
					$c_servicio = 0;
			@endphp
			@foreach ($l_servicios as $detalle)
				<div class="row">
					<div class="col-xs-8">
						<small>
							{{$detalle->cantidad}}
						</small>
						<b>{{$detalle->servicio->nombre}}</b>
					</div>
					<div class="col-xs-4">
						@php
								$c_servicio += $detalle->precio * $detalle->cantidad;
						@endphp
						{{'$ '.number_format($detalle->precio * $detalle->cantidad,2,'.',',')}}
					</div>
				</div>
			@endforeach
			<div class="row">
				<div class="col-xs-8">
					Total
				</div>
				<div class="col-xs-4">
					{{'$ '.number_format($c_servicio,2,'.',',')}}
				</div>
			</div>
		</div>
		
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			Total diario:
			@php
					$total_d = $c_producto + $c_honorario + $c_paquetes + $c_laboratorio + $c_ultra + $c_rayos + $c_tac + $c_servicio;
			@endphp
			<b class="bg-green-2" style="font-size: 120%;">{{'$ '.number_format($total_d,2,'.',',')}}</b>
		</div>
	</div>
@endsection