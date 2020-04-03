<div class="row">
  <div class="col-sm-8">
    <h5 class="text-info">Médico</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if (($ingreso->tipo == 3 && $ingreso->estado == 0))  
				<button type="button" id = "{{$detalle_hc->id}}" class="btn btn-primary btn-sm" onclick="{{'accion24(5,'.$detalle_hc->id.','.$detalle_hc->precio.')'}}"><i class="fa fa-edit"></i></button>
      @endif
    </div>
  </div>
</div>
<div class="row py-1" style="height: 125px;">
	<div class="col-12">
		<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
				<div class="row">
					<div class="col-2">
						<a href="#" data-toggle="modal" data-target="#ver_medico" onclick={{'ver_medico('.$ingreso->hospitalizacion->medico->id.')'}}>
							<img src={{asset(Storage::url($ingreso->hospitalizacion->medico->foto))}} class="img-square-mini borde gray" style="margin-top: 0px;"></td>
						</a>
					</div>
					<div class="col-10">
						<div class="flex-row">
							<b class="font-md">
								{{$detalle_hc->servicio->nombre}}
							</b>
						</div>
					</div>
				</div>
				<div class="flex-row">
					<span class="badge badge-primary float-right">{{'Precio de consulta: $'}} <span>{{number_format($detalle_hc->precio,2,'.',',')}}</span> </span>
				</div>
			</div>
	</div>
</div>