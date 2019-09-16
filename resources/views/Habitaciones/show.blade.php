@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
	@endphp
	@include('Habitaciones.Barra.show')

	<div class="col-sm-8">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h5>Camas</h5>
				</center>
			</div>
			<table class="table table-sm table-hover table-striped">
				<thead>
					<th>#</th>
					<th>Cama</th>
					<th>Precio</th>
					<th>Dispobilidad</th>
					<th>Estado</th>
				</thead>
				<tbody>
					@php
						$correlativo = 1;
					@endphp
					@foreach ($habitacion->camas as $cama)
						<tr>
							<td>
								{{$correlativo}}
							</td>
							<td>
								{{$cama->servicio->nombre}}
							</td>
							<td>
								{{ '$ '.number_format($cama->precio,2,'.',',') }}
							</td>
							<td>
								@if (!$cama->estado && $cama->activo)
									<span class="badge badge-success font-sm col-10">
										Disponible
									</span>
								@else
									<span class="badge badge-danger font-sm col-10">
										Ocupada
									</span>
								@endif
							</td>
							<td>
								<center>
									@if ($cama->activo)
										<span class="badge badge-light text-success font-sm col-4" title="Activa">
											<i class="fas fa-check-circle"></i>
										</span>
									@else
										<span class="badge badge-light text-danger font-sm col-4" title="En papelera">
											<i class="fas fa-trash"></i>
										</span>
									@endif
								</center>
							</td>
						</tr>
						@php
							$correlativo++;
						@endphp
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h5>Información General</h5>
				</center>
			</div>

			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					Número
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					{{'Habitación '.$habitacion->numero}}
				</h6>
			</div>

			<div class="ln_solid mb-1 mt-1"></div>
			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					Área
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					@if ($habitacion->tipo == 1)
						<span class="badge font-sm border border-success text-success col-4">Ingreso</span>
					@elseif($habitacion->tipo == 2)
						<span class="badge font-sm border border-purple text-purple col-4">Medio ingreso</span>
					@else
						<span class="badge font-sm border border-primary text-primary col-4">Observación</span>
					@endif
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
					@if ($habitacion->estado)
						<span class="badge text-success border border-success col-4">Activo</span>
					@else
						<span class="badge text-danger border border-danger col-4">En papelera</span>
					@endif
				</h6>
			</div>
		</div>
	</div>
@endsection
