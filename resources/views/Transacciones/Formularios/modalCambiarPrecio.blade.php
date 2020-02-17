<div class="modal fade" tabindex="-1" role="dialog" id="modalcp" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-dollar-sign"></i>
                Cambiar precio
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
                <label class="" for="nombrep">Precio *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
                  </div>
                  <input type="hidden" id="cpoculto" value="">
                  {!! Form::number('cambioPrecio',0,['id'=>'cambioPrecioModal','class'=>'form-control form-control-sm','placeholder'=>'Precio']) !!}
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
              <button type="button" class="btn btn-sm  col-2 btn-primary" onclick='guardarcp()'>Cambiar</button>
              <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" id="cerrarCP">Cerrar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  