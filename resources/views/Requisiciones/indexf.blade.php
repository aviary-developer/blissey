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
	@include('Requisiciones.Barra.index_f')
  <div class="col-sm-8">
    <div class="x_panel">
			<table class="table table-striped index-table table-hover table-sm" id="index-table">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					@if ($transacciones!=null)
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
											@if ($tipo==4)
												{!!Form::open(['url'=>['confirmarRequisicion',$transaccion->id],'method'=>'POST'])!!}
												<button type="submit" class="btn btn-success btn-sm" title="Atender"/>
												<i class="fa fa-check"></i>
												</button>
												{!!Form::close()!!}
											@endif
											@if ($tipo==5)
												<a href={!! asset('/requisiciones/'.$transaccion->id)!!} class="btn btn-sm btn-info" title="Ver">
													<i class="fa fa-info-circle"></i>
												</a>
											@endif
										</div>
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
@endsection
