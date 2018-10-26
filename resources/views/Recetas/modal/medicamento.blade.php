<div class="modal fade" tabindex="-1" role="dialog" id="medicamento_m" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-search"></i>
              Buscar Receta
            </h4>
          </center>
          <div class="row">

            <div class="form-group col-sm-12">
              <label class="" for="codigo">Código</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                {!! Form::text('codi-receta',null,['id'=>'codi-receta','class'=>'form-control','placeholder'=>'Código de la receta','data-inputmask'=>"'mask' : '9999999999'"]) !!}
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

    <div class="row" id="res_solicitud_m" tyle="display:none;">
      <div class="col-sm-12">
        <div class="m_panel x_panel">
          <div class="row">
            <center>
              <h4>Resultado de la busqueda</h4>
            </center>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <div class="col-sm-3">Paciente:</div>
              <div class="col-sm-9">
                <b><span class="blue" id="n_pac">Nombre del paciente</span></b>
                <input type="hidden" id="id_p_">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="col-sm-4">Fecha:</div>
              <div class="col-sm-8">
                <b><span class="blue" id="f_rec">00/00/0000</span></b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="res_negativa_m" tyle="display:none;">
      <div class="col-sm-12">
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
      <div class="col-sm-12" id="lista_paneles" style="height:331px; overflow-x:hidden; overflow-y:auto; display:none;">
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
