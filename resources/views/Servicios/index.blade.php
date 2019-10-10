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
	@include('Servicios.Barra.index')
  <div class="col-sm-10">
    <div class="x_panel">
			<table class="table table-striped table-hover table-sm index-table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Categoría</th>
						<th style="width: 100px">Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($servicios!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($servicios as $servicio)
							<tr>
								<td>{{ $correlativo}}</td>
								<td>
									{{ $servicio->nombre }}
								</td>
								<td align="right">{{ '$ '.number_format($servicio->precio,2,'.',',') }}</td>
								<td>
									<span class="badge badge-light font-sm col-12">
										{{ $servicio->nombreCategoria($servicio->f_categoria) }}
									</span>
								</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('Servicios.Formularios.activate')
										@else
											@include('Servicios.Formularios.desactivate')
										@endif
									</center>
								</td>
							</tr>
							@php
							$correlativo++;
							@endphp
						@endforeach
					@endif
				</tbody>
			</table>
    </div>
  </div>
  <!-- /page content -->
@endsection
