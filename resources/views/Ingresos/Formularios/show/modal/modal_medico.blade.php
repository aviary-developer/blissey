<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_medico" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Servicios médicos</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel" style="min-height: 400px;">

          @include('Ingresos.Formularios.show.vistas.medicos_seleccion')

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarMedicoModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>