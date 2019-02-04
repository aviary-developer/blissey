@php
  setlocale(LC_ALL,'es');
@endphp
@extends('principal')
@section('layout')
	@include('Entradas.Barra.show')
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
						<th>Lote</th>
						<th>Estante</th>
						<th>Nivel</th>
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
						<td>
							{{$detalle->lote}}
						</td>
						<td>
							{{$detalle->estante->codigo}}
						</td>
						<td>
							{{$detalle->nivel}}
						</td>
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
					Razón del ingreso
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
                <span class="badge border border-success text-success">{{$transaccion->comentario}}</span>
				</h6>
			</div>
		</div>
	</div>
{!!Form::close()!!}
@endsection
