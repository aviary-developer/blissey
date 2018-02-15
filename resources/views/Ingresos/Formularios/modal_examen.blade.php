<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal3">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Reactivo <span class="label-primary label label-lg">Nuevo</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <input type="hidden" id="tokenReactivoModal" name="tokenReactivoModal" value="<?php echo csrf_token(); ?>">

        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarReactivoModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>