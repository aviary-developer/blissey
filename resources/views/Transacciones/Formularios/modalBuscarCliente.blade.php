{{-- MODAL 2--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Buscar clientes</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('resultado',null,['id'=>'resultadoCliente','class'=>'form-control has-feedback-left','placeholder'=>'Buscar']) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-12"></div>
            <div class="col-md-8 col-xs-12">
              <h4 class="StepTitle">Resultado de busqueda</h4>
              <table class="table" id="tablaBuscarCliente">

              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
{{-- FIN 2--}}
