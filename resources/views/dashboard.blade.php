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

  <!-- bootstrap-progressbar -->
  {!!Html::style('assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')!!}
  <!-- JQVMap -->
  {!!Html::style('assets/jqvmap/dist/jqvmap.min.css')!!}
  <!-- bootstrap-daterangepicker -->
  {!!Html::style('assets/bootstrap-daterangepicker/daterangepicker.css')!!}

  {!!Html::style('assets/datatables.net-bs/css/dataTables.bootstrap.min.css')!!}

  {!!Html::script('assets/sweetalert2/dist/sweetalert2.js')!!}
  {!!Html::style('assets/sweetalert2/dist/sweetalert2.css')!!}

  <!-- Css de nitify-->
  {!!Html::style('assets/pnotify/dist/pnotify.css')!!}
  {!!Html::style('assets/pnotify/dist/pnotify.buttons.css')!!}

  <!-- Custom Theme Style -->

  {!!Html::style('assets/build/css/custom.css')!!}
</head>

<body class="nav-md">
  @if(Session::has('mensaje'))
    <?php $mensaje = Session::get('mensaje');
    echo "<script>swal('$mensaje', 'Acción realizada satisfactorimente', 'success')</script>";?>
  @endif
  @if(Session::has('error'))
    <?php $men=Session::pull('error');
    echo "<script>swal('$men', 'Acción no realizada', 'error')</script>";?>
  @endif
  @if(Session::has('info'))
    <?php $men=Session::pull('info');
    echo "<script>swal('$men', 'Click al botón', 'info')</script>";?>
  @endif
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col ">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href={{asset('/')}} class="site_title"><i class="fa fa-medkit"></i> <span>Blissey</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src={!! asset(Storage::url((Auth::check())?Auth::user()->foto:"NoImgen.jpg")) !!} alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>
                @if (Auth::check())
                  <a href={{asset('/usuarios/'.Auth::user()->id)}} style="color:#FFF">
                    {{Auth::user()->nombre}}
                  </a>
                @else
                  {{"Invitado"}}
                @endif
              </h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Menú</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-shopping-cart"></i> Compras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="index.html">Compras</a></li>
                    <li><a href="index2.html">Productos</a></li>
                    <li><a href="index3.html">Proveedores</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-money"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="form.html">Ventas</a></li>
                    <li><a href="form_advanced.html">Clientes</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-stethoscope"></i> Consultas médica <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="general_elements.html">Signos Vitales</a></li>
                    <li><a href="media_gallery.html">Consultas</a></li>
                    <li><a href="typography.html">Recetas</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-medkit"></i> Laboratorio Clínico <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="tables.html">Laboratorio Clínico</a></li>
                    <li><a href="#">Rayos X</a></li>
                    <li><a href="#">Ultrasonografía</a></li>
                    <li><a href="#">Inventario</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-ambulance"></i> Hospitalización <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="chartjs.html">Observación</a></li>
                    <li><a href="chartjs2.html">Hospitalización</a></li>
                    <li><a href="morisjs.html">Cuenta</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-cogs"></i>Configuración <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    @if (Auth::check())
                      @if (Auth::user()->administrador)
                        <li><a>Usuarios <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href={{asset('/usuarios')}}>Usuarios</a></li>
                            <li><a href={{asset('/especialidades')}}>Especialidades Médicas</a></li>
                          </ul>
                        </li>
                      @else
                        <li><a href={{asset('/usuarios/'.Auth::user()->id)}}>Mi Perfil</a></li>
                      @endif
                      @if (Auth::user()->tipoUsuario == "Recepción")
                        <li><a>Servicios <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href={{asset('/servicios')}}>Servicios</a></li>
                            <li><a href={{asset('/categoria_servicios')}}>Categorias de servicios</a></li>
                          </ul>
                        </li>
                      @endif
                      <li><a href={{asset('/historial')}}>Historial</a></li>
                    @endif
                  </ul>
                </li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Salir" href="{{ route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src={!! asset(Storage::url((Auth::check())?Auth::user()->foto:"NoImgen.jpg")) !!} alt="">
                {{(Auth::check())?Auth::user()->nombre:"Invitado"}}
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href={{(Auth::check())?asset('/usuarios/'.Auth::user()->id):"#"}}>Mi Perfil</a></li>
                <li>
                  <a href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                <li>
                  <a href="{{ route('logout')}}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out pull-right"></i> Salir
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
  <!-- /top navigation -->
  <div class="right_col" role="main">
    @yield('layout')
  </div>
  <!-- footer content -->
  <footer>
    <div class="pull-right" style="color:#000">
      UES-FMP 2017
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->
</div>
</div>

{!!Html::script('assets/jquery/dist/jquery.min.js')!!}
<!-- Bootstrap -->
{!!Html::script('assets/bootstrap/dist/js/bootstrap.min.js')!!}
<!-- FastClick -->
{!!Html::script('assets/fastclick/lib/fastclick.js')!!}
<!-- NProgress -->
{!!Html::script('assets/nprogress/nprogress.js')!!}
<!-- Chart.js -->
{!!Html::script('assets/Chart.js/dist/Chart.min.js')!!}
<!-- gauge.js -->
{!!Html::script('assets/gauge.js/dist/gauge.min.js')!!}
<!-- bootstrap-progressbar -->
{!!Html::script('assets/bootstrap-progressbar/bootstrap-progressbar.min.js')!!}
<!-- iCheck -->
{!!Html::script('assets/iCheck/icheck.min.js')!!}
<!-- Skycons -->
{!!Html::script('assets/skycons/skycons.js')!!}
<!-- Flot -->
{!!Html::script('assets/Flot/jquery.flot.js')!!}
{!!Html::script('assets/Flot/jquery.flot.pie.js')!!}
{!!Html::script('assets/Flot/jquery.flot.time.js')!!}
{!!Html::script('assets/Flot/jquery.flot.stack.js')!!}
{!!Html::script('assets/Flot/jquery.flot.resize.js')!!}
<!-- Flot plugins -->
{!!Html::script('assets/flot.orderbars/js/jquery.flot.orderBars.js')!!}
{!!Html::script('assets/flot-spline/js/jquery.flot.spline.min.js')!!}
{!!Html::script('assets/flot.curvedlines/curvedLines.js')!!}
<!-- DateJS -->
{!!Html::script('assets/DateJS/build/date.js')!!}
<!-- JQVMap -->
{!!Html::script('assets/jqvmap/dist/jquery.vmap.js')!!}
{!!Html::script('assets/jqvmap/dist/maps/jquery.vmap.world.js')!!}
{!!Html::script('assets/jqvmap/examples/js/jquery.vmap.sampledata.js')!!}
<!-- bootstrap-daterangepicker -->
{!!Html::script('assets/moment/min/moment.min.js')!!}
{!!Html::script('assets/bootstrap-daterangepicker/daterangepicker.js')!!}

{!!Html::script('assets/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')!!}

{!!Html::script('assets/datatables.net/js/jquery.dataTables.js')!!}
{!!Html::script('assets/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}
{!!Html::script('assets/datatables.net-buttons/js/dataTables.buttons.min.js')!!}
{!!Html::script('assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')!!}
{!!Html::script('assets/datatables.net-responsive/js/dataTables.responsive.min.js')!!}
{!!Html::script('assets/datatables.net-responsive-bs/js/responsive.bootstrap.js')!!}
{!!Html::script('assets/datatables.net-scroller/js/dataTables.scroller.min.js')!!}

<!--para mensajes de error en validaciones-->
{!!Html::script('assets/pnotify/dist/pnotify.js')!!}
{!!Html::script('assets/pnotify/dist/pnotify.buttons.js')!!}
{!!Html::script('assets/jQuery-Smart-Wizard/js/jquery.smartWizard.js')!!}

<!--js agregados -->
{!!Html::script('js/scripts/proveedores.js')!!}<!--para el funcionamiento de ingresar en proveedores-->
{!!Html::script('js/scripts/Usuarios.js')!!}
{!!Html::script('js/scripts/Examenes.js')!!}
@section('scripts')
@show

<!-- Custom Theme Scripts -->

{!!Html::script('assets/build/js/custom.js')!!}
</body>
</html>
@foreach ($errors->all() as $error)
  <?php echo("<script language='javascript' >
  new PNotify({
    title: 'Error!',
    text: '".$error."',
    type: 'error',
    styling: 'bootstrap3'
  });
  </script>");?>
@endforeach
