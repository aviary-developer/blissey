<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Agregar sección</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel" style="min-height: 350px;">

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Tipo de sección *</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
              <select class="form-control has-feedback-left" id="seccion_select" >
                @foreach ($secciones as $seccion)
                  <option value={{$seccion->id}}>
                    {{ $seccion->nombre}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>

          <div class="col-sm-6 col-xs-12">

            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12">Parametro *</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <span class="fa fa-sliders form-control-feedback left" aria-hidden="true"></span>
                <select class="form-control has-feedback-left" id="parametro_select" >
                  @foreach ($parametros as $parametro)
                    <option value={{$parametro->id}}>
                      {{ $parametro->nombreParametro}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <center>
                <label>
                  <input type="checkbox" name="checkReactivo" id="checkReactivo" onClick="chekearReactivo(this,0);" class="js-switch" unchecked /> Añadir reactivo
                </label>
              </center>
            </div>

            <div id="divReactivo0" class='form-group' style="display:none;">
              <label class="control-label col-md-4 col-sm-4 col-xs-12">Reactivo *</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <span class='fa fa-tint form-control-feedback left' aria-hidden='true'></span>
                <select class='form-control has-feedback-left' id="reactivo_select">
                  @foreach ($reactivos as $reactivo)
                    <option value={{$reactivo->id}}>
                      {{ $reactivo->nombre}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="ln_solid"></div>
            <center>
              <button type="button" class="btn btn-sm btn-primary" id="agregar_parametro_x">
                Agregar
                <i class="fa fa-arrow-right"></i>
              </button>
            </center>
          </div>

          <div class="col-sm-6 col-xs-12">
            <h4>Parametros agregados</h4>
            <table class="table" id="tabla_parametros">
              <thead>
                <th>Parametro</th>
                <th>Reactivo</th>
                <th style="width: 80px">Acción</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary disabled" id="listo_x">¡Listo!</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>