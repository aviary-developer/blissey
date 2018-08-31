<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="receta" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-12">
        <div class="x_panel m_panel">
          <div class="btn-group col-xs-12">
            <button type="button" class="btn btn-primary btn-sm col-xs-3" id="med-btn">Medicamento</button>
            <button type="button" class="btn btn-default btn-sm col-xs-3" id="lab-btn">Laboratorio Clínico</button>
            <button type="button" class="btn btn-default btn-sm col-xs-3" id="ryu-btn">Rayos X, Ultras y TAC</button>
            <button type="button" class="btn btn-default btn-sm col-xs-3" id="otro-btn">Otro</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div id="med-div">
        <div class="col-xs-6">
          <div class="x_panel m_panel" style="height: 440px">
            @include('Ingresos.dashboard.modales.partes.buscar_medicamento')
          </div>
        </div>
        <div class="col-xs-6">
          <div class="x_panel m_panel" style="height: 340px">
            @include('Ingresos.dashboard.modales.partes.texto_medicamento')
          </div>
          <div class="x_panel m_panel bg-warning" style="height: 90px">
            <div class="row">
              <div class="col-xs-8">
                <h5 class="big-text">Alergias del paciente</h5>
              </div>
              <div class="col-xs-4">
                <button type="button" class="btn btn-xs btn-dark alignright" id="alergia_btn"><i class="fa fa-edit"></i> Editar</button>
              </div>
            </div>
            <div class="row">
              <center>
                <span id="alergias">{!!($paciente->alergia == null)?"<i>Ninguna</i>":$paciente->alergia!!}</span>
              </center>
            </div>
          </div>
        </div>
      </div>
      <div id="lab-div" hidden>
        <div class="col-xs-3">
          <div class="x_panel m_panel" style="height: 440px">
            @include('SolicitudExamenes.Formularios.opciones')
          </div>
        </div>
        <div class="col-xs-5">
          <div class="x_panel m_panel" style="height: 440px">
            @include('SolicitudExamenes.Formularios.contenido2')
          </div>
        </div>
        <div class="col-xs-4">
          <div class="x_panel m_panel" style="height: 440px">
            <div class="row">
              <center>
                <h5 class="big-text">Receta de laboratorio</h5>
              </center>
            </div>
            <div class="row" id="texto_receta_laboratorio" style="overflow-x: hidden; overflow-y: scroll; height: 370px"></div>
          </div>
        </div>
      </div>
      <div id="ryu-div" hidden="hidden">
        <div class="col-xs-6">
          <form action="" class="form-horizontal input_mask">
            <div class="x_panel m_panel" style="height: 140px">
              @include('Ingresos.dashboard.modales.partes.rayos_x')
            </div>
            <div class="x_panel m_panel" style="height: 140px">
              @include('Ingresos.dashboard.modales.partes.ultras')
            </div>
            <div class="x_panel m_panel" style="height: 140px">
              @include('Ingresos.dashboard.modales.partes.tac')
            </div>
          </form>
        </div>
        <div class="col-xs-6">
          <div class="x_panel m_panel" style="height: 440px">
            @include('Ingresos.dashboard.modales.partes.texto_evaluacion')
          </div>
        </div>
      </div>
      <div id="otro-div" hidden="hidden">
        <div class="col-xs-12">
          <div class="x_panel m_panel" style="height: 440px">
            <div class="row">
              <center>
                <h5 class="big-text">Editor de texto</h5>
              </center>
            </div>
            <div class="row">
              @include('Ingresos.dashboard.modales.partes.editor_texto')
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn-sm btn-primary btn" id="guardar_consulta">Guardar</button>
      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
    </div>
  </div>
</div>