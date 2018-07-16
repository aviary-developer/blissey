<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="cambio_hospitalizacion" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div role="tabpanel" data-example-id="togglable-tabs">
        {{-- Opciones del tab --}}
        <div class="col-xs-4">
          <div class="x_panel m_panel" style="height: 120px;">
            <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
              @if ($ingreso->tipo != 2 && $obs)
                @if ($activo == 2)
                  <li role="presentation" class="active" onclick="cambio_tipo_activo(2)">  
                @else
                  <li role="presentation" onclick="cambio_tipo_activo(2)">
                @endif
                  <a href="#tab_cb1" id="tab_cb_1" role="tab" data-toggle="tab" aria-expanded="true">
                    Observación
                  </a>
                </li>
              @endif

              @if ($ingreso->tipo != 1 && $med)
                @if ($activo == 1)
                  <li role="presentation" class="active" onclick="cambio_tipo_activo(1)">  
                @else
                  <li role="presentation" onclick="cambio_tipo_activo(1)">
                @endif
                  <a href="#tab_cb2" id="tab_cb_2" role="tab" data-toggle="tab" aria-expanded="true">
                    Medi ingreso
                  </a>
                </li>
              @endif

              @if ($ingreso->tipo != 0 && $ing)
                @if ($activo == 0)
                  <li role="presentation" class="active" onclick="cambio_tipo_activo(0)">  
                @else
                  <li role="presentation" onclick="cambio_tipo_activo(0)">
                @endif
                  <a href="#tab_cb3" id="tab_cb_3" role="tab" data-toggle="tab" aria-expanded="true">
                    Ingreso
                  </a>
                </li>
              @endif
            </ul>
          </div>
        </div>
        <div class="col-xs-8">
          <div class="x_panel m_panel" style="height: 120px">
            <div id="myTabContent" class="tab-content">

              @if ($ingreso->tipo != 2 && $obs)
                @if ($activo == 2)
                  <div class="tab-pane fade active in" id="tab_cb1" role="tabpanel" aria-labelledby="tab_cb_1">    
                @else
                  <div class="tab-pane fade" id="tab_cb1" role="tabpanel" aria-labelledby="tab_cb_1">
                @endif
                  <div class="row">
                    <h4>Cambio a observación</h4>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label col-xs-12">Habitación *</label>
                      <div class="col-xs-12">
                        <select class="form-control" id="f_habitacion_o">
                          @if (count($observaciones)==0)
                              <option value="0" disabled>No hay habitaciones disponibles</option>
                          @else
                            @foreach ($observaciones as $habitacion)
                              <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              @if ($ingreso->tipo != 1 && $med)
                @if ($activo == 1)
                  <div class="tab-pane fade active in" id="tab_cb2" role="tabpanel" aria-labelledby="tab_cb_2">    
                @else
                  <div class="tab-pane fade" id="tab_cb2" role="tabpanel" aria-labelledby="tab_cb_2">
                @endif
                  <div class="row">
                    <h4>Cambio a medi ingreso</h4>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label col-xs-12">Habitación *</label>
                      <div class="col-xs-12">
                        <select class="form-control" id="f_habitacion_m">
                          @if (count($habitaciones)==0)
                              <option value="0" disabled>No hay habitaciones disponibles</option>
                          @else
                            @foreach ($habitaciones as $habitacion)
                              <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              @if ($ingreso->tipo != 0 && $ing)     
                @if ($activo == 0)
                  <div class="tab-pane fade active in" id="tab_cb3" role="tabpanel" aria-labelledby="tab_cb_3">    
                @else
                  <div class="tab-pane fade" id="tab_cb3" role="tabpanel" aria-labelledby="tab_cb_3">
                @endif
                  <div class="row">
                    <h4>Cambio a ingreso</h4>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label col-xs-12">Habitación *</label>
                      <div class="col-xs-12">
                        <select class="form-control" id="f_habitacion_i">
                          @if (count($habitaciones)==0)
                              <option value="0" disabled>No hay habitaciones disponibles</option>
                          @else
                            @foreach ($habitaciones as $habitacion)
                              <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                            @endforeach
                          @endif
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
    <div class="row alignright">
      <button type="button" id="cambio_hospitalizacion_" class="btn btn-primary btn-sm">Guardar</button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="location.reload(true)">Cerrar</button>
    </div>
  </div>
</div>
<input type="hidden" value={{$activo}} id="activo">