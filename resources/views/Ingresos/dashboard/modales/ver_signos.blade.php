<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ver_signo" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-heartbeat"></i>
              Signos Vitales
              <button type="button" class="btn btn-sm btn-light float-right" id="s-earch" title="Búsqueda">
                <i class="fas fa-search"></i>
              </button>
            </h4>
          </center>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4" id="div-izq" style="display:none;">
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
                  $fecha->format('Y-m-d'),['id'=>'fecha_signo',
                  'max'=>$dias_x->format('Y-m-d'),
                  'min'=>$dias_i->format('Y-m-d'),
                  'class'=>'form-control form-control-sm']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="x_panel m_panel" style="height: 417px">
          <div class="flex-row">
            <center>
              <h5>Evaluaciones</h5>
            </center>
          </div>
          <div class="flex-row">
            <center>
              <h6 class="text-primary">
                <i class="far fa-calendar"></i>
                <span id="date_sv"></span>
              </h6>
            </center>
          </div>
          <div class="flex-row">
            <div style="overflow-x: hidden; overflow-y: scroll; height: 320px; width: 100%">
              <div id="mensaje_sv"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12" id="div-der">
        <div class="row">
          <div class="w-100" role="tabpanel" data-example-id="togglable-tabs">
            <div class="col-sm-9">
              <div class="x_panel m_panel" style="height: 300px">
                @include('Ingresos.dashboard.modales.partes.grafico_signo')
              </div>
            </div>
            <div class="col-sm-3">
              <div class="x_panel m_panel" style="height: 300px">   <div class="row">
                  @include('Ingresos.dashboard.modales.partes.opcion_signo')
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="x_panel m_panel" style="height: 242px">
          <div class="flex-row">
            <center>
              <h5>Resultados</h5>
            </center>
          </div>
          <div class="flex-row">
            <center>
              <h6 class="text-primary">
                <i class="far fa-calendar"></i>
                <span id="date_sv_2"></span>
              </h6>
            </center>
          </div>
          <div class="row" >
            <div class="w-100">
              <div id="mensaje_v_sv"></div>
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

<script>
  $("#s-earch").click(function(e){
    e.preventDefault();
    if($("#div-der").hasClass('col-sm-12')){
      $("#div-der").removeClass('col-sm-12').addClass('col-sm-8');
      $("#div-izq").toggle("slide", { direction: "left" }, 1000);
    }else{
      $("#div-der").removeClass('col-sm-8').addClass('col-sm-12');
      $("#div-izq").toggle("slide", { direction: "left" }, 1000);
    }
  });
</script>