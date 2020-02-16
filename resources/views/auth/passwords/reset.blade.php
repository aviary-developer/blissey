<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blissey</title>
    <!-- Bootstrap 4 -->
		{!! Html::style('library/Bootstrap4/css/bootstrap.css') !!}

		<!-- FontAwesome -->
		{!! Html::style('library/FontAwesome/css/all.css') !!}
    <!-- Custom -->
  	{!!Html::style('library/Gentelella/custom.css')!!}
    {!!Html::style('library/pnotify/dist/pnotify.css')!!}
    {!!Html::style('library/pnotify/dist/pnotify.buttons.css')!!}
    {{--  --}}
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <input type="hidden" value="" id="guardarruta">
            {!!Form::open(['route'=>'password.request','method'=>'POST','autocomplete'=>'off','id'=>'formulario'])!!}
              {{ csrf_field()}}
              <input type="hidden" name="token" value="{{ $token }}">
              <h1>Recuperar contraseña</h1>
              <div>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Correo electrónico" autofocus>

                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña">
              </div>
              <div>
                {!! Form::button('Restablecer',['class'=>'btn btn-primary','onclick'=>'aceptar();']) !!}
                <a class="reset_pass" href={{asset( '/')}}>Inicio</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-medkit"></i>&nbsp;Blissey</h1>
                  <p>©2017 Universidad de El Salvador - Facultad Multidisciplinaria Paracentral</p>
                </div>
              </div>
              {!! Form::close() !!}
          </section>
        </div>
      </div>
    </div>
        <!-- jQuery -->
  	{!!Html::script('library/Gentelella/app.js')!!}
    {!!Html::script('library/pnotify/dist/pnotify.js')!!}
    {!!Html::script('library/pnotify/dist/pnotify.buttons.js')!!}
    {!!Html::script('library/DataTable/datatables.js')!!}
    {{-- {!!Html::script('js/general.js')!!} --}}
  </body>
  <script type="text/javascript">
  function aceptar(){
    r_email= $("#email").val();
    r_password= $("#password").val();
    r_password_c= $("#password-confirm").val();
    if(r_email!="" && r_password!="" && r_password_c!=""){
      var dominio = window.location.host;
      var protocolo = window.location.protocol;
      if (dominio == "localhost" || dominio == "127.0.0.1") {
        $('#guardarruta').val(protocolo + "//" + "localhost/blissey/public");
      } else {
        $('#guardarruta').val(protocolo + "//" + dominio + "/blissey/public");
      }
    // $.ajax({
    //       type: "POST",
    //       url: $('#guardarruta').val() + "/cpsw",//Comparar password con usuario
    //       data: {
    //         email: r_email,
    //         password: r_password,
    //       },
    //       success: function (respuesta) {
    //         console.log(respuesta);
    //         if (respuesta != "1") {
    //           new PNotify({
    //             title: '¡Error!',
    //             text: 'La contraseña no debe contener al nombre de usuario o correo',
    //             type: 'error',
    //             styling: 'bootstrap3'
    //           });
    //         }else {
    //           $("#formulario").submit();
    //         }
    //       }
    //     });
        console.log($('#guardarruta').val());
        var ruta = $('#guardarruta').val() + "/cpsw/" + r_email+'/'+r_password;
        $.get(ruta, function (res) {
          if(res=="error"){
            new PNotify({
              title: '¡Error!',
              text: 'La contraseña no debe contener al nombre de usuario o correo',
              type: 'error',
              styling: 'bootstrap3'
            });
          }else{
            $("#formulario").submit();
          }
        });
      }else{
        $("#formulario").submit();
      }
  }
  </script>
</html>
@foreach ($errors->all() as $error)
  <?php echo("<script language='javascript' >
  new PNotify({
    title: '¡Error!',
    text: '".$error."',
    type: 'error',
    styling: 'bootstrap3'
  });
  </script>");?> @endforeach
