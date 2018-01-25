<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal5">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo tipo de seccion</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <div class="form-group">
            <label class="control-label">Nombre *</label>
            <div class="col-xs-12">
              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['id'=>'nombreSeccionModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo tipo de muestra']) !!}
            </div>
          </div>

          <input type="hidden" id="tokenSeccionModal" name="tokenSeccionModal" value="<?php echo csrf_token(); ?>">

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarSeccionModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>