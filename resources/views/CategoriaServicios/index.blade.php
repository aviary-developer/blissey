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
	@include('CategoriaServicios.Barra.index')
  <div class="col-sm-8">
    <div class="x_panel">
			<table class="table table-striped table-hover table-sm index-table">
				<thead>
					<tr>
						<th style="width: 30px">#</th>
						<th>Nombre</th>
						<th style="width: 100px">Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($categoria_servicios!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($categoria_servicios as $categoria_servicio)
							<tr>
								<td>{{ $correlativo + $pagina}}</td>
								<td>
									{{ $categoria_servicio->nombre }}
								</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('CategoriaServicios.Formularios.activate')
										@else
											@include('CategoriaServicios.Formularios.desactivate')
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
