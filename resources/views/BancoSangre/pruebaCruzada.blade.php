<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalPruebaCruzada">
  <div class="modal-dialog ">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Prueba Cruzada</h4>
      </div>
      <div class="modal-body">
        <div class="x_panel">
          <img src={{asset(Storage::url($donacion->pruebaCruzada))}}>
        </div>
      </div>
      <div class="modal-footer">
        <center>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </center>
      </div>

    </div>
  </div>
</div>