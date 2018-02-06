<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Parametro <span class="label label-primary label-lg">Nuevo</span></h4>
      </div>
      <div class="modal-body">
        <div class="x_panel">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombreParametro',null,['id'=>'nombreParametroModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo parametro']) !!}
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-2"></div>
            <div class="col-xs-10">
              <div class="">
                <label>
                  <input type="checkbox"name="checkValores" id="checkValores" class="js-switch" unchecked /> Valores Normales
                </label>
              </div>
            </div>
          </div>
          <div class="form-group" id="grupoUnidadParametro">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad de medición</label>
            <div class="col-md-9 col-sm-9 col-xs-12" id="unidadParametro">
              <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                <select class="form-control has-feedback-left" name="unidad" id="unidadModal" disabled>
                  <option value=""></option>
                  @foreach ($unidades as $unidad)
                    <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor normal mínimo</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('valorMinimo',null,['id'=>'valorMinimo','class'=>'form-control has-feedback-left','placeholder'=>'Valor mínimo','step'=>'any','readonly']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor normal máximo</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('valorMaximo',null,['id'=>'valorMaximo','class'=>'form-control has-feedback-left','placeholder'=>'Valor máximo','step'=>'any','readonly']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor predeterminado *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('valorPredeterminado',null,['id'=>'valorPredeterminado','class'=>'form-control has-feedback-left','placeholder'=>'Valor por defecto','step'=>'any']) !!}
            </div>
          </div>
          <input type="hidden" id="tokenParametroModal" name="tokenParametroModal" value="<?php echo csrf_token(); ?>">
        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>
      <div class="modal-footer">
        <center>
          <button type="button" id="guardarParametroModal" class="btn btn-primary">Guardar</button>
          <button type="reset" name="button" class="btn btn-default">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </center>
      </div>

    </div>
  </div>
</div>