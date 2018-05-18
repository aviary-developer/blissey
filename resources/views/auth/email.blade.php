<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blissey</title>
    <!-- Bootstrap -->
    {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
    <!-- Font Awesome -->
    {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}
    <!-- NProgress -->
    {!!Html::style('assets/nprogress/nprogress.css')!!}
    <!-- Animate.css -->
    {!!Html::style('assets/iCheck/skins/flat/green.css')!!}

    {!!Html::style('assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')!!}

    {!!Html::style('assets/pnotify/dist/pnotify.css')!!}
    {!!Html::style('assets/pnotify/dist/pnotify.buttons.css')!!}
    {!!Html::style('assets/build/css/custom.min.css')!!}
    {{--  --}}
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {{-- <form method="POST" action="{{'/correo'}}" autocomplete="off"> --}}
            {!!Form::open(['url'=>'correo','method'=>'POST','autocomplete'=>'off'])!!}
              {{ csrf_field()}}
              <h1>Recupera tu cuenta</h1>
              <div>
                {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Correo electrónico'])!!}
              </div>
              <div>
                {!! Form::submit('Enviar',['class'=>'btn btn-primary']) !!}
                <h5>Enviaremos en enlace a tu correo</h5>
                <a class="reset_pass" href={{asset( '/')}}>Regresar</a>
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
  </body>
  {!!Html::script('assets/jquery/dist/jquery.min.js')!!}
  {!!Html::script('assets/bootstrap/dist/js/bootstrap.min.js')!!}
  {!!Html::script('assets/fastclick/lib/fastclick.js')!!}
  {!!Html::script('assets/nprogress/nprogress.js')!!}
  {!!Html::script('assets/bootstrap-progressbar/bootstrap-progressbar.min.js')!!}
  {!!Html::script('assets/iCheck/icheck.min.js')!!}

  {!!Html::script('assets/pnotify/dist/pnotify.js')!!}
  {!!Html::script('assets/pnotify/dist/pnotify.buttons.js')!!}

{!!Html::script('assets/build/js/custom.js')!!}

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
