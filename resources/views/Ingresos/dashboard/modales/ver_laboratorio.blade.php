<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ver_laboratorio" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-microscope"></i>
              Laboratorio Clínico
            </h4>
          </center>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-5">
        <div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h5>Fecha</h5>
            </center>
          </div>
          <div class="form-group col-sm-12">
            <label class="" for="fecha">Fecha</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
              </div>
              @php
                if($ingreso->estado != 2){
                  $fecha = $hoy;
                }else{
                  $fecha = $dias_a;
                }
              @endphp
              {!! Form::date(
                'fecha',
                $fecha->format('Y-m-d'),['id'=>'fecha_examen',
                'max'=>$dias_x->format('Y-m-d'),
                'min'=>$dias_i->format('Y-m-d'),
                'class'=>'form-control form-control-sm']) !!}
            </div>
          </div>
        </div>

        <div class="x_panel m_panel" style="height: 414px">
          <div class="flex-row">
            <center>
              <h5>Exámenes pendientes</h5>
            </center>
          </div>
          <div class="row">
            <div style="overflow-x: hidden; overflow-y: scroll; height: 344px; width:100%">
              <div id="mensaje_l"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="x_panel m_panel" style="height: 553px">
          <div class="flex-row">
            <center>
              <h5>Exámenes</h5>
            </center>
          </div>
          <div class="flex-row">
            <center>
              <h5 class="big-text" id="date_l">Fecha</h5>
            </center>
          </div>
          <div class="row " >
            <div style="overflow-x: hidden; overflow-y: scroll; height: 432px; width:100%">
              <div id="mensaje_v_l"></div>
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