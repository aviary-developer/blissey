<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ver_seguimiento_modal" data-backdrop="static">
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
				@include('Ingresos.dashboard.partes.ver_seguimiento')
			</div>
    </div>
    
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-light col-4 btn-sm" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>