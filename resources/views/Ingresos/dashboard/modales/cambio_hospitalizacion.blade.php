<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="cambio_hospitalizacion" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-cubes"></i>
                Cambio de Tipo de Hospitalización
              </h4>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div role="tabpanel" data-example-id="togglable-tabs">
          {{-- Opciones del tab --}}
          <div class="col-sm-4">
            <div class="x_panel m_panel" style="height: 206px;">
              <div class="nav flex-column nav-pills" id="myTab" role="tablist" aria-orientation="vertical">
                @if ($ingreso->tipo != 2 && $obs)
                  @if ($activo == 2)
                    <a href="#tab_cb1" id="tab_cb_1" role="tab" data-toggle="tab" aria-selected="true" class="nav-link active" aria-controls="tab_cb1" onclick="cambio_tipo_activo(2)">
                  @else
                    <a href="#tab_cb1" id="tab_cb_1" role="tab" data-toggle="tab" aria-selected="false" class="nav-link" aria-controls="tab_cb1" onclick="cambio_tipo_activo(2)">
                  @endif
                      Observación
                    </a>
                @endif
  
                @if ($ingreso->tipo != 1 && $med)
                  @if ($activo == 1)
                    <a href="#tab_cb2" id="tab_cb_2" role="tab" data-toggle="tab" aria-selected="true" class="nav-link active" aria-controls="tab_cb2" onclick="cambio_tipo_activo(1)">
                  @else
                    <a href="#tab_cb2" id="tab_cb_2" role="tab" data-toggle="tab" aria-selected="false" class="nav-link" aria-controls="tab_cb2" onclick="cambio_tipo_activo(1)">
                  @endif
                      Medio ingreso
                    </a>
                @endif
  
                @if ($ingreso->tipo != 0 && $ing)
                  @if ($activo == 0)
                    <a href="#tab_cb3" id="tab_cb_3" role="tab" data-toggle="tab" aria-selected="true" class="nav-link active" aria-controls="tab_cb3" onclick="cambio_tipo_activo(0)">
                  @else
                    <a href="#tab_cb3" id="tab_cb_3" role="tab" data-toggle="tab" aria-selected="false" class="nav-link" aria-controls="tab_cb3" onclick="cambio_tipo_activo(0)">
                  @endif
                      Ingreso
                    </a>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="x_panel m_panel" style="height: 206px">
              <div id="myTabContent" class="tab-content">
  
                @if ($ingreso->tipo != 2 && $obs)
                  @if ($activo == 2)
                    <div class="tab-pane fade active show" id="tab_cb1" role="tabpanel" aria-labelledby="tab_cb_1">    
                  @else
                    <div class="tab-pane fade" id="tab_cb1" role="tabpanel" aria-labelledby="tab_cb_1">
                  @endif
                    <div class="flex-row">
                      <center>
                        <h5>Cambio a observación</h5>
                      </center>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label class="" for="evaluacion">Habitaciones</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-bed"></i></div>
                          </div>
                          <select class="form-control form-control-sm" id="f_habitacion_o">
                            @if ($observaciones==null)
                                <option value="0" disabled>No hay habitaciones disponibles</option>
                            @else
                              @foreach ($observaciones as $habitacion)
                                <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="" for="evaluacion">Camas</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-bed"></i></div>
                          </div>
                          <select class="form-control form-control-sm" id="f_cama_o">

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
  
                @if ($ingreso->tipo != 1 && $med)
                  @if ($activo == 1)
                    <div class="tab-pane fade active show" id="tab_cb2" role="tabpanel" aria-labelledby="tab_cb_2">    
                  @else
                    <div class="tab-pane fade" id="tab_cb2" role="tabpanel" aria-labelledby="tab_cb_2">
                  @endif
                    <div class="flex-row">
                      <center>
                        <h5>Cambio a medi ingreso</h5>
                      </center>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label class="" for="evaluacion">Habitaciones</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-bed"></i></div>
                          </div>
                          <select class="form-control form-control-sm" id="f_habitacion_m">
                            @if ($mediingresos==null)
                                <option value="0" disabled>No hay habitaciones disponibles</option>
                            @else
                              @foreach ($mediingresos as $habitacion)
                                <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="" for="evaluacion">Camas</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-bed"></i></div>
                          </div>
                          <select class="form-control form-control-sm" id="f_cama_m">

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
  
                @if ($ingreso->tipo != 0 && $ing)     
                  @if ($activo == 0)
                    <div class="tab-pane fade active show" id="tab_cb3" role="tabpanel" aria-labelledby="tab_cb_3">    
                  @else
                    <div class="tab-pane fade" id="tab_cb3" role="tabpanel" aria-labelledby="tab_cb_3">
                  @endif
                    <div class="flex-row">
                      <center>
                        <h5>Cambio a ingreso</h5>
                      </center>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label class="" for="evaluacion">Habitaciones</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-bed"></i></div>
                          </div>
                          <select class="form-control form-control-sm" id="f_habitacion_i">
                            @if ($habitaciones==null)
                                <option value="0" disabled>No hay habitaciones disponibles</option>
                            @else
                              @foreach ($habitaciones as $habitacion)
                                <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="" for="evaluacion">Camas</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-bed"></i></div>
                          </div>
                          <select class="form-control form-control-sm" id="f_cama_i">

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" id="cambio_hospitalizacion_" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light col-2 btn-sm" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>
<input type="hidden" value={{$activo}} id="activo">

<script>
  $(document).ready(function(){
    $("#f_habitacion_i").on('change',function(){
      camas(0);
    });
    $("#f_habitacion_m").on('change',function(){
      camas(1);
    });
    $("#f_habitacion_o").on('change',function(){
      camas(2);
    });

    camas($("#activo").val());
    
  });

  function cambio_tipo_activo(tipo) {
      $("#activo").val(tipo);
      camas(tipo);
    }

    function camas(tipo){
      if(tipo == 0){
        var habitacion = $("#f_habitacion_i").val();
      }else if(tipo == 1){
        var habitacion = $("#f_habitacion_m").val();
      }else{
        var habitacion = $("#f_habitacion_o").val();
      }
      $.ajax({
        type: 'get',
        url: $('#guardarruta').val() + '/cama/lista',
        data:{
          id: habitacion
        },
        success: function(r){
          if(tipo == 0){
            var cama = $("#f_cama_i");
          }else if(tipo == 1){
            var cama = $("#f_cama_m");
          }else{
            var cama = $("#f_cama_o");
          }
          cama.empty();
          if(r.length > 0){
            $(r).each(function(k,v){
              cama.append('<option value="'+v.id+'">Cama '+ v.numero +'</option>');
            });
          }else{
            cama.append('<option value="0" disabled> No hay camas disponibles</option>');
          }
        }
      });
    }
</script>