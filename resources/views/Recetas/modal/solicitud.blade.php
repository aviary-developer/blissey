<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="solicitud_m" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-search"></i>
              Buscar Receta
            </h4>
          </center>
        </div>

        <div class="m_panel x_panel">
          <div class="row">
            <div class="form-group col-sm-12">
              <label class="" for="n_paciente">Código *</label>
              <div class="input-group mb-2 mr-sm-2 ">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                </div>
                {!! Form::text(
                  'codi-receta',
                  null,
                  ['id'=>'codi-receta',
                  'class'=>'form-control form-control-sm',
                  'placeholder'=>'Código de la receta',
                  'data-inputmask'=>"'mask' : '9999999999'"]) !!}
                <div class="input-group-append">
                  <div class="input-group-btn">
                    <button type="button" name="button" class="btn btn-primary btn-sm" id="buscar_receta_s" data-tooltip="tooltip" title="Buscar Código">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="res_solicitud_m" style="display:none">
      <div class="col-sm-12">
        <div class="m_panel x_panel">
          <div class="flex-row">
            <center>
              <h5>Resultado de la búsqueda</h5>
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
        <div class="flex-row">
          <div id="cont_solicitud_m" class="col-sm-12 m_panel x_panel bg-transparent p-1" style="overflow-x: hidden; overflow-y:scroll; height:270px; border: 0px !important; ">

          </div>
        </div>
      </div>
    </div>
    <div class="row" id="res_negativa_m" style="display:none">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <center>
            <h4 class="red">
              ¡Upps! Esta receta no tiene exámenes asociados
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="m_panel x_panel bg-transparent" style="border: 0px !important">
      <center>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>