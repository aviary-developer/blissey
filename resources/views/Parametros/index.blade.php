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
	@include('Parametros.Barra.index')
  <div class="col-sm-10">
    <div class="x_panel">
			<table class="table table-striped table-hover table-sm index-table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Valor predeterminado</th>
						<th>Unidad de medida</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($parametros!=null)
						@php
						$correlativo = 1;
						@endphp
						@foreach ($parametros as $parametro)
							<tr>
								<td>{{ $correlativo + $pagina}}</td>
								<td>
									<a href={{asset('/parametros/'.$parametro->id)}}>
										{{ $parametro->nombreParametro}}
									</a>
								</td>
							@if($parametro->valorPredeterminado!=null)
								@if (!is_numeric($parametro->valorPredeterminado))
										<td>
											<span class="badge font-sm badge-primary col-sm-10">{{$parametro->valorPredeterminado}}</span>
										</td>
									@else
										<td>
											<span class="badge font-sm badge-primary col-sm-10">{{number_format($parametro->valorPredeterminado, 2, '.', ',')}}</span>
										</td>
									@endif
								@else<td>
									<span class="badge font-sm border border-secondary text-secondary col-sm-10">Ninguno</span>
								</td>
								@endif
								@if($parametro->unidad!=null)
									<td>
										<span class="badge badge-light col-sm-10 font-sm">
											{{ $parametro->nombreUnidad($parametro->unidad)}}
										</span>
									</td>
								@else
									<td>
										<span class="badge font-sm border border-secondary text-secondary col-sm-10">Ninguna</span>
									</td>
								@endif
								<td>
									<center>
										@if ($estadoOpuesto)
											@include('Parametros.Formularios.activate')
										@else
											@include('Parametros.Formularios.desactivate')
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
