<div class="row">
  <div class="x_panel m_panel">
    <div class="row">
      <h4>Busqueda</h4>
    </div>
    <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('busqueda',null,['id'=>'busqueda','class'=>'form-control has-feedback-left','placeholder'=>'Nombre o apellido del usuario']) !!}
    </div>
  </div>
  </div>
</div>
<div class="row">
  <div class="x_panel m_panel" style="height: 448px">
    <div class="row">
      <h4>Resultado de la busqueda</h4>
    </div>
    <div class="row">
      <div style="overflow-x:hidden; overflow-y:scroll; height: 378px">
        <table class="table" id="tablaPaciente">
          <thead>
            <th>Nombre</th>
            <th style="width: 80px">Acción</th>
          </thead>
      </table>
      </div>
    </div>
  </div>
</div>