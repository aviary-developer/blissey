<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>
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
    {!!Html::style('css/pdf.css')!!}

    <style type="text/css">
      div.page
      {
          page-break-after: always;
          page-break-inside: avoid;
      }
    </style>
  </head>

  <body class="bg-white">
    @yield('layout')
  </body>
</html>
