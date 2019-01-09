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
	@include('Tac.Barra.index')
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
					@if ($tacs!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($tacs as $tac)
							<tr>
								<td>{{ $correlativo + $pagina}}</td>
								<td>{{ $tac->nombre}}</td>
								<td>{{ '$ '.number_format($tac->servicio->precio,2,'.',',')}}</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('Tac.Formularios.activate')
										@else
											@include('Tac.Formularios.desactivate')
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
