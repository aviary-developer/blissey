<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ver_signo" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-4">
        <div class="row">
          <div class="x_panel m_panel">
            <div class="row">
              <h4>Fecha</h4>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-xs-12">
                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                  @php
                    if($ingreso->estado != 2){
                      $fecha = $hoy;
                    }else{
                      $fecha = $dias_a;
                    }
                  @endphp
                  {!! Form::date('fechaNacimiento',$fecha->format('Y-m-d'),['id'=>'fecha_signo','max'=>$dias_x->format('Y-m-d'),'min'=>$dias_i->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="x_panel m_panel" style="height: 447px">
            <div class="row">
              <h4>Evaluaciones</h4>
            </div>
            <div class="row">
              <center>
                <h5 class="big-text" id="date_sv">Fecha</h5>
              </center>
            </div>
            <div class="row">
              <div style="overflow-x: hidden; overflow-y: scroll; height: 350px">
                <div id="mensaje_sv"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-8">
        <div class="row">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <div class="col-xs-9">
              <div class="x_panel m_panel" style="height: 300px">
                <div class="row">
                  <h4>Graficas</h4>
                </div>
      
                  {{-- Codigo para colocar las graficas con un tab --}}
                  
                    
                    {{-- Contenido del tab --}}
                    <div class="row">
                      <div id="gsContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_g_s1" aria-labelledby="s_g_1">
                          <canvas id = "temperatura_chart_s" style="width: 100%;"></canvas>
                        </div>
                        {{-- Otra pestaña --}}
                        <div class="tab-pane fade" role="tabpanel" id="tab_g_s2" aria-labelledby="s_g_2">
                          <canvas id = "peso_chart_s" style="width: 100%; height: 100%"></canvas>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab_g_s3" aria-labelledby="s_g_3">
                          <canvas id = "presion_chart_s" style="width: 100%; height: 100%"></canvas>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab_g_s4" aria-labelledby="s_g_4">
                          <canvas id = "frecuencia_chart_s" style="width: 100%; height: 100%"></canvas>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab_g_s5" aria-labelledby="s_g_5">
                          <canvas id = "frecuencia2_chart_s" style="width: 100%; height: 100%"></canvas>
                        </div>
                      </div>
                    </div>
        
              </div>
            </div>
            <div class="col-xs-3">
              <div class="x_panel m_panel" style="height: 300px">
                <div class="row">
                  <ul id="gs" class="nav nav-tabs tabs-left" role="tablist">
                    <li role="presentation" class="active">
                      <a href="#tab_g_s1" id="s_g_1" role="tab" data-toggle="tab" aria-expanded="true">Temperatura</a>
                    </li>
                    <li role="presentation" class="">
                      <a href="#tab_g_s2" id="s_g_2" role="tab" data-toggle="tab" aria-expanded="false">Peso</a>
                    </li>
                    <li role="presentation" class="">
                      <a href="#tab_g_s3" id="s_g_3" role="tab" data-toggle="tab" aria-expanded="false">P. Arterial</a>
                    </li>
                    <li role="presentation" class="">
                      <a href="#tab_g_s4" id="s_g_4" role="tab" data-toggle="tab" aria-expanded="false">F. Cardiaca</a>
                    </li>
                    <li role="presentation" class="">
                      <a href="#tab_g_s5" id="s_g_5" role="tab" data-toggle="tab" aria-expanded="false">F. Respiratoria</a>
                    </li>
                  </ul>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <div class="x_panel m_panel" style="height: 242px">
          <div class="row">
            <h4>Resultados</h4>
          </div>
          <div class="row">
            <center>
              <h5 class="big-text" id="date_sv_2">Fecha</h5>
            </center>
          </div>
          <div class="row " >
            <div>
              <div id="mensaje_v_sv"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
    </div>
  </div>
</div>