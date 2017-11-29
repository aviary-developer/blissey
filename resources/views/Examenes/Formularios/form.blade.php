<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="row">
    <div class="col-md-10 col-sm-10 col-xs-10">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Area de examen</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
          <select class="form-control has-feedback-left" name="area" id="" required>
          <option value="HEMATOLOGIA">HEMATOLOGIA</option>
          <option value="EXAMENES DE ORINA">EXAMENES DE ORINA</option>
          <option value="EXAMENES DE HECES">EXAMENES DE HECES</option>
          <option value="BACTERIOLOGIA">BACTERIOLOGIA</option>
          <option value="QUIMICA SANGUINEA">QUIMICA SANGUINEA</option>
          <option value="INMUNOLOGIA">INMUNOLOGIA</option>
          <option value="ENZIMAS">ENZIMAS</option>
          <option value="PRUEBAS ESPECIALES">PRUEBAS ESPECIALES</option>
          <option value="OTROS">OTROS</option>
          </select>
        </div>
      </div>
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
            @foreach ($muestras as $muestra)
              <option value={{ $muestra->id }}>{{ $muestra->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <center>
        <h4>
          <small>
            Opciones
          </small>
        </h4>
      </center>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">
        <i class="fa fa-plus"></i> Nuevo Parametro
      </button>
    </div>
  </div>
  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <a class="btn btn-primary" id="agregarSeccionExamen"><i class="fa fa-plus"></i> Agregar sección</a>
      </label>
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
                              {!! Form::text('nombreParametro',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo parametro','required']) !!}
                            </div>
                          </div>
                          <div class="form-group" id="grupoUnidadParametro">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad de medición</label>
                            <div class="col-md-9 col-sm-9 col-xs-12" id="unidadParametro">
                              <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                                <select class="form-control has-feedback-left" name="unidad" required>
                                  @foreach ($unidades as $unidad)
                                    <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="">
                            <label>
                              <input type="checkbox"name="checkValores" id="checkValores" class="js-switch" unchecked /> Valores Normales
                            </label>
                          </div>
                          </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor normal mínimo *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::number('valorMinimo',null,['id'=>'valorMinimo','class'=>'form-control has-feedback-left','placeholder'=>'Valor mínimo','step'=>'any','readonly']) !!}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor normal máximo *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::number('valorMaximo',null,['id'=>'valorMaximo','class'=>'form-control has-feedback-left','placeholder'=>'Valor máximo','step'=>'any','readonly']) !!}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor predeterminado</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
                              {!! Form::text('valorPredeterminado',null,['class'=>'form-control has-feedback-left','placeholder'=>'Valor fijo','step'=>'any']) !!}
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
