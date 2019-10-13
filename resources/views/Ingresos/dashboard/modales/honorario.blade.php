<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="honorario_m" data-backdrop="static">
  <div class="modal-dialog">
    <div class="x_panel m_panel text-danger">
      <center>
        <h4 class="mb-1">
          <i class="fas fa-medkit"></i>
          Honorario Médico
        </h4>
      </center>
    </div>

    <div class="m_panel x_panel">
      <div class="form-group col-sm-12">
				<label class="" for="altura">Honorarios Médicos de</label>
				<h5>{{(($ingreso->hospitalizacion->medico->sexo)?'Dr. ':'Dra. ').$ingreso->hospitalizacion->medico->nombre.' '.$ingreso->hospitalizacion->medico->apellido}}</h5>
			</div>
			<div class="form-group col-sm-12">
				<label class="" for="altura">Precio</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					<input type="number" step="0.01" min="0" class="form-control form-control-sm" placeholder="Precio del honorario" id="precio_honorario" value="{{$ingreso->hospitalizacion->medico->servicio->precio + $ingreso->hospitalizacion->medico->servicio->retencion}}">
				</div>
			</div>
			<input type="hidden" id="id_honorario" value="{{$ingreso->hospitalizacion->medico->servicio->id}}">
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-primary btn-sm col-2" id="honorario_save">Guardar</button>
      <button type="button" class="btn btn-sm btn-light col-2" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>