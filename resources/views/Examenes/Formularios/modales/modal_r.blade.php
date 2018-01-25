<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal3">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo reactivo</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre *</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <span class="fa fa-flask form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['id'=>'nombreReactivoModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo reactivo']) !!}
            </div>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">Descripción *</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('descripcion',null,['id'=>'descripcionReactivoModal','class'=>'form-control has-feedback-left','placeholder'=>'Descripción del nuevo reactivo']) !!}
            </div>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">Contenido por envase</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('contenidoPorEnvase',null,['id'=>'contenidoReactivoModal','class'=>'form-control has-feedback-left','placeholder'=>'Contenido en ml']) !!}
            </div>
          </div>

          <input type="hidden" id="tokenReactivoModal" name="tokenReactivoModal" value="<?php echo csrf_token(); ?>">

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarReactivoModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>