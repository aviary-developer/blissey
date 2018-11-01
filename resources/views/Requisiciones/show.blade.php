@php
  setlocale(LC_ALL,'es');
@endphp
@extends('principal')
@section('layout')
	@include('Requisiciones.Barra.show')
	<div class="col-sm-8">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h5>Detalle</h5>
				</center>
			</div>
			<table class="table table-striped table-sm table-hover">
				<thead>
					<th>Cantidad</th>
					<th colspan='2'>Detalle</th>
					@if ($transaccion->tipo==5 || $transaccion->tipo==6)
						<th>Lote</th>
					@endif
					@if ($transaccion->tipo==6)
						<th>Estante</th>
						<th>Nivel</th>
					@endif
				</thead>
				@php
				$detalles=$transaccion->detalleTransaccion;
				$total=0;
				@endphp
	
				<tbody>
				@foreach ($detalles as $detalle)
					<tr>
						<td>{{$detalle->cantidad}}</td>
						<td>{{$detalle->divisionProducto->producto->nombre}}</td>
						<td>
							@if($detalle->divisionProducto->unidad==null)
								{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
							@else
								{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
							@endif
						</td>
						@if ($transaccion->tipo==5 || $transaccion->tipo==6)
							<td>
							{{$detalle->lote}}
						</td>
						@endif
						@if ($transaccion->tipo==6)
							<td>
							{{$detalle->estante->codigo}}
						</td>
						<td>
							{{$detalle->nivel}}
						</td>
						@endif
					@endforeach
				</tbody>
	
			</table>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h4>Información General</h4>
				</center>
			</div>

			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					Fecha
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}
				</h6>
			</div>

			<div class="ln_solid mb-1 mt-1"></div>
			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					Estado
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					@if ($transaccion->tipo == 4)
						<span class="badge border border-danger text-danger col-4">Pendiente</span>
					@elseif($transaccion->tipo == 5 || $transaccion->tipo == 6)
						<span class="badge border border-success text-success col-4">Atendida</span>
					@endif
				</h6>
			</div>
		</div>
	</div>
{!!Form::close()!!}
@endsection
