<div class="modal fade" tabindex="-1" role="dialog" id="modal_unidad" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-plus"></i>
              Unidad nueva
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
              <label class="" for="nombreu">Nombre *</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
                </div>
                {!! Form::text('nombreu',null,['id'=>'nombreUnidadModal','class'=>'form-control form-control-sm','placeholder'=>'Nombre de la categoría']) !!}
              </div>
            </div>
            <input type="hidden" id="tokenUnidadModal" name="tokenUnidadModal" value="<?php echo csrf_token(); ?>">

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
            <button type="button" class="btn btn-sm  col-2 btn-primary" id="guardarUnidadModal">Agregar</button>
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
