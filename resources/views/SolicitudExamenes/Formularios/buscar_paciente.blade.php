<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-sm-12">

        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-search"></i>
              Buscar Paciente
            </h4>
          </center>
        </div>

        <div class="m_panel x_panel">          
          <div class="row">
            <div class="form-group col-sm-12">
              <label class="" for="busqueda">Nombre o Apellido</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                {!! Form::text(
                  'busqueda',
                  null,
                  ['id'=>'busqueda',
                  'class'=>'form-control form-control-sm',
                  'placeholder'=>'Nombre o apellido del usuario']) !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel" 
        >
          <table class="table table-hover table-striped table-sm" id="tablaPaciente">
            <thead>
              <th>Nombre</th>
              <th style="width: 80px">Opción</th>
            </thead>
          </table>
        </div>
      </div>
    </div>

    <div class="m_panel x_panel bg-transparent" style="border: 0px !important">
      <center>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>