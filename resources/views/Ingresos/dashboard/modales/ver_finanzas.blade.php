<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ver_finanzas" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="x_panel m_panel text-danger">
      <center>
        <h4 class="mb-1">
          <i class="far fa-money-bill-alt"></i>
          Estado Financiero
        </h4>
      </center>
    </div>

    <div class="row">
      <div class="col-sm-5">
        <div class="flex-row">
          <div class="x_panel m_panel">
            <div class="flex-row">
              <center>
                <h5>Búsqueda</h5>
              </center>
            </div>
            <div class="row">
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
                    $fecha->format('Y-m-d'),['id'=>'fecha_finanza',
                    'max'=>$dias_x->format('Y-m-d'),
                    'min'=>$dias_i->format('Y-m-d'),
                    'class'=>'form-control form-control-sm']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex-row">
         <div class="x_panel m_panel" style="height: 150px;">
            <div class="flex-row">
              <center>
                <h5>Resumen</h5>
              </center>
            </div>
            <div class="flex-row">
              <div>
                <div id="mini_resumen"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="x_panel m_panel" style="height: 470px">
          <div class="flex-row">
            <center>
              <h5>Detalle</h5>
            </center>
          </div>
          <div class="flex-row">
            <div style="overflow-x: hidden; overflow-y: scroll; height: 349px">
              <div id="cuerpo"></div>
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