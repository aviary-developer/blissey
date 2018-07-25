<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ver_laboratorio" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-5">
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
                      $fecha = Carbon\Carbon::now();
                    }else{
                      $fecha = $ingreso->fecha_alta;
                    }
                  @endphp
                  {!! Form::date('fechaNacimiento',$fecha->format('Y-m-d'),['id'=>'fecha_examen','max'=>$ingreso->fecha_ingreso->addDays(($dias))->format('Y-m-d'),'min'=>$ingreso->fecha_ingreso->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="x_panel m_panel" style="height: 447px">
            <div class="row">
              <h4>Examenes pendientes</h4>
            </div>
            <div class="row">
              <div style="overflow-x: hidden; overflow-y: scroll; height: 377px">
                <div id="mensaje_l"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-7">
        <div class="x_panel m_panel" style="height: 553px">
          <div class="row">
            <h4>Examenes</h4>
          </div>
          <div class="row">
            <center>
              <h5 class="big-text" id="date_l">Fecha</h5>
            </center>
          </div>
          <div class="row " >
            <div style="overflow-x: hidden; overflow-y: scroll; height: 432px">
              <div id="mensaje_v_l"></div>
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