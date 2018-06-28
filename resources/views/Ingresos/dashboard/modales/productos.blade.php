<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="productos_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="x_panel m_panel">
            <div class="row">
              <h4>Busqueda</h4>
            </div>
            <div class="form-group col-xs-12" id="radios">
              <label class="control-label col-md-3">Buscar por: </label>
                <div class="col-md-7">
                  <div id="radioBtn" class="btn-group">
                  <a class="btn btn-primary btn-sm active" data-toggle="busq" data-title="1" onclick="cambioRadio(1)">Producto</a>
                  <a class="btn btn-primary btn-sm notActive" data-toggle="busq" data-title="2" onclick="cambioRadio(2)">Componente</a>
                </div>
                <input type="hidden" name="busq" id="busq" value="1">
              </div>
            </div>
            <div class="form-group col-xs-12">
              <label class="control-label col-md-3">Cantidad </label>
              <div class="col-md-9">
                <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
                {!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
              </div>
            </div>
            <div class="form-group col-xs-12">
              <label class="control-label col-md-3">Buscar</label>
              <div class="col-md-9">
                <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('resultadoVenta',null,['id'=>'resultadoVenta_','class'=>'form-control has-feedback-left','placeholder'=>'Buscar','tabindex'=>'-1']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="x_panel m_panel">
            <div class="row">
              <h4>Resultado de la busqueda</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="x_panel m_panel">
          Que tal todos
        </div>
      </div>
    </div>
  </div>
</div>