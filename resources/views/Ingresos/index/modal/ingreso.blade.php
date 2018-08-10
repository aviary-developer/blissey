<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="n_ingreso" data-backdrop="static">
  <div class="modal-dialog" id="centro">
    <div class="row">
      <div class="col-xs-12" id="izquierda">
        @include('Ingresos.index.modal.i_izq')
      </div>
      <div class="col-xs-6" id="derecha" style="display: none">
        @include('Ingresos.index.modal.i_der')
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="location.reload();">Cerrar</button>
    </div>
  </div>
</div>