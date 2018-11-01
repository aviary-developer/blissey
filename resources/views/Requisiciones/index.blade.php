@extends('principal')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  if ($tipo==4) {
    $estadoOpuesto=5;
  } else {
    $estadoOpuesto=4;
  }
	@endphp
	@include('Requisiciones.Barra.index')
  <div class="col-sm-8">
    <div class="x_panel">
			<table class="table table-striped index-table table-sm table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
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
								<td>
									<center>
										<div class="btn-group">
											@if ($transaccion->tipo==6 || $tipo==4)
												<a href={!! asset('/requisiciones/'.$transaccion->id)!!} class="btn btn-sm btn-info" title="Ver">
													<i class="fa fa-info-circle"></i>
												</a>
											@endif
											@if ($tipo==4)
												@include('Requisiciones.Formularios.eliminarRequisicion')
											@endif
											@if ($transaccion->tipo==5)
												{!!Form::open(['url'=>['asignarRequisicion',$transaccion->id],'method'=>'POST'])!!}
												<button type="submit" class="btn btn-success btn-sm" title="Asignar ubicación"/>
												<i class="fa fa-check"></i>
											</button>
											{!!Form::close()!!}
											@endif
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
