<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ver_rayosx" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
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
                    $ahora = Carbon\Carbon::now();
                  @endphp
                  {!! Form::date('fechaNacimiento',$hoy->format('Y-m-d'),['id'=>'fecha_rayo','max'=>$ingreso->fecha_ingreso->addDays(($dias+1))->format('Y-m-d'),'min'=>$ingreso->fecha_ingreso->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="x_panel m_panel" style="height: 440px">
          <div class="row">
            <h4>Rayos X</h4>
          </div>
          <div class="row">
            <center>
              <h5 class="big-text" id="date_r">Fecha</h5>
            </center>
          </div>
          <div class="row " >
            <div style="overflow-x: hidden; overflow-y: scroll; height: 340px">
              <div id="mensaje_v_r"></div>
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