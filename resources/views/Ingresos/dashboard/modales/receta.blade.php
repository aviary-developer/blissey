<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="receta" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-12">
        <div class="x_panel m_panel">
          <div class="btn-group col-xs-12">
            <button type="button" class="btn btn-primary btn-sm col-xs-3" id="med-btn">Medicamento</button>
            <button type="button" class="btn btn-default btn-sm col-xs-3" id="lab-btn">Laboratorio Clínico</button>
            <button type="button" class="btn btn-default btn-sm col-xs-3" id="ryu-btn">Rayos X y Ultrasonografías</button>
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
            <span id="alergias">{!!($paciente->alergia == null)?"<i>Ninguna</i>":$paciente->alergia!!}</span>
          </div>
        </div>
      </div>
      <div id="lab-div" hidden>
        <div class="col-xs-3">
          <div class="x_panel m_panel" style="height: 440px">
            Opciones
          </div>
        </div>
        <div class="col-xs-9">
          <div class="x_panel m_panel" style="height: 440px">Examenes</div>
        </div>
      </div>
      <div id="ryu-div" hidden="hidden">
        <div class="col-xs-6">
          <div class="x_panel m_panel" style="height: 440px">
            Seleccion
          </div>
        </div>
        <div class="col-xs-6">
          <div class="x_panel m_panel" style="height: 440px">
            Receta
          </div>
        </div>
      </div>
      <div id="otro-div" hidden="hidden">
        <div class="col-xs-12">
          <div class="x_panel m_panel" style="height: 440px">
            Editor de texto
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
    </div>
  </div>
</div>