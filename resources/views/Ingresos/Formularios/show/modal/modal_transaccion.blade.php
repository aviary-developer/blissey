{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_transaccion" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Buscar</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <div class="form-group col-xs-12" id="radios">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar por: </label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <div id="radioBtn" class="btn-group">
                <a class="btn btn-primary btn-sm active" data-toggle="busq" data-title="1" onclick="cambioRadio(1)">Producto</a>
                <a class="btn btn-primary btn-sm notActive" data-toggle="busq" data-title="2" onclick="cambioRadio(2)">Componente</a>
              </div>
              <input type="hidden" name="busq" id="busq" value="1">
            </div>
          </div>
          <div class="form-group col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('resultadoVenta',null,['id'=>'resultadoVenta_','class'=>'form-control has-feedback-left','placeholder'=>'Buscar']) !!}
            </div>
          </div>
          <div class="form-group col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
            </div>
          </div>
          <div class="row">
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <center>
              <h4 class="StepTitle">Resultado de búsqueda</h4>
            </center>
            <table class="table" id="tablaBuscar">
              <thead>
              </thead>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal" onclick="recarga()">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
