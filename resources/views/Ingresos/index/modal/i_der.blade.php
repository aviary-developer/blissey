<div class="flex-row">
  <div class="x_panel m_panel">
    <div class="flex-row">
      <center>
        <h5>Búsqueda</h5>
      </center>
    </div>
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
<div class="flex-row">
  <div class="x_panel m_panel" style="height: 300px">
    <div class="flex-row">
      <center>
        <h5>
          Resultado de la búsqueda
        </h5>
      </center>
    </div>
    <div class="flex-row">
      <div style="overflow-x:hidden; overflow-y:scroll; height: 230px">
        <table class="table table-striped table-hover table-sm" id="tablaPaciente">
          <thead>
            <th>Nombre</th>
            <th style="width: 80px">Opcíon</th>
          </thead>
      </table>
      </div>
    </div>
  </div>
</div>