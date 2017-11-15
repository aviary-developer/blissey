<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombreExamen',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo examen','required']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de muestra *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="tipoMuestra" id="" required>
        <option value="Sangre">Sangre</option>
        <option value="Heces">Heces</option>
        <option value="Orina">Orina</option>
        <option value="Secreción">Secreción</option>
      </select>
    </div>
  </div>
  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <a class="btn btn-primary" id="agregarSeccionExamen"><i class="fa fa-plus"></i> Agregar sección</a>
      </label>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Nuevo Parametro</button>
  </div>
  <div class="ln_solid"></div>
        <div class="clearfix"></div>
            <div class="seccionesExamenes x_panel" id="seccionesExamenes">
              <!--AQUI SE AGREGAN LAS SECCIONES -->
              <input type='hidden' id='totalSecciones' name='totalSecciones' value="0"/>
      </div>
    <div class="form-group">
      <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/examenes') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
<!--INICIO DE MODAL DE PARAMETRO-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Nuevo parametro</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::text('nombreParametroModal',null,['id'=>'nombreParametroModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo parametro']) !!}
                            </div>
                          </div>
                          <div class="form-group" id="grupoUnidadParametro">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad de medición</label>
                            <div class="col-md-9 col-sm-9 col-xs-12" id="unidadParametro">
                              <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                                <select class="form-control has-feedback-left" name="unidadModal" id="unidadModal">
                                  @foreach ($unidades as $unidad)
                                    <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor mínimo *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::number('valorMinimoModal',null,['id'=>'valorMinimoModal','class'=>'form-control has-feedback-left','placeholder'=>'Valor mínimo','step'=>'any']) !!}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor máximo *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::number('valorMaximoModal',null,['id'=>'valorMaximoModal','class'=>'form-control has-feedback-left','placeholder'=>'Valor máximo','step'=>'any']) !!}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor predeterminado</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::number('valorPredeterminadoModal',null,['id'=>'valorPredeterminadoModal','class'=>'form-control has-feedback-left','placeholder'=>'Valor fijo','step'=>'any']) !!}
                            </div>
                          </div>
                          <input type="hidden" id="tokenParametroModal" name="tokenParametroModal" value="<?php echo csrf_token(); ?>">
                        </div>
                        <div class="modal-footer">
                          <center>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button type="reset" name="button" class="btn btn-default">Limpiar</button>
                          <button type="button" id="guardarParametroModal" class="btn btn-primary">Guardar</button>
                        </center>
                        </div>

                      </div>
                    </div>
                  </div>
