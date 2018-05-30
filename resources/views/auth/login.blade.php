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
    {!!Html::style('assets/build/css/custom.min.css')!!}
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
                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Usuario','required'=>''])!!}
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
  </body>
</html>
