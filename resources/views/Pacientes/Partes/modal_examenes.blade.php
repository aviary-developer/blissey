<div class="modal fade" tabindex="-1" role="dialog" id="ver_examen_pac" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-info-circle"></i>
              Examen de Laboratorio Clínico
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h5 class="mb-1">Información</h5>
            </center>
          </div>

          <div class="ln_solid mb-1 mt-1"></div>
          <div class="row">

            <div class="col-sm-4">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Fecha
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="fecha_ev">
                  Valor
                </h6>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Evaluación
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="ev_">
                  Valor
                </h6>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Tipo de evaluación
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="tipo_ev">
                  Valor
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="cargando_ex_m" style="display: none">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h3><i class="fas fa-spin fa-spinner"></i> En espera...</h3> 
            </center>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="contenido_evaluacion" style="display: none">
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