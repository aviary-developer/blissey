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

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{ route('authenticate')}}" autocomplete="off">
              {{ csrf_field()}}
              <h1>Bienvenido</h1>
              <div>
                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Usuario','required'=>'','autofocus'=>''])!!}
              </div>
              <div>
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña','required'=>''])!!}
              </div>
              <div>
                {!! Form::submit('Ingresar',['class'=>'btn btn-primary']) !!}
                <a class="reset_pass" href={{asset( '/password/email')}}>Olvidé mi contraseña</a>
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
            </form>
          </section>
        </div>
      </div>
    </div>
    <!-- jQuery -->
  	{!!Html::script('library/Gentelella/app.js')!!}
    {!!Html::script('library/pnotify/dist/pnotify.js')!!}
    {!!Html::script('library/pnotify/dist/pnotify.buttons.js')!!}
  </body>
</html>
@if(Session::has('error'))
  <?php
  $men=Session::pull('error');
  echo("<script language='javascript' >
  new PNotify({
    title: '¡Error!',
    text: '".$men."',
    type: 'error',
    styling: 'bootstrap3'
  });
  </script>");?> @endif
