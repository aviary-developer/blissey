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
    <div id="step-1" onmouseover="verAlerta1()">
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
          <label>
            {!!Form :: radio ( "sexo",1,true,['class'=>'flat'])!!} Masculino &nbsp;
          </label>
          <label>
            {!!Form :: radio ( "sexo",0,false,['class'=>'flat'])!!} Femenino
          </label>
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
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="input-group">
              {!! Form::text('telefonoInput',null,['id'=>'telefono','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
              <span class="input-group-btn">
                <button type="button" name="button" class="btn btn-primary" id="agregar_telefono">
                  <i class="fa fa-save"></i>
                </button>
              </span>
            </div>
          </div>
        </div>
        <table class="table" id='tablaTelefono'>
          <thead>
            <th>Teléfono</th>
            <th style="width : 80px">Acción</th>
          </thead>
          <tbody>
            @if (!$create)
              <input type="hidden" name="deletes[]" value="ninguno" id="deletes">
              @foreach ($telefono_usuarios as $key => $telefono)
                <tr>
                  <td>{{$telefono->telefono}}</td>
                  <td>
                    <input type="hidden" id={{"telefono".$key}} value={{ $telefono->id }}>
                    <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_telefono_antiguo">
                      <i class="fa fa-remove"></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
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
            <select class="form-control has-feedback-left" name="tipoUsuario" id="tipoUsuario" onchange="tipo_usuario();">
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
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Rol *</label>
          <label>
            {!!Form :: radio ( "administrador",1,false,['class'=>'flat'])!!} Administrador &nbsp;
          </label>
          <label>
            {!!Form :: radio ( "administrador",0,true,['class'=>'flat'])!!} Ninguno
          </label>
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
            <output id="list">
              @if ($create)
                <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 200px">
              @else
                <img src={{asset(Storage::url($usuarios->foto))}} style="height : 200px">
              @endif
            </output>
          </center>
        </div>
      </div>
    </div>
    <div id="step-3" onmouseover="verAlerta2();">
      <h4 class="StepTitle">Datos de Especialidad</h4>
      <p id="texto" style="display:none">El tipo de usuario que ha seleccionado, <b>NO</b> requiere detallar la especialidad</p>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group" id="juntaVigilancia">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Junta de Vigilancia</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('juntaVigilancia',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número de Junta de Vigilancia']) !!}
          </div>
        </div>

        <div class="form-group" id="firma">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Firma</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('firma',['id'=>'firma_file','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="">
          <center>
            <output id="list2" style="height:100px">
              @if ($create)
                <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 75px">
              @else
                <img src={{asset(Storage::url($usuarios->firma))}} style="height : 75px">
              @endif
            </output>
          </center>
        </div>
        <div class="form-group" id="sello">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sello</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('sello',['id'=>'sello_file','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="">
          <center>
            <output id="list3" style="height:100px">
              @if ($create)
                <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 75px">
              @else
                <img src={{asset(Storage::url($usuarios->sello))}} style="height : 75px">
              @endif
            </output>
          </center>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group" id="grupoEspecialidad">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Especialidad</label>
          <div class="col-md-9 col-sm-9 col-xs-12" id="especialidad">
            <div class="input-group">
              <select class="form-control has-feedback-left" name="especialidadSelect">
                @foreach ($especialidades as $especialidad)
                  <option value={{ $especialidad->id }}>{{ $especialidad->nombre }}</option>
                @endforeach
              </select>
              <span class="input-group-btn">
                <button type="button" name="button" class="btn btn-primary" id="agregar_especialidad">
                  <i class="fa fa-save"></i>
                </button>
              </span>
            </div>
          </div>
        </div>
        <table class="table" id="tablaEspecialidad">
          <thead>
            <th>Especialidad</th>
            <th style="width : 80px">Acción</th>
          </thead>
          <tbody>
            @if (!$create)
              @php
                $auxiliar = 0;
              @endphp
              <input type="hidden" name="delesp[]" value="ninguno" id="delesp">
              @foreach ($especialidad_usuarios as $key => $especialidad)
                <tr>
                  <td>
                    {{$especialidad->nombreEspecialidad($especialidad->f_especialidad)}}
                  </td>
                  <td>
                    <input type="hidden" id={{"especialidad".$key}} value={{ $especialidad->f_especialidad }}>
                    <input type="hidden" value={{ $especialidad->id }}>
                    <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_especialidad_antiguo">
                      <i class="fa fa-remove"></i>
                    </button>
                  </td>
                </tr>
                @php
                  $auxiliar = $key;
                @endphp
              @endforeach
              <input type="hidden" id="contador" value={{$auxiliar}}>
            @endif
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
  var cuenta1 = 0;
  var cuenta2 = 0;
  function tipo_usuario(){
    var valorUsuario = $("#tipoUsuario").val();

    if(!(valorUsuario == 'Recepción' || valorUsuario == 'Enfermería')){
      document.getElementById('juntaVigilancia').style.display = 'block';
      document.getElementById('firma').style.display = 'block';
      document.getElementById('sello').style.display = 'block';
      document.getElementById('list2').style.display = 'block';
      document.getElementById('list3').style.display = 'block';
      document.getElementById('grupoEspecialidad').style.display = 'block';
      document.getElementById('tablaEspecialidad').style.display = 'table';
      document.getElementById('texto').style.display = 'none';
    }else{
      document.getElementById('juntaVigilancia').style.display = 'none';
      document.getElementById('firma').style.display = 'none';
      document.getElementById('sello').style.display = 'none';
      document.getElementById('list2').style.display = 'none';
      document.getElementById('list3').style.display = 'none';
      document.getElementById('grupoEspecialidad').style.display = 'none';
      document.getElementById('tablaEspecialidad').style.display = 'none';
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
          document.getElementById('list2').innerHTML = ['<img style="height: 75px" src = "', e.target.result,'"/>'].join('');
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
          document.getElementById('list3').innerHTML = ['<img style="height: 75px" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }

  function verAlerta2() {
    if(cuenta2 == 0){
      new PNotify({
        title: 'Nota',
        text: 'Solamente las especialidades agregadas a la tabla serán almacenadas,'+
        ' y la primera será tomada como especialidad y las demás como subespecialidades.',
        type: 'info',
        nonblock:{
          nonblock : true
        },
        styling: 'bootstrap3'
      });
      cuenta2++;
    }
  }

  function verAlerta1() {
    if(cuenta1 == 0){
      new PNotify({
        title: 'Nota',
        text: 'Solamente los números de telefono agregados a la tabla serán almacenados,',
        type: 'info',
        nonblock:{
          nonblock : true
        },
        styling: 'bootstrap3'
      });
      cuenta1++;
    }
  }

  document.getElementById('foto').addEventListener('change', archivo, false);
  document.getElementById('firma_file').addEventListener('change', archivo2, false);
  document.getElementById('sello_file').addEventListener('change', archivo3, false);
</script>
