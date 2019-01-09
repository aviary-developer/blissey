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
	@include('Secciones.Barra.index')
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
					@if ($secciones!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($secciones as $seccion)
							<tr>
								<td>{{ $correlativo + $pagina}}</td>
								<td>
									<a href={{asset('#')}}>
										{{ $seccion->nombre }}
									</a>
								</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('Secciones.Formularios.activate')
										@else
											@include('Secciones.Formularios.desactivate')
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
