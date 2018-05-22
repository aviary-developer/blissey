<div class="x_content" onmouseover="precarga()">
  <div class="form_wizard wizard_horizontal" id="wizard">
    {{-- Encabezado del wizard --}}
    <ul class="wizard_steps">
      <li>
        <a href="#step-1">
          <span class="step_no">
            <i class="fa fa-list-alt"></i>
          </span>
          <span class="step_descr">
            Paso 1 <br>
            <small>Datos personales</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-2">
          <span class="step_no">
            <i class="fa fa-user"></i>
          </span>
          <span class="step_descr">
            Paso 2 <br>
            <small>Datos de usuario</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-3">
          <span class="step_no">
            <i class="fa fa-user-md"></i>
          </span>
          <span class="step_descr">
            Paso 3 <br>
            <small>Datos de especialidad</small>
          </span>
        </a>
      </li>
    </ul>
    {{-- Contenido del wizard --}}
    <div id="step-1" onmouseover="verAlerta1()">
      @include('Usuarios.Formularios.pasos.paso1')
    </div>
    <div id="step-2">
      @include('Usuarios.Formularios.pasos.paso2')
    </div>
    <div id="step-3" onmouseover="verAlerta2()">
      @include('Usuarios.Formularios.pasos.paso3')
    </div>
  </div>
  <input type="hidden" name="precio" id="precio">
  <input type="hidden" name="retencion" id="retencion">
  <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">
</div>
<script type="text/javascript">
  var cuenta1 = 0;
  var cuenta2 = 0;
  var cuenta3 = 0;

  function precarga(){
    if(cuenta3==0){
      tipo_usuario();
    }
    cuenta3++;
  }

  function tipo_usuario(){
    var valorUsuario = $("#tipoUsuario").val();

    if(valorUsuario == 'Farmacia'){
      document.getElementById('juntaVigilancia').style.display = 'block';
      document.getElementById('firma').style.display = 'none';
      document.getElementById('sello').style.display = 'none';
      document.getElementById('list2').style.display = 'none';
      document.getElementById('list3').style.display = 'none';
      document.getElementById('grupoEspecialidad').style.display = 'none';
      document.getElementById('tablaEspecialidad').style.display = 'none';
      document.getElementById('texto').style.display = 'none';
      //Divisor
      $('#divisor').addClass('col-md-6');
      $('#divisor').addClass('col-sm-6');
      $('#divisor').addClass('col-xs-12');
      //Remover
      $("#div_solo").removeClass();
      $("#div_grupo").removeClass();
      $("#div_junta").removeClass();
      $("#div_sello").removeClass();
      $("#div_firma").removeClass();
    }else if(!(valorUsuario == 'Recepción' || valorUsuario == 'Enfermería' || valorUsuario == 'Laboaratorio' || valorUsuario == 'Ultrasonografía' || valorUsuario == 'Rayos X')){
      document.getElementById('juntaVigilancia').style.display = 'block';
      document.getElementById('firma').style.display = 'block';
      document.getElementById('sello').style.display = 'block';
      document.getElementById('list2').style.display = 'block';
      document.getElementById('list3').style.display = 'block';
      document.getElementById('grupoEspecialidad').style.display = 'block';
      document.getElementById('tablaEspecialidad').style.display = 'table';
      document.getElementById('texto').style.display = 'none';
      //Divisor
      $('#divisor').addClass('col-md-6');
      $('#divisor').addClass('col-sm-6');
      $('#divisor').addClass('col-xs-12');
      //Remover
      $("#div_solo").removeClass();
      $("#div_grupo").removeClass();
      $("#div_junta").removeClass();
      $("#div_sello").removeClass();
      $("#div_firma").removeClass();
    }else if(!(valorUsuario == 'Recepción' || valorUsuario == 'Enfermería' )){
      document.getElementById('juntaVigilancia').style.display = 'block';
      document.getElementById('firma').style.display = 'block';
      document.getElementById('sello').style.display = 'block';
      document.getElementById('list2').style.display = 'block';
      document.getElementById('list3').style.display = 'block';
      document.getElementById('grupoEspecialidad').style.display = 'none';
      document.getElementById('tablaEspecialidad').style.display = 'none';
      document.getElementById('texto').style.display = 'none';

      $('#divisor').removeClass();
      //Solo
      $('#div_solo').addClass('col-md-12');
      $('#div_solo').addClass('col-sm-12');
      $('#div_solo').addClass('col-xs-12');
      //Junta
      $('#div_junta').addClass('col-md-6');
      $('#div_junta').addClass('col-sm-6');
      $('#div_junta').addClass('col-xs-12');
      //Grupo
      $('#div_junta').addClass('col-md-12');
      $('#div_junta').addClass('col-sm-12');
      $('#div_junta').addClass('col-xs-12');
      //Sello
      $('#div_sello').addClass('col-md-6');
      $('#div_sello').addClass('col-sm-6');
      $('#div_sello').addClass('col-xs-12');
      //Firma
      $('#div_firma').addClass('col-md-6');
      $('#div_firma').addClass('col-sm-6');
      $('#div_firma').addClass('col-xs-12');
    }else{
      document.getElementById('juntaVigilancia').style.display = 'none';
      document.getElementById('firma').style.display = 'none';
      document.getElementById('sello').style.display = 'none';
      document.getElementById('list2').style.display = 'none';
      document.getElementById('list3').style.display = 'none';
      document.getElementById('grupoEspecialidad').style.display = 'none';
      document.getElementById('tablaEspecialidad').style.display = 'none';
      document.getElementById('texto').style.display = 'block';
      //Divisor
      $('#divisor').addClass('col-md-6');
      $('#divisor').addClass('col-sm-6');
      $('#divisor').addClass('col-xs-12');
      //Remover
      $("#div_solo").removeClass();
      $("#div_grupo").removeClass();
      $("#div_junta").removeClass();
      $("#div_sello").removeClass();
      $("#div_firma").removeClass();
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
          nonblock : false
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
          nonblock : false
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
