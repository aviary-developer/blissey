<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ultras_m" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">
          <div class="row">
              <h4>Solicitud de Ultrasonografía</h4>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-xs-12">Examen *</label>
              <div class="col-xs-12">
                <select class="form-control" id="f_ultra">
                  @if (count($ultras)==0)
                      <option value="0" disabled>No hay examenes de Ultrasonografía registrados</option>
                  @else
                    @foreach ($ultras as $rayox)
                      <option value={{$rayox->id}}>{{$rayox->nombre}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-primary btn-sm" onclick="ultra_rayos(1)">Guardar</button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>