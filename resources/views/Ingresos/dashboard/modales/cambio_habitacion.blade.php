<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="cambio_habitacion" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">
          <div class="row">
              <h4>Cambio de habitación</h4>
          </div>
          <div class="row">
            @if ($ingreso->tipo == 2)    
              <div class="form-group">
                <label class="control-label col-xs-12">Habitación *</label>
                <div class="col-xs-12">
                  <select class="form-control" id="f_habitacion">
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
            @else
              <div class="form-group">
                <label class="control-label col-xs-12">Habitación *</label>
                <div class="col-xs-12">
                  <select class="form-control" id="f_habitacion">
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
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" id="guardar_cambio_habitacion" class="btn btn-primary btn-sm">Guardar</button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>