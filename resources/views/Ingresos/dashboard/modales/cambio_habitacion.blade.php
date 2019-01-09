<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="cambio_habitacion" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-bed"></i>
              Cambio de Habitación
            </h4>
          </center>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel">
          <div class="row">
            @if ($ingreso->tipo == 2)    
              <div class="form-group col-sm-12">
                <label class="" for="evaluacion">Habitaciones</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-bed"></i></div>
                  </div>
                  <select class="form-control form-control-sm" id="f_habitacion">
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
                  <select class="form-control form-control-sm" id="f_cama">

                  </select>
                </div>
              </div>
            @elseif($ingreso->tipo == 1)
              <div class="form-group col-sm-12">
                <label class="" for="evaluacion">Habitaciones</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-bed"></i></div>
                  </div>
                  <select class="form-control form-control-sm" id="f_habitacion">
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
                  <select class="form-control form-control-sm" id="f_cama">

                  </select>
                </div>
              </div>
            @else
              <div class="form-group col-sm-12">
                <label class="" for="evaluacion">Habitaciones</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-bed"></i></div>
                  </div>
                  <select class="form-control form-control-sm" id="f_habitacion">
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
                  <select class="form-control form-control-sm" id="f_cama">

                  </select>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" id="guardar_cambio_habitacion" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light col-2 btn-sm" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $("#f_habitacion").on('change',camas);
    function camas(){
      $.ajax({
        type: 'get',
        url: $('#guardarruta').val() + '/cama/lista',
        data:{
          id: $("#f_habitacion").val()
        },
        success: function(r){
          var cama = $("#f_cama");
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
    camas();
  });
</script>