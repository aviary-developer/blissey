<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ver_finanzas" data-backdrop="static">
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
                      $fecha = $hoy;
                    }else{
                      $fecha = $dias_a;
                    }
                  @endphp
                  {!! Form::date('fechaNacimiento',$fecha->format('Y-m-d'),['id'=>'fecha_finanza','max'=>$dias_x->format('Y-m-d'),'min'=>$dias_i->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
         <div class="x_panel m_panel" style="height: 150px;">
            <div class="row">
              <h4>Resumen</h4>
            </div>
            <div class="row">
              <div>
                <div id="mini_resumen"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-7">
        <div class="x_panel m_panel" style="height: 553px">
          <div class="row">
            <h4>Detalle</h4>
          </div>
          <div class="row " >
            <div style="overflow-x: hidden; overflow-y: scroll; height: 432px">
              <div id="cuerpo"></div>
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