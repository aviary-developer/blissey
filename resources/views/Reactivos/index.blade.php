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
	
	@include('Reactivos.Barra.index')
  <div class="col-sm-9">
    <div class="x_panel">
			<table class="table table-striped table-hover index-table table-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Fecha de vencimiento</th>
						<th>Existencias</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($reactivos!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($reactivos as $reactivo)
							<tr>
								<td>{{ $correlativo }}</td>
								<td>
									<a href={{asset('/reactivos/'.$reactivo->id)}}>
										{{ $reactivo->nombre }}
									</a>
								</td>
								<td>{{Carbon\Carbon::parse($reactivo->fechaVencimiento)->format('d / m / Y')}}</td>
								<td>
									<center>
										@if($reactivo->contenidoPorEnvase<10)		
											<button type="button" class="btn btn-sm col-6 btn-outline-danger" value={{ $reactivo->contenidoPorEnvase}}  onclick="botonExistencias(this,'{{$reactivo->nombre}}','{{$reactivo->id}}');" data-toggle="modal" data-target="#modalExistencias">
												{{ $reactivo->contenidoPorEnvase.' '}}
												<i class="fas fa-sort"></i>
											</button>
										@else
											<button type="button" class="btn btn-sm col-6 btn-outline-primary" value={{ $reactivo->contenidoPorEnvase}}  onclick="botonExistencias(this,'{{$reactivo->nombre}}','{{$reactivo->id}}');" data-toggle="modal" data-target="#modalExistencias">
												{{ $reactivo->contenidoPorEnvase.' '}}
												<i class="fas fa-sort"></i>
											</button>
										@endif
									</center>
								</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('Reactivos.Formularios.activate')
										@else
											@include('Reactivos.Formularios.desactivate')
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
  @include('Reactivos.Formularios.agregarExistencias')
@endsection
