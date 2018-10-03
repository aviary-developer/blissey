<div class="x_panel m_panel text-danger">
  <center>
    <h4 class="mb-1">
      <i class="fas fa-lock"></i>
      Cambiar Contraseña
    </h4>
  </center>
</div>
<div class="x_panel m_panel">
  <div class="form-group">
    <label class="" for="current_pass">Contraseña actual</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-lock"></i></div>
      </div>
      {!! Form::password(
        'current_pass',
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Contraseña actual',
          'id'=>'current_pass']
      ) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="new_pass">Contraseña nueva</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-lock"></i></div>
      </div>
      {!! Form::password(
        'new_pass',
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Contraseña nueva',
          'id'=>'new_pass']
      ) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="new_pass_r">Repita la contraseña nueva</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-lock"></i></div>
      </div>
      {!! Form::password(
        'new_pass_r',
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Contraseña actual',
          'id'=>'new_pass_r']
      ) !!}
    </div>
  </div>
</div>

<div class="m_panel x_panel bg-transparent" style="border:0px !important">
  <center>
    <button id="btn_change" type="button" class="btn btn-primary btn-sm col-2">Cambiar</button>
    <button type="button" class="btn btn-light btn-sm col-2" id="limpiar_paciente_filtro">Limpiar</button>
    <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
  </center>
</div>