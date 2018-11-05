<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_signos" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Signos Vitales <span class="label-primary label label-lg">Nuevo</span></h4>
      </div>

      <div class="modal-body">
        <div class="col-xs-12">
          <div class="x_panel">
            @include('Signos.Formularios.form')
  
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarSignoModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>