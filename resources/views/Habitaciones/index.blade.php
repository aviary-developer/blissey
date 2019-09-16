@extends('principal')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
	@endphp
	@include('Habitaciones.Barra.index')
  <div class="col-sm-8">
    <div class="x_panel">
			<table class="table table-striped table-hover table-sm index-table">
				<thead>
					<tr>
						<th>#</th>
						<th>Numero</th>
						<th>Camas</th>
						<th>Área</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					@php
					$correlativo = 1;
					@endphp
					@foreach ($habitaciones as $habitacion)
						<tr>
							<td>{{ $correlativo + $pagina }}</td>
							<td>
								<a href={{asset('/habitaciones/'.$habitacion->id)}}>
									{{ 'Habitación '.$habitacion->numero }}
								</a>
							</td>
							<td>{{ $habitacion->camas->count().' camas'}}</td>
							<td>
								@if ($habitacion->tipo == 1)
									<span class="badge font-sm border border-success text-success col-10">Ingreso</span>
								@elseif($habitacion->tipo == 2)
									<span class="badge font-sm border border-purple text-purple col-10">Medio ingreso</span>
								@else
									<span class="badge font-sm border border-primary text-primary col-10">Observación</span>
								@endif
							</td>
							<td>
								<center>
									@if ($estadoOpuesto)
										@include('Habitaciones.Formularios.activate')
									@else
										@include('Habitaciones.Formularios.desactivate')
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
  <!-- /page content -->
@endsection
