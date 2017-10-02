<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo usuario']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('apellido',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo usuario']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
    <label>
      {!!Form :: radio ( "sexo",1,true,['class'=>'flat'])!!} Masculino
    </label>
    <label>
      {!!Form :: radio ( "sexo",0,false,['class'=>'flat'])!!} Femenino
    </label>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
      @php
        $ahora = Carbon\Carbon::now();
      @endphp
      {!! Form::date('fechaNacimiento',$fecha,['max'=>$ahora->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
      {!! Form::textarea('direccion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del nuevo usuario','rows'=>'1']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('name',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre de usuario']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
      {!! Form::email('email',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección de correo electronico']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
      {!! Form::password('password',['class'=>'form-control has-feedback-left','placeholder'=>'Contraseña']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Repetir Contraseña *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
      {!! Form::password('repetir_password',['class'=>'form-control has-feedback-left','placeholder'=>'Repetir Contraseña']) !!}
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de usuario *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="tipoUsuario" id="tipoUsuario" onchange="junta();">
        <option value="Administración">Administración</option>
        <option value="Gerencia">Gerencia</option>
        <option value="Médico">Médico</option>
        <option value="Recepción">Recepción</option>
        <option value="Laboaratorio">Laboratorio Clínico</option>
        <option value="Ultrasonografía">Ultrasonografía</option>
        <option value="Rayos X">Rayos X</option>
        <option value="Farmacia">Farmacia</option>
        <option value="Enfermería">Enfermería</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-6 col-xs-12" id="juntaVigilancia" style="display:none;">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Junta de Vigilancia</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('juntaVigilancia',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número de Junta de Vigilancia']) !!}
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group col-md-12 col-sm-12 col-xs-12">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/usuarios') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
<script type="text/javascript">
  function junta(){
    var valorUsuario = $("#tipoUsuario").val();
    if(valorUsuario == 2 || (valorUsuario > 3 && valorUsuario < 7)){
      document.getElementById('juntaVigilancia').style.display = 'block';
    }else{
      document.getElementById('juntaVigilancia').style.display = 'none';
    }
  }
</script>
