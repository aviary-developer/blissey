<div class="row">
  <div class="col-sm-8">
    <h5 class="text-info">Indicaciones</h5>
  </div>
  <div class="col-sm-4">
  </div>
</div>
<div class="flex-row">
	<div class="w-100" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
		@if ($indicaciones != null)
			@foreach ($indicaciones as $indicacion)
				<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
					<div class="row">
						<div class="col-9">
							<div class="flex-row">
								<b class="font-md">
									Indicación de 
									{{(($indicacion->sexo)?'Dr. ':'Dra. ').$indicacion->nombre.' '.$indicacion->apellido}}
								</b>
							</div>
							<div class="flex-row">
								<span class="badge badge-primary float-right">{{$indicacion->created_at->diffForHumans()}}</span>
							</div>
						</div>
						<div class="col-3">
							<center>
								<button type="button" class="btn btn-sm btn-info" title="Ver" data-id="{{$indicacion->id}}" id="ver_receta_e" data-toggle="modal" data-target="#ver_receta_div_e">
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
@include('Ingresos.dashboard.modales.indicaciones_receta')