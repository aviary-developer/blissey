<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="medico_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-user-md"></i>
                Medicos
              </h4>
            </center>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div role="tabpanel" data-example-id="togglable-tabs">
          <div class="col-sm-3">
            <div class="x_panel m_panel" style="height: 447px; overflow-x:hidden; overflow-y:scroll">

              <div class="nav flex-column nav-pills" id="tab_med" role="tablist" aria-orientation="vertical">
                @for ($i = 0; $i <= $total_especialidad; $i++)
                  @if ($i == 0)
                    <a href={{"#medCont".$i}} id={{"tab_med".$i}} role="tab" data-toggle="pill" aria-selected="true" class="nav-link active" aria-controls={{"medCont".$i}}>{{"Médicina General"}}</a>
                  @else
                    <a href={{"#medCont".$i}} id={{"tab_med".$i}} role="tab" data-toggle="pill" aria-selected="false" class="nav-link" aria-controls={{"medCont".$i}}>{{$especialidades[($i-1)]->nombre}}</a>
                  @endif
                @endfor
              </div>

            </div>
          </div>
          <div class="col-sm-9">
            <div class="x_panel m_panel" style="height: 447px;">

              <div id="tab_medContent" class="tab-content">
                @for ($i = 0; $i <= $total_especialidad; $i++)
                  @if ($i == 0)
                    <div role="tabpanel" class="tab-pane fade active show" id={{"medCont".$i}} aria-labelledby={{"tab_med".$i}}>
                      <div>
                        <div class="flex-row">
                          <center>
                            <h4>{{"Médicina General"}}</h4>
                          </center>
                        </div>
                        <div class="" style="height: 380px; overflow-x: hidden; overflow-y: scroll; width:100%; padding-left: 10px; ">
                          <div class="row">
                            @foreach ($medicos_general as $medico)
                              <div class="col-sm-3">
                                <center>
                                  <div class="checkbox-img" id="check-img" onclick="contar_m(this)">
                                    <img src={{asset(Storage::url($medico->foto))}} class="rounded-circle perfil-2">
                                    <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->id)}} hidden>
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
                        <div class="flex-row">
                          <center>
                            <h4>{{$especialidades[($i-1)]->nombre}}</h4>
                          </center>
                        </div>
                        <div class="" style="height: 380px; overflow-x: hidden; overflow-y: scroll; width:100%; padding-left: 10px; ">
                          <div class="flex-row">
                            <center>
                              <h5 class="text-primary">Especialidad principal</h5>
                            </center>
                          </div>

                          <div class="flex-row">
                            <div class="col-sm-12">
                              @if ($especialidades[($i-1)]->usuario_especialidad->where('principal',true)->count() > 0 )
                                @foreach ($especialidades[($i-1)]->usuario_especialidad as $medico)
                                  @if ($medico->principal && $medico->usuario->tipoUsuario == "Médico")
                                    <div class="col-sm-3">
                                      <center>
                                        <div class="checkbox-img" id="check-img" onclick="contar_m(this)">
                                          <img src={{asset(Storage::url($medico->usuario->foto))}} class="rounded-circle perfil-2">
                                          <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->usuario->id)}} hidden>
                                        </div>
                                        <span>{{(($medico->usuario->sexo)?"Dr. ":"Dra. ").$medico->usuario->nombre.' '.$medico->usuario->apellido}}</span>
                                      </center>
                                    </div>
                                  @endif
                                @endforeach
                              @else
                                <center>
                                  <span><b>No hay médicos</b> con {{$especialidades[($i-1)]->nombre}} como especialidad principal</span>
                                </center>
                              @endif
                            </div>
                          </div>

                          <div class="clearfix"></div>

                          <div class="flex-row mt-2">
                            <div class="col-sm-12">
                              <center>
                                <h5 class="text-primary">Subespecialidad</h5>
                              </center>
                            </div>
                          </div>

                          <div class="flex-row">
                            <div class="col-sm-12">
                              @if ($especialidades[($i-1)]->usuario_especialidad->where('principal',false)->count() > 0 )
                                @foreach ($especialidades[($i-1)]->usuario_especialidad as $medico)
                                  @if (!$medico->principal)
                                    <div class="col-sm-3">
                                      <center>
                                        <div class="checkbox-img" id="check-img" onclick="contar_m(this)">
                                          <img src={{asset(Storage::url($medico->usuario->foto))}} class="rounded-circle perfil-2">
                                          <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->usuario->id)}} hidden>
                                        </div>
                                        <span>{{(($medico->usuario->sexo)?"Dr. ":"Dra. ").$medico->usuario->nombre.' '.$medico->usuario->apellido}}</span>
                                      </center>
                                    </div>
                                  @endif
                                @endforeach
                              @else
                                <center>
                                  <span><b>No hay médicos</b> con subespecialidad de {{$especialidades[($i-1)]->nombre}}</span>
                                </center>
                              @endif
                            </div>
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
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" id="guardarMedicoModal" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light col-2 btn-sm" onclick="location.reload()">Cerrar</button>
      </center>
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

          swal({
            type: 'success',
            html: '<strong>'+nombre.text()+'</strong> <i>¡Agregada!</i><br>Total solicitudes:'+solicitudes,
            toast: true,
            position: 'top-end',
            timer: '4000',
            showConfirmButton: false
          });
        } else{
          solicitudes=solicitudes-1;
          swal({
            type: 'warning',
            html: '<strong>'+nombre.text()+'</strong> <i>¡Eliminada!</i><br>Total solicitudes:'+solicitudes,
            toast: true,
            position: 'top-end',
            timer: '4000',
            showConfirmButton: false
          });
        }
            }
</script>
