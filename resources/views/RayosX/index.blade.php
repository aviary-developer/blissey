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
	@include('RayosX.Barra.index')
  <div class="col-sm-8">
    <div class="x_panel">
			<table class="table table-striped table-hover table-sm index-table">
				<thead>
					<tr>
						<th style="width: 10%">#</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th style="width:25%">Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($rayosx!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($rayosx as $rayox)
							<tr>
								<td>{{ $correlativo + $pagina}}</td>
								<td>{{ $rayox->nombre}}</td>
								<td>{{ '$ '.number_format($rayox->servicio->precio,2,'.',',')}}</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('RayosX.Formularios.activate')
										@else
											@include('RayosX.Formularios.desactivate')
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
