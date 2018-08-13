<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="verRadiografia">
  <div class="modal-dialog ">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Anexo de radiografía</h4>
      </div>
      <div class="modal-body">
        <div class="x_panel">
            <img style="height: 400px; width: 550px; object-fit: scale-down" src={{asset(Storage::url($detalleResultadoRayox->rayox))}}>
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
