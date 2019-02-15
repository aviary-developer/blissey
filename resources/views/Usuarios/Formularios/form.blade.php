<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
{{-- @if($create)
<div id="smartwizard">
@else --}}
<div id="smartwizarde">
{{-- @endif --}}
  {{-- Encabezado del wizard --}}
  <ul>
    <li>
      <a href="#step-1">
        Paso 1 <br>
        <small>Datos personales</small>
      </a>
    </li>
    <li>
      <a href="#step-2">
        Paso 2 <br>
        <small>Datos de usuario</small>
      </a>
    </li>
    <li>
      <a href="#step-3">
        Paso 3 <br>
        <small>Datos de especialidad</small>
      </a>
    </li>
  </ul>
  {{-- Contenido del wizard --}}
  <div>
    <div id="step-1">
      @include('Usuarios.Formularios.pasos.paso1')
    </div>
    <div id="step-2">
      @include('Usuarios.Formularios.pasos.paso2')
    </div>
    <div id="step-3">
      @include('Usuarios.Formularios.pasos.paso3')
    </div>
  </div>
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
      $("#precio-div").hide();
      //Divisor
      $('#divisor').removeClass().addClass('col-sm-6');
      //Remover
      $("#div_solo").removeClass();
      $("#div_grupo").removeClass();
      $("#div_junta").removeClass();
      $("#div_sello").removeClass();
      $("#div_firma").removeClass();
    }else if(!(valorUsuario == 'Recepción' || valorUsuario == 'Enfermería' || valorUsuario == 'Laboaratorio' || valorUsuario == 'Ultrasonografía' || valorUsuario == 'Rayos X' || valorUsuario == 'TAC')){
      document.getElementById('juntaVigilancia').style.display = 'block';
      document.getElementById('firma').style.display = 'block';
      document.getElementById('sello').style.display = 'block';
      document.getElementById('list2').style.display = 'block';
      document.getElementById('list3').style.display = 'block';
      document.getElementById('grupoEspecialidad').style.display = 'block';
      document.getElementById('tablaEspecialidad').style.display = 'table';
      document.getElementById('texto').style.display = 'none';
      $("#precio-div").show();
      //Divisor
      $('#divisor').removeClass().addClass('col-sm-6');
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
      $("#precio-div").hide();

      $('#divisor').removeClass().addClass('col-sm-12');
      //Solo
      $('#div_solo').addClass('col-sm-12');
      //Junta
      $('#div_junta').addClass('col-sm-6');
      //Grupo
      $('#div_grupo').addClass('col-sm-12');
      //Sello
      $('#div_sello').addClass('col-sm-6');
      //Firma
      $('#div_firma').addClass('col-sm-6');
    }else{
      document.getElementById('juntaVigilancia').style.display = 'none';
      document.getElementById('firma').style.display = 'none';
      document.getElementById('sello').style.display = 'none';
      document.getElementById('list2').style.display = 'none';
      document.getElementById('list3').style.display = 'none';
      document.getElementById('grupoEspecialidad').style.display = 'none';
      document.getElementById('tablaEspecialidad').style.display = 'none';
      document.getElementById('texto').style.display = 'block';
      $("#precio-div").hide();
      //Divisor
      $('#divisor').removeClass().addClass('col-sm-6');
      //Remover
      $("#div_solo").removeClass();
      $("#div_grupo").removeClass();
      $("#div_junta").removeClass();
      $("#div_sello").removeClass();
      $("#div_firma").removeClass();
    }
  }

  $(document).ready(function(){
    tipo_usuario();
  });

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

  document.getElementById('foto').addEventListener('change', archivo, false);
  document.getElementById('firma_file').addEventListener('change', archivo2, false);
  document.getElementById('sello_file').addEventListener('change', archivo3, false);
</script>

{!!Html::script('js/scripts/Usuarios.js')!!}
