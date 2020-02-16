<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="acta" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="flex-row">
			<div class="x_panel m_panel text-danger">
				<center>
					<h4 class="mb-1">
						<i class="fas fa-print"></i>
						Generar acta de consentimiento
					</h4>
				</center>
			</div>
    </div>
    <div class="flex-row">
      <div class="x_panel m_panel">
				@include('Ingresos.index.modal.partes.acta_datos')
			</div>
    </div>
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-primary btn-sm col-2 " id="acta-btn-generar" disabled>Generar</button>
				<button type="button" class="btn btn-light btn-sm col-2" onclick="location.reload()">Cerrar</button>
				<a href="#" target="_blank" class="hidden" id="launch"></a>
      </center>
		</div>
  </div>
</div>

{!!Html::script('js/scripts/Acta.js')!!}