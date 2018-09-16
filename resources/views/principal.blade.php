<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Blissey</title>

  <!-- Bootstrap 4 -->
  {!! Html::style('library/Bootstrap4/css/bootstrap.css') !!}

  <!-- FontAwesome -->
  {!! Html::style('library/FontAwesome/css/all.css') !!}

  <!-- Animate -->
  {!!Html::style('css/animate.css')!!}

  <!-- SmartWizard -->
  {!!Html::style('library/SmartWizard/dist/css/smart_wizard.css')!!}

  <!-- DataTable -->
  {!!Html::style('library/DataTable/datatables.css')!!}

  <!-- SweetAlert2 -->
  {!!Html::script('library/SweetAlert2/dist/sweetalert2.js')!!} {!!Html::style('library/SweetAlert2/dist/sweetalert2.css')!!}

  <!-- FullCalendar -->
  {!!Html::style('library/FullCalendar/fullcalendar.css')!!}

  <!-- Switchery -->
  {!!Html::style('library/Switchery/dist/switchery.min.css')!!}

  <!-- Custom -->
  {!!Html::style('library/Gentelella/custom.css')!!}
</head>
<body class="nav-md">

  <div class="container-fluid side_back">
    <div class="row">
      <div class="col-2 left_col side_back">
        @include('Dashboard.panel_izquierdo')
      </div>
      <div class="col-10 side_back bg-light" role="main">
        @yield('layout')
      </div>
    </div>
  </div>
  
  <!-- jQuery -->
  {!!Html::script('library/FullCalendar/lib/jquery.min.js')!!}
  {!!Html::script('library/FullCalendar/lib/jquery-migrate.js')!!}

  <!-- Chart.js -->
  {!!Html::script('library/Chart.js/chart.js/dist/Chart.min.js')!!}

  <!-- Bootstrap4 -->
  {!!Html::script('library/Bootstrap4/js/bootstrap.bundle.js')!!}

  <!-- DataTable -->
  {!!Html::script('library/DataTable/datatables.js')!!}

  <!-- SmartWizard -->
  {!!Html::script('library/SmartWizard/dist/js/jquery.smartWizard.js')!!}

  <!-- InputMask -->
  {!!Html::script('library/Inputmask/dist/min/jquery.inputmask.bundle.min.js')!!}

  <!-- RangeSlider -->
  {!!Html::script('library/RangeSlider/js/ion.rangeSlider.min.js')!!} 

  <!-- FullCalendar -->
  {!!Html::script('library/FullCalendar/lib/moment.min.js')!!}
  {!!Html::script('library/FullCalendar/fullcalendar.js')!!}
  {!!Html::script('library/FullCalendar/locale/es.js')!!}

  <!-- ImageViewer -->
  {!!Html::script('js/imageViewer/jquery-ui.js')!!}
  {!!Html::script('js/imageViewer/jquery.fs.zoetrope.min.js')!!}
  {!!Html::script('js/imageViewer/toe.min.js')!!}
  {!!Html::script('js/imageViewer/jquery.mousewheel.min.js')!!}
  {!!Html::script('js/imageViewer/imgViewer.js')!!}

  <!-- Blissey -->
  {!!Html::script('js/general.js')!!}
  {!!Html::script('js/scripts/proveedores.js')!!}
  {!!Html::script('js/scripts/Usuarios.js')!!}
  {!!Html::script('js/scripts/Examenes.js')!!}
  {!!Html::script('js/scripts/Calendario.js')!!}
  {!!Html::script('js/scripts/Examenes2.js')!!}
  {!!Html::script('js/scripts/Productos.js')!!}
  {!!Html::script('js/scripts/Transacciones.js')!!}
  {!!Html::script('js/scripts/Ingreso.js')!!}
  {!!Html::script('js/scripts/Ingreso2.js')!!}
  {!!Html::script('js/scripts/IngresoX.js')!!}
  {!!Html::script('js/scripts/Ingreso_finanza.js')!!}
  {!!Html::script('js/scripts/Habitacion.js')!!}
  {!!Html::script('js/scripts/Consulta.js')!!}
  {!!Html::script('js/scripts/Consulta2.js')!!}
  {!!Html::script('js/scripts/Receta.js')!!}
  {!!Html::script('js/scripts/Paciente.js')!!}
  {!!Html::script('js/scripts/Empresa.js')!!}
  {!!Html::script('js/scripts/Solicitud.js')!!}
  {!!Html::script('js/scripts/Presentaciones.js')!!}
  {!!Html::script('js/scripts/Requisiciones.js')!!}
  {!!Html::script('js/scripts/StockProveedor.js')!!}

  <!-- Custom -->
  {!!Html::script('library/Gentelella/custom.js')!!}
</body>
</html>