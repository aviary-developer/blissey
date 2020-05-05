<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="seguimiento" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
			<div class="x_panel m_panel text-danger">
				<center>
					<h4 class="mb-1">
						<i class="fas fa-medkit"></i>
						Seguimiento de paciente
					</h4>
				</center>
			</div>
    </div>

    <div class="row">
			<div class="x_panel m_panel">
				<form action="" id="seguimiento_create_form">
					<div class="form-group">
						<label class="" for="fecha_seguimiento_create">Fecha</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-calendar-check"></i></div>
							</div>
							@php
									$fecha = Carbon\Carbon::now();
							@endphp
							<input type="datetime-local" name="fecha" id="fecha_seguimiento_create" class="form-control form-control-sm" value={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}} max={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}}>
						</div>
					</div>
					<div class="form-group">
						<label class="" for="descripcion_seguimiento_create">Descripción: *</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
							</div>
							<textarea type="datetime-local" name="descripcion" id="descripcion_seguimiento_create" class="form-control form-control-sm" placeholder="Descripción del estado del paciente" rows="10"></textarea>
						</div>
					</div>
				</form>
			</div>
    </div>
    
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
				<button type="button" class="btn btn-sm btn-primary col-4" id="save_seguimiento_create">Guardar</button>
        <button type="button" class="btn btn-light col-4 btn-sm" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>