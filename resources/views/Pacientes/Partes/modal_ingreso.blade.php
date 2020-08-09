<div class="modal fade" tabindex="-1" role="dialog" id="ver_ingreso_pac" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-info-circle"></i>
              Servicio Médico
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

            <div class="col-sm-3">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Fecha de Ingreso
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="fecha_ingreso_t">
                  Valor
                </h6>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Fecha de Alta
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="fecha_alta_t">
                  Valor
                </h6>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Días
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="dias_t">
                  Valor
                </h6>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Tipo
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="tipo_t">
                  Valor
                </h6>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Costo
                </span>
              </div>
              <div class="flex-row">
                <h6 class="font-weight-bold" id="costo_t">
                  Valor
                </h6>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h5 class="mb-1">Consultas</h5>
            </center>
          </div>
          <div class="ln_solid mt-2 mb-3"></div>
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-hover table-striped table-sm" id="consulta-table">
                <thead>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Médico</th>
                  <th>Consulta por</th>
                  <th>Historia clínica</th>
                  <th>Exámen físico</th>
                  <th>Diagnostico</th>
                </thead>
                <tbody id="c-body-table">

                </tbody>
              </table>
            </div>
          </div>
        </div>
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