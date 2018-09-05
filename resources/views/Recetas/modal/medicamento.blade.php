<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="medicamento_m" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">
          <div class="row">
            <center>
              <h4>Buscar Receta</h4>
            </center>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <div class="input-group">
                {!! Form::text('codi-receta',null,['id'=>'codi-receta','class'=>'form-control ','placeholder'=>'Código de la receta','data-inputmask'=>"'mask' : '9999999999'"]) !!}
                <span class="input-group-btn">
                  <button type="button" name="button" class="btn btn-primary" id="buscar_receta_m" data-tooltip="tooltip" title="Buscar Código">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="res_solicitud_m" hidden>
      <div class="col-xs-12">
        <div class="m_panel x_panel">
          <div class="row">
            <center>
              <h4>Resultado de la busqueda</h4>
            </center>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="col-xs-3">Paciente:</div>
              <div class="col-xs-9">
                <b><span class="blue" id="n_pac">Nombre del paciente</span></b>
                <input type="hidden" id="id_p_">
              </div>
            </div>
            <div class="col-xs-4">
              <div class="col-xs-4">Fecha:</div>
              <div class="col-xs-8">
                <b><span class="blue" id="f_rec">00/00/0000</span></b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="res_negativa_m" hidden>
      <div class="col-xs-12">
        <div class="x_panel m_panel">
          <center>
            <h4 class="red">
              ¡Upps! Esta receta no tiene examenes asociados
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" id="lista_paneles" style="height:331px; overflow-x:hidden; overflow-y:auto" hidden>
  
      </div>
    </div>
    <div class="row alignright" style="margin-top:10px;">
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" id="close-search-receta-m">Cerrar</button>
    </div>
  </div>
</div>