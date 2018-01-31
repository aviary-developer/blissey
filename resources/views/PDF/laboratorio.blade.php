<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Blissey</title>
  <!-- jQuery -->
  <!-- Bootstrap -->
  {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
  <!-- Font Awesome -->
  {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}
  <!-- NProgress -->
  {!!Html::style('assets/nprogress/nprogress.css')!!}
  <!-- iCheck -->
  {!!Html::style('assets/iCheck/skins/flat/green.css')!!}
  <!-- iCheck -->
  {!!Html::style('css/animate.css')!!}

  <!-- bootstrap-progressbar -->
  {!!Html::style('assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')!!}
  <!-- JQVMap -->
  {!!Html::style('assets/jqvmap/dist/jqvmap.min.css')!!}
  <!-- bootstrap-daterangepicker -->
  {!!Html::style('assets/bootstrap-daterangepicker/daterangepicker.css')!!} {!!Html::style('assets/datatables.net-bs/css/dataTables.bootstrap.min.css')!!}
  {!!Html::script('assets/sweetalert2/dist/sweetalert2.js')!!} {!!Html::style('assets/sweetalert2/dist/sweetalert2.css')!!}

  <!-- Css de nitify-->
  {!!Html::style('assets/pnotify/dist/pnotify.css')!!} {!!Html::style('assets/pnotify/dist/pnotify.buttons.css')!!} {!!Html::style('assets/normalize-css/normalize.css')!!}
  {!!Html::style('assets/ion.rangeSlider/css/ion.rangeSlider.css')!!} {!!Html::style('assets/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')!!}

  <!-- Custom Theme Style -->
  {!!Html::style('assets/switchery/dist/switchery.min.css')!!}

  {!!Html::style('assets/build/css/custom.css')!!}

  <style type="text/css">
    div.page
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>
</head>

<body class="bg-white">
  <div class="page">

    @php
      $imagen = App\Empresa::first();
      $telefonos = App\TelefonoEmpresa::where('tipo','laboratorio')->get();
    @endphp
    <div class="row">
      <div class="col-xs-3">
        <img src={{asset(Storage::url($imagen->logo_laboratorio))}} width="140" height="165">
      </div>
      <div class="col-xs-6">
        <center>
          <h2>{{$imagen->nombre_laboratorio}}</h2>
          <h3>
            <i>
              <small>
                {{$imagen->direccion_laboratorio}}
                <br>
                @foreach ($telefonos as $telefono)
                  {{$telefono->telefono.' '}}
                @endforeach
              </small>
            </i>
          </h3>
        </center>
      </div>
      <div class="col-xs-3">
        <img src={{asset(Storage::url($imagen->logo_hospital))}} width="160" height="160">
      </div>
    </div>
    <div style="border: 1px solid black">
      @yield('layout')
    </div>
  <div class="row">
    Realizado por:{{Auth::user()->nombre}}   {{Auth::user()->apellido}}</div>
    <div class="col-xs-3">
    FIRMA:  <img src={!! asset(Storage::url((Auth::check())?Auth::user()->firma:"NoImgen.jpg")) !!} alt="..." width="160" height="140">
  </div><div class="col-xs-3">SELLO:  <img src={!! asset(Storage::url((Auth::check())?Auth::user()->sello:"NoImgen.jpg")) !!} alt="..." width="160" height="140">
      </div>
  </div>
  <div class="page">
    HHola
  </div>
  </body>
</html>
