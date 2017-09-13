<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">
      <br />
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          {!! Form::text('nombre',null,['id'=>'nombrePaciente','class'=>'form-control','placeholder'=>'Nombre del paciente']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          {!! Form::text('apellido',null,['id'=>'apellidoPaciente','class'=>'form-control','placeholder'=>'Apellido del paciente']) !!}
        </div>
      </div>
      <div class="form-group">
        <p>
          M:
          {!!Form :: radio ( "sexo",1,true,['id'=>'sexoMasculino'])!!}
          F:
          {!!Form :: radio ( "sexo",0,false,['id'=>'sexoFemenino'])!!}
        </p>
      </div>
    </div>
  </div>
</div>
