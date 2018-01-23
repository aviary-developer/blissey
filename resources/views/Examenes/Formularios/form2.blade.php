<div>
  <div class="">
    Opciones:
    &nbsp; &nbsp;
    <div class="btn-group">
      <button class="btn btn-sm btn-dark">
        <i class="fa fa-plus"></i>
        Sección
      </button>
      <button class="btn btn-sm btn-dark">
        <i class="fa fa-plus"></i>
        Parametro
      </button>
      <button class="btn btn-sm btn-dark">
        <i class="fa fa-plus"></i>
        Reactivo
      </button>
      <button class="btn btn-sm btn-dark">
        <i class="fa fa-plus"></i>
        Tipo de muestra
      </button>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre *</label>
      <div class="col-md-10 col-sm-10 col-xs-12">
        <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('nombreExamen',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo examen','']) !!}
      </div>
    </div>
    <div class="form-group col-sm-6 col-xs-12">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">Area de examen *</label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
        <select class="form-control has-feedback-left" name="area" id="" required>
        <option value="HEMATOLOGIA">Hematología</option>
        <option value="EXAMENES DE ORINA">Exámenes de orina</option>
        <option value="EXAMENES DE HECES">Exámenes de heces</option>
        <option value="BACTERIOLOGIA">Bacteriología</option>
        <option value="QUIMICA SANGUINEA">Química sanguinea</option>
        <option value="INMUNOLOGIA">Inmunología</option>
        <option value="ENZIMAS">Enzimas</option>
        <option value="PRUEBAS ESPECIALES">Pruebas especialies</option>
        <option value="OTROS">Otros</option>
        </select>
      </div>
    </div>
    <div class="form-group col-sm-6 col-xs-12">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">Tipo de muestra *</label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
        <select class="form-control has-feedback-left" name="tipoMuestra" id="" >
          @foreach ($muestras as $muestra)
            <option value={{ $muestra->id }}>{{ $muestra->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="x_panel" id="panel_seccion">
    <div class="btn-success col-xs-3 btn" style="height: 130px; margin: 0px;" id="agregar_seccion_x" data-toggle="modal" data-target="#modal1" >
      <center>
        <i class="fa fa-plus-circle" style="font-size: 450%; margin: 15px;"></i>
        <div style="margin-bottom: 10px;">
          <span class="label label-lg label-white green col-xs-12" >
            Agregar sección
          </span>
        </div>
      </center>
    </div>
  </div>
</div>

{{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Agregar sección</h4>
        </div>

        <div class="modal-body">
          <div class="x_panel">

            <div class="col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Tipo de sección *</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
                  <select class="form-control has-feedback-left" name="tipoMuestra" id="" >
                    @foreach ($secciones as $seccion)
                      <option value={{$seccion->id}}>
                        {{ $seccion->nombre}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Parametro *</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
                  <select class="form-control has-feedback-left" name="tipoMuestra" id="" >
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
                    <input type="checkbox" name="checkReactivo" id="checkReactivo0" onClick="chekearReactivo(this,0);" class="js-switch" unchecked /> Añadir reactivo
                  </label>
                </center>
              </div>

              <div id="divReactivo0" class='form-group' style="display:none;">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Reactivo *</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>
                  <select class='form-control has-feedback-left'>
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
                <button type="button" class="btn btn-sm btn-primary">
                  Agregar
                  <i class="fa fa-arrow-right"></i>
                </button>
              </center>
            </div>

            <div class="col-sm-6 col-xs-12">
              <h5>Parametros agregados</h5>
              <table class="table">
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
          <button type="button" class="btn btn-primary">¡Listo!</button>
          <button type="button" class="btn btn-default" id="limpiar_seccion_x">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div>