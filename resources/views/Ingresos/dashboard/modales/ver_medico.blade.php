<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ver_medico" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-user-md"></i>
              Medico
            </h4>
          </center>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="x_panel m_panel" style="height: 300px;">
          <div class="flex-row">
            <center>
              <h5>Datos</h5>
            </center>
          </div>
          <div class="flex-row">
            <center>
              <img src="" class="img-square-mini borde" style="width: 160px; height:160px;" id="img-foto">
            </center>
          </div>
          <div class="flex-row">
            <center>
              <b>
                <span class="" id="nombre">
                  Dr. Francisco Francisco Fernandez Fernandez
                </span>
              </b>
            </center>
          </div>
          <div class="flex-row">
            <span class="badge badge-primary col-12 font-sm" id="especial">Especialidad</span>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="x_panel m_panel" style="height: 300px">
          <div class="flex-row">
            <center>
              <h5>Consultas</h5>
            </center>
          </div>
          <div class="row " >
            <div style="overflow-x: hidden; overflow-y: scroll; height: 240px; width: 100%">
              <div id="mensaje_v_m"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-light col-4 btn-sm" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>