<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal5">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tipo de Sección <span class="label label-lg label-primary">Nueva</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <div class="form-group">
            <label class="control-label col-sm-3 col-xs-12">Nombre *</label>
            <div class="col-sm-9 col-xs-12">
              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['id'=>'nombreSeccionModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo tipo de sección']) !!}
            </div>
          </div>

          <input type="hidden" id="tokenSeccionModal" name="tokenSeccionModal" value="<?php echo csrf_token(); ?>">

        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarSeccionModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>