<div class="row">
  <div class="col-sm-8">
    <h5 class="text-purple">Laboratorio</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright mb-2">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#laboratorio_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_laboratorio" id="btn_v_l"><i class="fa fa-search"></i></button>
    </div>
  </div>
</div>
<div class="flex-row">
	<center>
		<small class="form-text text-muted mb-1">Exámenes registrados la últimas 24 horas</small>
	</center>
</div>
@if ($count_l24 > 0)    
  <div class="flex-row" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
		@foreach($detalle_l as $solicitud)
			@if ($solicitud->examen != null)
				@if($solicitud->created_at->between($ultima24, $ultima48))
					<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
						<div class="col-12">
							<div class="flex-row font-md">
                  <b class="">{{$solicitud->examen->nombreExamen}}</b>
							</div>
							<div class="flex-row">
								<span class="badge badge-light">
									{{'Muestra: '.$solicitud->codigo_muestra}}
								</span>
								@if ($solicitud->estado == 0)
									<span class="badge badge-warning" title="Pendiente">Pendiente</span>
								@elseif($solicitud->estado == 1)
									<span class="badge badge-primary" title="Evaluando">Evaluando</span>
								@else
									<span class="badge badge-success" title="Listo">Listo</span>
								@endif
							</div>
							<div class="flex-row">
									<small class="badge badge-primary float-right">{{$solicitud->created_at->diffForHumans()}}</small>
							</div>
						</div>
					</div>
				@endif
			@endif
		@endforeach
  </div>
@else
  <div class="flex-row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningún examen al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.examenes')
@include('Ingresos.dashboard.modales.ver_laboratorio')