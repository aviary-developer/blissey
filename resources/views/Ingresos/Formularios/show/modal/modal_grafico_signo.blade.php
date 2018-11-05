<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_signos_graficos" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Signos Vitales <span class="label-info label label-lg">Evolución</span></h4>
      </div>

      <div class="modal-body">
        <div class="col-xs-12">
          <div class="x_panel">
            {{-- Incio de tab --}}
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <div class="col-xs-2">
                <ul id="gs" class="nav nav-tabs tabs-left" role="tablist">
                  <li role="presentation" class="active">
                    <a href="#tab_g_s1" id="s_g_1" role="tab" data-toggle="tab" aria-expanded="true">Temperatura</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_g_s2" id="s_g_2" role="tab" data-toggle="tab" aria-expanded="false">Peso</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_g_s3" id="s_g_3" role="tab" data-toggle="tab" aria-expanded="false">Frecuencia Cardiaca</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_g_s4" id="s_g_4" role="tab" data-toggle="tab" aria-expanded="false">Pulso y Frecuencia Cardiaca</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_g_s5" id="s_g_5" role="tab" data-toggle="tab" aria-expanded="false">Frecuencia Respiratoria</a>
                  </li>
                </ul>
              </div>
              {{-- Contenido del tab --}}
              <div class="col-xs-10">
                <div id="gsContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_g_s1" aria-labelledby="s_g_1">
                    <canvas id = "temperatura_chart_s" style="width: 100%;"></canvas>
                  </div>
                  {{-- Otra pestaña --}}
                  <div class="tab-pane fade" role="tabpanel" id="tab_g_s2" aria-labelledby="s_g_2">
                    <canvas id = "peso_chart_s" style="width: 100%;"></canvas>
                  </div>
                  <div class="tab-pane fade" role="tabpanel" id="tab_g_s3" aria-labelledby="s_g_3">
                    <canvas id = "presion_chart_s" style="width: 100%;"></canvas>
                  </div>
                  <div class="tab-pane fade" role="tabpanel" id="tab_g_s4" aria-labelledby="s_g_4">
                    <canvas id = "frecuencia_chart_s" style="width: 100%;"></canvas>
                  </div>
                  <div class="tab-pane fade" role="tabpanel" id="tab_g_s5" aria-labelledby="s_g_5">
                    <canvas id = "frecuencia2_chart_s" style="width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarSignoModal" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>