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
            {!!Form::open(['route'=>'password.email','method'=>'POST','autocomplete'=>'off'])!!}
              {{ csrf_field()}}
              <h1>Recupera tu cuenta</h1>
              <div>
                {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Correo electrónico','id'=>'email'])!!}
              </div>
              <div>
                {!! Form::submit('Enviar',['class'=>'btn btn-primary']) !!}
                <h5>Enviaremos un enlace a tu correo</h5>
                <a class="reset_pass" href={{asset( '/')}}>Regresar</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-medkit"></i>&nbsp;Blissey</h1>
                  <p>©{{date('Y')}} Universidad de El Salvador - Facultad Multidisciplinaria Paracentral</p>
                </div>
              </div>
              {!! Form::close() !!}
          </section>
        </div>
      </div>
    </div>
  </body>
    <!-- jQuery -->
  	{!!Html::script('library/Gentelella/app.js')!!}
    {!!Html::script('library/pnotify/dist/pnotify.js')!!}
    {!!Html::script('library/pnotify/dist/pnotify.buttons.js')!!}

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
