<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="n_ingreso" data-backdrop="static">
  <div class="modal-dialog" id="centro">
    <div class="flex-row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-search"></i>
              Buscar Paciente
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="flex-row">
      <div class="col-sm-12" id="izquierda">
        @include('Ingresos.index.modal.i_izq')
      </div>
      <div class="col-sm-6" id="derecha" style="display: none">
        @include('Ingresos.index.modal.i_der')
			</div>
			<div class="col-sm-6" id="derecha_nuevo" style="display: none">
				@include('Pacientes.Formularios.form_mini')
      </div>
    </div>
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="submit" class="btn btn-primary btn-sm col-2" id="guardar_i">Guardar</button>
        <button type="button" class="btn btn-light btn-sm col-2" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>