@extends('principal')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
	@endphp
	@include('Entradas.Barra.index')
  <div class="col-sm-10">
    <div class="x_panel">
			<table class="table table-striped index-table table-sm table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Razón</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
						@php
						$correlativo = 1;
						@endphp
						@foreach ($transacciones as $transaccion)
							<tr>
								<td>{{ $correlativo }}</td>
								<td>{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
								<td>{{$transaccion->comentario}}</td>
								<td>
									<center>
										<div class="btn-group">
												<a href={!! asset('/entradasver/'.$transaccion->id)!!} class="btn btn-sm btn-info" title="Ver">
													<i class="fa fa-info-circle"></i>
												</a>
										</div>
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
@endsection
