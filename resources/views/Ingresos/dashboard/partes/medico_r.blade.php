<div class="row">
  <div class="col-sm-8">
    <h5 class="text-info">Médicos</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright mb-2">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#medico_m" ><i class="fa fa-plus"></i></button>
      @endif
    </div>
  </div>
</div>
<div class="flex-row">
	<center>
		<small class="form-text text-muted mb-1">Honorarios médicos registrados la últimas 24 horas</small>
	</center>
</div>
@if ($count_m > 0)    
  <div class="w-100" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
		@foreach ($medico_u as $medico)
			<div class="flex-row border py-1 rounded mb-3 alert-secondary text-dark">
				<div class="row">
					<div class="col-2">
						<a href="#" data-toggle="modal" data-target="#ver_medico" onclick={{'ver_medico('.$medico['id'].')'}}>
							<img src={{asset(Storage::url($medico['foto']))}} class="img-square-mini borde gray" style="margin-top: 0px;"></td>
						</a>
					</div>
					<div class="col-10">
						<div class="flex-row">
							<b class="font-md">
								{{$medico['nombre']}}
							</b>
						</div>
					</div>
				</div>
				<div class="flex-row">
					<span class="badge badge-primary float-right">{{'Frecuencia: '}} <span id="med_frec">{{$medico['frec']}}</span> </span>
				</div>
			</div>
		@endforeach
  </div>
@else
  <div class="flex-row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningún médico al paciente al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.medico')
@include('Ingresos.dashboard.modales.ver_medico')