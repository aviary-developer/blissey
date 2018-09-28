<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-esp">
  <div class="modal-dialog">
    <div class="x_panel m_panel text-danger">
      <center>
        <h4 class="mb-1">
          Especialidad médica
          <span class="badge border border-danger text-danger">Nueva</span>
        </h4>
      </center>
    </div>
    <div class="x_panel m_panel">
      <div class="form-group">
        <label class="" for="nombre">Nombre *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          {!! Form::text(
            'nombre_especialidad',
            null,
            ['class'=>'form-control form-control-sm',
              'placeholder'=>'Nombre de la especialidad médica',
              'id'=>'nombre_especialidad']
          ) !!}
        </div>
      </div>
    </div>
    
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button id="guardar_especialidad" class="btn btn-primary btn-sm col-2" type="button">Guardar</button>
        <button class="btn btn-light btn-sm col-2" type="button" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>