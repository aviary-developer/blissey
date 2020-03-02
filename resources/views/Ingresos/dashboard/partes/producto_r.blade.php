<div class="row">
  <div class="col-sm-8">
		<h5 class="text-primary">Medicamentos</h5>	
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright mb-2">
      @if ($ingreso->estado == 1 && Auth::user()->tipoUsuario != "Médico")  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#productos_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_productos" id="btn_v_p"><i class="fa fa-search"></i></button>
    </div>
  </div>
</div>
<div class="flex-row">
	<center>
		<small class="form-text text-muted mb-1">Medicamentos registrados la últimas 24 horas</small>
	</center>
</div>
@if ($count_p24 > 0)  	
  <div class="w-100" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
		@foreach ($detalle_p as $detalle)
			@if ($detalle->created_at->between($ultima24,$ultima48))
				<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
					<div class="col-12">
						<div class="flex-row font-md">
							<small>
								{{$detalle->cantidad.' '}}
								@if($detalle->divisionProducto->unidad==null)
									{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
								@else
									{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
								@endif
							</small>
						</div>
						<div class="flex-row">
							<b class="font-md">{{$detalle->divisionProducto->producto->nombre}}</b>
						</div>
						<div class="flex-row">
							@if ($detalle->estado == 1)	
								<small class="badge badge-primary float-right">{{$detalle->created_at->diffForHumans()}}</small>
							@else
								<small class="badge badge-warning float-right">Pendiente</small>
							@endif
						</div>
					</div>
				</div>
			@endif
		@endforeach
  </div>
@else
  <div class="flex-row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningún medicamento al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.productos')
@include('Ingresos.dashboard.modales.ver_productos')