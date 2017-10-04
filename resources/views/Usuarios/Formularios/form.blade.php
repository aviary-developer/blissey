<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form_wizard wizard_horizontal" id="wizard">
    {{-- Encabezado del wizard --}}
    <ul class="wizard_steps">
      <li>
        <a href="#step-1">
          <span class="step_no">1</span>
          <span class="step_descr">
            Paso 1 <br>
            <small>Datos personales</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-2">
          <span class="step_no">2</span>
          <span class="step_descr">
            Paso 2 <br>
            <small>Datos de usuario</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-3">
          <span class="step_no">3</span>
          <span class="step_descr">
            Paso 3 <br>
            <small>Datos de especialidad</small>
          </span>
        </a>
      </li>
    </ul>
    {{-- Contenido del wizard --}}
    <div id="step-1">
      <h4 class="StepTitle">Datos Personales</h4>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo usuario']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('apellido',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo usuario']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
          <label>
            {!!Form :: radio ( "sexo",1,true,['class'=>'flat'])!!} Masculino
          </label>
          <label>
            {!!Form :: radio ( "sexo",0,false,['class'=>'flat'])!!} Femenino
          </label>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
            @php
              $ahora = Carbon\Carbon::now();
            @endphp
            {!! Form::date('fechaNacimiento',$fecha,['max'=>$ahora->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
            {!! Form::textarea('direccion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del nuevo usuario','rows'=>'3']) !!}
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
          <div class="col-md-9 col-sm-9 col-xs-12" id="telefono">
            <div class="input-group">
              {!! Form::text('telefono[]',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
              <span class="input-group-btn">
                <button type="button" name="button" class="btn btn-primary" id="agregar_telefono">+</button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="step-2">
      <h4 class="StepTitle">Datos del Usuario</h4>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('name',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre de usuario']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
            {!! Form::email('email',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección de correo electronico']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            {!! Form::password('password',['class'=>'form-control has-feedback-left','placeholder'=>'Contraseña']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Repetir Contraseña *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            {!! Form::password('repetir_password',['class'=>'form-control has-feedback-left','placeholder'=>'Repetir Contraseña']) !!}
          </div>
        </div>
        <div class="form-group">
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
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-camera form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('foto',['id'=>'foto','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="">
          <center>
            <output id="list"></output>
          </center>
        </div>
      </div>
    </div>
    <div id="step-3">
      <h4 class="StepTitle">Datos de Especialidad</h4>
      <p id="texto">El tipo de usuario que ha seleccionado, <b>NO</b> requiere detallar la especialidad</p>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="form-group" id="juntaVigilancia" style="display:none;">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Junta de Vigilancia</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('juntaVigilancia',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número de Junta de Vigilancia']) !!}
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Especialidad *</label>
          <div class="col-md-9 col-sm-9 col-xs-12" id="especialidad">
            <div class="input-group">
              {!! Form::text('especialidad[]',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
              <span class="input-group-btn">
                <button type="button" name="button" class="btn btn-primary" id="agregar_telefono">+</button>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="form-group" id="firma" style="display:none;">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Firma</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('firma',['id'=>'firma_file','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="">
          <center>
            <output id="list2" style="height:250px"></output>
          </center>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="form-group" id="sello" style="display:none;">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sello</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('sello',['id'=>'sello_file','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="">
          <center>
            <output id="list3" style="height:250px"></output>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function junta(){
    var valorUsuario = $("#tipoUsuario").val();

    if(valorUsuario == 'Médico' || valorUsuario == 'Laboaratorio' || valorUsuario == 'Rayos X' || valorUsuario == 'Ultrasonografía'){
      document.getElementById('juntaVigilancia').style.display = 'block';
      document.getElementById('firma').style.display = 'block';
      document.getElementById('sello').style.display = 'block';
      document.getElementById('texto').style.display = 'none';
    }else{
      document.getElementById('juntaVigilancia').style.display = 'none';
      document.getElementById('firma').style.display = 'none';
      document.getElementById('sello').style.display = 'none';
      document.getElementById('texto').style.display = 'block';
    }
  }

  function archivo(evt){
    var files = evt.target.files;

    for(var i = 0, f; f = files[i]; i++){
      if(!f.type.match('image.*')){
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile){
        return function(e){
          document.getElementById('list').innerHTML = ['<img style="height: 200px" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }

  function archivo2(evt){
    var files = evt.target.files;

    for(var i = 0, f; f = files[i]; i++){
      if(!f.type.match('image.*')){
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile){
        return function(e){
          document.getElementById('list2').innerHTML = ['<img style="height: 200px" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }

  function archivo3(evt){
    var files = evt.target.files;

    for(var i = 0, f; f = files[i]; i++){
      if(!f.type.match('image.*')){
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile){
        return function(e){
          document.getElementById('list3').innerHTML = ['<img style="height: 200px" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('foto').addEventListener('change', archivo, false);
  document.getElementById('firma_file').addEventListener('change', archivo2, false);
  document.getElementById('sello_file').addEventListener('change', archivo3, false);
</script>
