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
  {!!Html::script('library/SweetAlert2/dist/sweetalert2.all.js')
  !!}
  {!!Html::script('library/SweetAlert2/dist/sweetalert2.min.js')
  !!}
  {!!Html::style('library/SweetAlert2/dist/sweetalert2.css')!!}

  <!-- FullCalendar -->
  {!!Html::style('library/FullCalendar/fullcalendar.css')!!}

  <!-- RangeSlider -->
  {!!Html::style('library/RangeSlider/css/ion.rangeSlider.css')!!}
  {!!Html::style('library/RangeSlider/css/ion.rangeSlider.skinFlat.css')!!}

  <!-- Wysiwig -->
  {!!Html::style('library/google-code-prettify/bin/prettify.min.css')!!}

  <!-- Switchery -->
  {!!Html::style('library/Switchery/dist/switchery.min.css')!!}

  <!-- Custom -->
  {!!Html::style('library/Gentelella/custom.css')!!}

  <!-- jQuery -->
  {!!Html::script('library/Gentelella/app.js')!!}
  {!!Html::script('library/FullCalendar/lib/jquery-migrate.js')!!}
</head>
<body class="nav-md" style="background: #3498DB !important;">
  @if(Session::has('mensaje'))
  @php
    echo "<script>
      swal({
        type: 'success',
        toast: true,
        title: '¡Acción exitosa!',
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
    </script>";
  @endphp
  @endif
  @if(Session::has('error'))
  @php
    echo "<script>
      swal({
        type: 'error',
        toast: true,
        title: '¡Error!',
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
    </script>";
  @endphp
  @endif
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-2 left_col side_back h-100 left-cont" style="overflow-x: hidden; overflow-y: scroll; background: #3498DB !important">
        @include('Ayuda.Menu.panel')
      </div>
      <div class="col-10 side_back bg-light right-cont" role="main" style="overflow-x: hidden; overflow-y: scroll">
        <div style="min-height:calc(100% - 51px)">
          @yield('layout')
        </div>
        <div class="clearfix"></div>
        <section>
          <footer style="background-color: #DADADA">

            <div class="footer-copyright text-center py-3">
              UES - FMP 2018
            </div>

          </footer>
        </section>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </div>
  </div>
  <!-- Chart.js -->
  {!!Html::script('library/Chart.js/chart.js/dist/Chart.min.js')!!}

  <!-- Bootstrap4 -->
  {!!Html::script('js/Validated.js')!!}

  <!-- SmartWizard -->
  {!!Html::script('library/SmartWizard/dist/js/jquery.smartWizard.js')!!}

  <!-- Switchery -->
  {!!Html::script('library/Switchery/dist/switchery.min.js')!!}

  <!-- InputMask -->
  {!!Html::script('library/Inputmask/dist/min/jquery.inputmask.bundle.min.js')!!}

  <!-- RangeSlider -->
  {!!Html::script('library/RangeSlider/js/ion-rangeSlider/ion.rangeSlider.js')!!}
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

  <!-- DataTable -->
  {!!Html::script('library/DataTable/datatables.js')!!}

  <!-- Wysiwig -->
  {!!Html::script('library/Wysiwyg/js/bootstrap-wysiwyg.min.js')!!}
  {!!Html::script('library/jquery.hotkeys/jquery.hotkeys.js')!!}
  {!!Html::script('library/google-code-prettify/src/prettify.js')!!}

  <!-- General -->
  {!!Html::script('js/general.js')!!}

  <!-- Custom -->
  {!!Html::script('library/Gentelella/custom.js')!!}
</body>
</html>
@foreach ($errors->all() as $error)
  @php
    echo '
    <script language="javascript">
      swal({
        toast: true,
        type: "error",
        title: "¡Error!",
        html: "'.$error.'",
        position: "top-end",
        showConfirmButton: false,
        timer: 4000
      });
    </script>
    ';
  @endphp
@endforeach
