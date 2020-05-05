<div class="row">
  <div class="col-sm-8">
    <h5 class="text-info">Seguimiento</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1 || ($ingreso->tipo == 3 && $ingreso->estado == 0))  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#seguimiento" ><i class="fa fa-plus"></i></button>
      @endif
    </div>
  </div>
</div>
<div class="flex-row">
	<div class="w-100" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
		@if ($seguimientos != null)
			@foreach ($seguimientos as $seguimiento)
				<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
					<div class="row">
						<div class="col-9">
							<div class="flex-row">
								<b class="font-md">
									Seguimiento de 
									{{$seguimiento->enfermeria->nombre.' '.$seguimiento->enfermeria->apellido}}
								</b>
							</div>
							<div class="flex-row">
								<span class="badge badge-primary float-right">{{$seguimiento->fecha->diffForHumans()}}</span>
							</div>
						</div>
						<div class="col-3">
							<center>
								<button type="button" class="btn btn-sm btn-info" title="Ver" onclick="{{'v_seguimiento('.$seguimiento->id.')'}}" data-toggle="modal" data-target="#ver_seguimiento_modal">
									<i class="fas fa-eye"></i>
								</button>
							</center>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>
@include('Ingresos.dashboard.modales.seguimiento')
@include('Ingresos.dashboard.modales.ver_seguimiento')