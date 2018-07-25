<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="medico_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-3">
          <div class="x_panel m_panel" style="height: 447px; overflow-x:hidden; overflow-y:scroll">
            
            <ul id="tab_med" class="nav nav-tabs tabs-left" role="tablist">
              @for ($i = 0; $i <= $total_especialidad; $i++)
                @if ($i == 0)
                  <li role="presentation" class="active">
                    <a href={{"#medCont".$i}} id={{"tab_med".$i}} role="tab" data-toggle="tab" aria-expanded="true">{{"Médicina General"}}</a>
                  </li>
                @else
                  <li role="presentation">
                    <a href={{"#medCont".$i}} id={{"tab_med".$i}} role="tab" data-toggle="tab" aria-expanded="true">{{$especialidades[($i-1)]->nombre}}</a>
                  </li>
                @endif
              @endfor
            </ul>

          </div>
        </div>
        <div class="col-xs-9">
          <div class="x_panel m_panel" style="height: 447px;">
            
            <div id="tab_medContent" class="tab-content">
              @for ($i = 0; $i <= $total_especialidad; $i++)
                @if ($i == 0)
                  <div role="tabpanel" class="tab-pane fade active in" id={{"medCont".$i}} aria-labelledby={{"tab_med".$i}}>
                    <div>
                      <div class="row">
                        <h3>{{"Médicina General"}}</h3>
                      </div>
                      <div class="" style="height: 380px; overflow-x: hidden; overflow-y: scroll; width:100%; padding-left: 10px; ">
                        <div class="row">
                          @foreach ($medicos_general as $medico)
                            <div class="col-xs-3">
                              <center>
                                <div class="checkbox-img" id="check-img" onclick="contar_m(this)">
                                  <img src={{asset(Storage::url($medico->foto))}} class="img-circle perfil-2 borde">
                                  <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->id)}} class="hidden">
                                </div>
                                <span>{{(($medico->sexo)?"Dr. ":"Dra. ").$medico->nombre.' '.$medico->apellido}}</span>
                              </center>
                            </div>
                          @endforeach
                        </div>
                      </div>
                @else
                  <div role="tabpanel" class="tab-pane fade" id={{"medCont".$i}} aria-labelledby={{"tab_med".$i}}>
                    <div>
                      <div class="row">
                        <h3>{{$especialidades[($i-1)]->nombre}}</h3>
                      </div>
                      <div class="" style="height: 380px; overflow-x: hidden; overflow-y: scroll; width:100%; padding-left: 10px; ">
                        <div class="row">
                          <h4 class="blue">Especialidad Principal</h4>
                        </div>

                        <div class="row">
                          @foreach ($especialidades[($i-1)]->usuario_especialidad as $medico)
                            @if ($medico->principal)
                              <div class="col-xs-3">
                                <center>
                                  <div class="checkbox-img" id="check-img" onclick="contar_m(this)">
                                    <img src={{asset(Storage::url($medico->usuario->foto))}} class="img-circle perfil-2 borde">
                                    <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->usuario->id)}} class="hidden">
                                  </div>
                                  <span>{{(($medico->usuario->sexo)?"Dr. ":"Dra. ").$medico->usuario->nombre.' '.$medico->usuario->apellido}}</span>
                                </center>
                              </div>
                            @endif
                          @endforeach
                        </div>

                        <br>
                        <div class="row">
                          <h4 class="blue">Subespecialidad</h4>
                        </div>

                        <div class="row">
                          @foreach ($especialidades[($i-1)]->usuario_especialidad as $medico)
                            @if (!$medico->principal)
                              <div class="col-xs-3">
                                <center>
                                  <div class="checkbox-img" id="check-img" onclick="contar_m(this)">
                                    <img src={{asset(Storage::url($medico->usuario->foto))}} class="img-circle perfil-2 borde">
                                    <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->usuario->id)}} class="hidden">
                                  </div>
                                  <span>{{(($medico->usuario->sexo)?"Dr. ":"Dra. ").$medico->usuario->nombre.' '.$medico->usuario->apellido}}</span>
                                </center>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </div>
                @endif
                  </div>
                </div>
              @endfor
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" id="guardarMedicoModal" class="btn btn-primary btn-sm">Guardar</button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="location.reload();">Cerrar</button>
    </div>
  </div>
</div>
<script type="text/javascript">
var solicitudes=0;
  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
  async function contar_m(boton){
    var hijo = $(boton).find('i').hasClass('fa');
    var nombre = $(boton).parent('center').find('span');
        if (hijo) {
          solicitudes=solicitudes+1;
          
          new PNotify({
            title: 'Solicitud de:',
            type: 'success',
            text: '<strong>'+nombre.text()+'</strong> <i>¡Agregada!</i><br>Total solicitudes:'+solicitudes,
            nonblock: {
              nonblock: true
            },
            styling: 'bootstrap3',
            addclass: 'info'
          });
        } else{
          solicitudes=solicitudes-1;
          new PNotify({
            title: 'Solicitud de:',
            type: 'warning',
            text:  '<strong>'+nombre.text()+'</strong> <i>¡Eliminada!</i><br>Total solicitudes:'+solicitudes,
            nonblock: {
              nonblock: true
            },
            styling: 'bootstrap3',
            addclass: 'info'
          });
        }
            }
</script>