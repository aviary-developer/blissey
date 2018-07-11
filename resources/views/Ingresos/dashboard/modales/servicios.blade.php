<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="servicios_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="x_panel m_panel">
            <div class="row">
              <h4>Busqueda</h4>
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
                {!! Form::text('resultadoVenta',null,['id'=>'resultadoVentaS_','class'=>'form-control has-feedback-left','placeholder'=>'Buscar','tabindex'=>'-1']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="x_panel m_panel" style="height: 394px">
            <div class="row">
              <h4>Resultado de la busqueda</h4>
            </div>
            <div class="row">
              <div style="overflow-x:hidden; overflow-y:scroll; height: 324px">
                <table class="table" id="tablaBuscarS">
                  <thead>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="x_panel m_panel" style="height: 553px">
          <div class="row">
            <h4>Servicio agregado</h4>
          </div>
          <div class="row">
            <div style="overflow-x: hidden; overflow-y: scroll; height: 483px">
              <div id="mensaje_provisional_s"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="location.reload();">Cerrar</button>
    </div>
  </div>
</div>