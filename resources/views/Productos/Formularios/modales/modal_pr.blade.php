<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_proveedor">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Proveedor <span class="label label-lg label-primary">Nuevo</span></h4>
      </div>
      <div class="modal-body">
        <div class="x_panel">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proveedor *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-industry form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo proveedor','id'=>'nombreProveedorModal']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-at form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('correo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Correo electrónico del nuevo proveedor','id'=>'correoProveedorModal']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('telefono',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número telefónico del nuevo proveedor','id'=>'telefonoProveedorModal','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
            </div>
          </div>
          <input type="hidden" id="tokenProveedorModal" name="tokenProveedorModal" value="<?php echo csrf_token(); ?>">

        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarProveedorModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
