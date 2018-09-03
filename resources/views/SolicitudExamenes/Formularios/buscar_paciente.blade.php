<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">
          <div class="row">
            <center>
              <h4>Buscar Paciente</h4>
            </center>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('busqueda',null,['id'=>'busqueda','class'=>'form-control has-feedback-left','placeholder'=>'Nombre o apellido del usuario']) !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="x_panel m_panel" style="height:350px;">
          <table class="table" id="tablaPaciente">
            <thead>
              <th>Nombre</th>
              <th style="width: 80px">Opciones</th>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>