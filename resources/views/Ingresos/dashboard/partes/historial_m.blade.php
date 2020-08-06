<div class="row">
  <div class="col-sm-2">
    <button type="button" class="btn btn-sm btn-dark" id="back_historial" data-tooltip="tooltip" title="Atras" style="display:none"><i class="fa fa-arrow-left"></i></button>
    <input type="hidden" id="nivel" value="">
  </div>
  <div class="col-sm-8">
    <center>
	  <h5 class="text-info">Historial Médico</h5>
	  <input type="hidden" id="estaEditandoReceta" value=0>
    </center>
  </div>
  <div class="col-sm-2"></div>
</div>
<div class="col-sm-12" style="height: 480px; overflow-x:hidden; overflow-y:scroll" id="historial">
  @if ($historial != null)
		@foreach ($historial as $hospitalizacion)
			@foreach ($hospitalizacion->ingreso as $ingreso_f)
				<div class="col-sm-12 m-1 border border-secondary rounded">
					<div class="flex-row">
						<center>
							<h6 class="text-primary mt-1">
								<i class="far fa-calendar"></i> 
								{{$ingreso_f->fecha_ingreso->formatLocalized('%d de %B de %Y a las %H:%M')}}
							</h6>
						</center>
					</div>
					<div class="flex-row mb-1">
						<div class="col-sm-9">
							@if ($ingreso_f->tipo == 3 && $ingreso_f->consulta->count() > 0)
								<div class="flex-row">
									<center>
										<span class="font-weight-bold">
											<i class="fa fa-stethoscope"></i> 
											{{(($ingreso_f->consulta[0]->medico->sexo)?"Dr. ":"Dra. ").$ingreso_f->consulta[0]->medico->nombre.' '.$ingreso_f->consulta[0]->medico->apellido}}
										</span>
									</center>
								</div>
								<div class="flex-row mb-1">
									<center>
										<i>
											<span>
												{{
													'"'.$ingreso_f->consulta[0]->diagnostico.'"'
												}}
											</span>
										</i>
									</center>
								</div>
							@endif
							<div class="flex-row">
								<center>
									@if ($ingreso_f->tipo == 0)
										<span class="col-6 badge font-sm mb-2 badge-success">Hospitalización</span>
									@elseif($ingreso_f->tipo == 1)
										<span class="col-6 badge font-sm mb-2 badge-purple">Medio Ingreso</span>
									@elseif($ingreso_f->tipo == 2)
										<span class="col-6 badge font-sm mb-2 badge-primary">Observación</span>
									@elseif($ingreso_f->tipo == 3)
										<span class="col-6 badge font-sm mb-2 badge-pink">Consulta Médica</span>
									@endif
									@if ($ingreso_f->id == $ingreso->id)
										<span class="badge badge-warning font-sm">Actual</span>
									@endif
								</center>
							</div> 
						</div>
						<div class="col-sm-3">
							<div class="btn-group">
								@if ($ingreso_f->tipo == 3)
									@if ($ingreso_f->consulta->count() > 0)		
										<button type="button" class="btn btn-sm btn-dark mb-2" onclick={{'v_consulta('.(($ingreso_f->tipo == 3 && $ingreso_f->consulta->count() > 0)?$ingreso_f->consulta[0]->id:$ingreso_f->id).','.$ingreso_f->tipo.')'}}>
											<i class="fa fa-eye"></i>
										</button>										
										@if ($ingreso_f->id == $ingreso->id)
											<button type="button" class="btn btn-sm btn btn-success mb-2" data-toggle="modal" data-target="#editarConsulta" id="botonEditarConsulta" onclick={{'asignarIdConsulta('.(($ingreso_f->tipo == 3 && $ingreso_f->consulta->count() > 0)?$ingreso_f->consulta[0]->id:$ingreso_f->id).')'}}>
												<i class="fa fa-edit"></i>
											</button>
										@endif
									@else
										<button type="button" class="btn btn-sm btn-dark mb-2" disabled>
											<i class="fa fa-eye"></i>
										</button>
									@endif
								@else
									@if($ingreso_f->consulta->count() > 0)
										<button type="button" class="btn btn-sm btn-dark mb-2" onclick={{'v_consulta('.(($ingreso_f->tipo == 3 && $ingreso_f->consulta->count() > 0)?$ingreso_f->consulta[0]->id:$ingreso_f->id).','.$ingreso_f->tipo.')'}}>
											<i class="fa fa-ellipsis-h"></i>
										</button>
									@else
									<button type="button" class="btn btn-sm btn-dark mb-2" disabled>
											<i class="fa fa-ellipsis-h"></i>
										</button>
									@endif
								@endif
								@if ($ingreso_f->tipo == 3 && $ingreso_f->consulta->count() > 0)
									<a href={!!asset('/recetas/'.$ingreso_f->consulta[0]->id) !!} class="btn btn-sm btn-primary mb-2" target="_blank">
										<i class="fa fa-prescription"></i>
									</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach
    @endforeach
  @else
    <center style="margin-top: 200px">
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>El paciente no reporta historial médico por el momento</span>
    </center>
  @endif
</div>

@include('Pacientes.Partes.modal_examenes')
@include('Pacientes.Partes.modal_evaluacion')
@include('Ingresos.dashboard.modales.editarConsulta')
