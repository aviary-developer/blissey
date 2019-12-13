<div class="row">
  <div class="col-sm-8">
    <h5 class="text-primary">Servicios</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright mb-2">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#servicios_m" onclick="cambioRadio(3)"><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_servicios" id="btn_v_s"><i class="fa fa-search"></i></button>
    </div>
  </div>
</div>
<div class="flex-row">
	<center>
		<small class="form-text text-muted mb-1">Servicios registrados la últimas 24 horas</small>
	</center>
</div>
@if ($count_s24 > 0)    
  <div class="w-100" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
		@foreach ($detalle_s as $detalle)
			@if ($detalle->created_at->between($ultima24,$ultima48))
				<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
					<div class="col-12">
						<div class="flex-row font-md">
							<small>
                  {{$detalle->cantidad.' '}}
                </small>
                &nbsp;
                <b class="">
                  {{$detalle->servicio->nombre}}
                </b>
						</div>
						<div class="flex-row">
								<small class="badge badge-primary float-right">{{$detalle->created_at->diffForHumans()}}</small>
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
      <span>No se ha registrado ningún servicio al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.servicios')
@include('Ingresos.dashboard.modales.ver_servicios')