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
		$hoy = Carbon\Carbon::now();
	@endphp
	@include('BancoSangre.Barra.index')
  <div class="col-sm-8">
    <div class="x_panel">
			<table class="table table-striped table-hover table-sm index-table">
				<thead>
					<tr>
						<th>#</th>
						<th>Tipo de sangre</th>
						<th>Fecha de vencimiento</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($donaciones!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($donaciones as $donacion)
							<tr>
								<td>{{ $correlativo + $pagina}}</td>
								<td>
									@if ($donacion->tipoSangre == "A+")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-purple col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@elseif ($donacion->tipoSangre == "A-")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-danger col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@elseif ($donacion->tipoSangre == "B+")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-info col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@elseif ($donacion->tipoSangre == "B-")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-dark col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@elseif ($donacion->tipoSangre == "AB+")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-pink col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@elseif ($donacion->tipoSangre == "AB-")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-primary col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@elseif ($donacion->tipoSangre == "O+")
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-success col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@else
										<a class="white" href={{asset("#")}}>
											<span class="badge font-sm badge-warning col-10">
												{{$donacion->tipoSangre}}
											</span>
										</a>
									@endif
								</td>
								<td>
									{{Carbon\Carbon::parse($donacion->fechaVencimiento)->format('d / m / Y')}}
									<span class="badge badge-primary badge-pill">
										{{$donacion->fechaVencimiento->diffInDays($hoy).' días'}}
									</span>
								</td>
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('BancoSangre.Formularios.activate')
										@else
											@include('BancoSangre.Formularios.desactivate')
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
  @include('BancoSangre.pruebaCruzada')
  @endsection
