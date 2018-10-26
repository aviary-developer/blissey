<div class="modal fade" tabindex="-1" role="dialog" id="modal2" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-search"></i>
              Buscar cliente
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="ln_solid mb-1 mt-1"></div>
          <div class="row">

            <div class="form-group col-sm-12">
              <label class="" for="nombre">Buscar</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                {!! Form::text('resultado',null,['id'=>'resultadoCliente','class'=>'form-control form-control-sm','placeholder'=>'Buscar']) !!}
              </div>
            </div>

              <div class="x_panel">
              <div class="col-md-12 col-xs-12">
                <h6>Resultado de búsqueda</h6>
                <center>
                  <table class="table table-striped table-sm" id="tablaBuscarCliente">
                    <thead>
                    </thead>
                  </table>
                </center>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
