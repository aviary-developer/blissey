{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Buscar</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar por: </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              Producto {!!Form::radio('busq', '1',true,['onclick'=>'cambioRadio(1)'])!!}
              Componente {!!Form::radio('busq', '2',null,['onclick'=>'cambioRadio(2)'])!!}
              @if(Auth::user()->tipoUsuario=="Recepción")
                Componente {!!Form::radio('busq', '3',null,['onclick'=>'cambioRadio(3)'])!!}
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('resultadoVenta',null,['id'=>'resultadoVenta','class'=>'form-control has-feedback-left','placeholder'=>'Buscar']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad *</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-12"></div>
            <div class="col-md-8 col-xs-12">
              <h4 class="StepTitle">Resultado de busqueda</h4>
              <table class="table" id="tablaBuscar">
                <thead>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiarTablaVenta()">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
