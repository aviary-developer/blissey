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

    {!!Html::style('assets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')!!}
    <!-- Custom Theme Style -->
    {!!Html::style('assets/build/css/custom.css')!!}
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col ">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-medkit"></i> <span>Blissey</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src={!! asset('/img/img.jpg') !!} alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>John Doe</h2>
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
                      <li><a href="fixed_sidebar.html">Base de datos</a></li>
                      <li><a href="fixed_footer.html">Usuarios</a></li>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
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
                    <img src={!! asset('/img/img.jpg') !!} alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src={!! asset('/img/img.jpg') !!} alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src={!! asset('/img/img.jpg') !!} alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src={!! asset('/img/img.jpg') !!} alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src={!! asset('/img/img.jpg') !!} alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
          @yield('layout')
        </div>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            UES-FMP 2017 | Blissey powered by Gentelella
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

    {!!Html::script('assets/datatables.net/js/jquery.dataTables.js')!!}
    {!!Html::script('assets/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}
    {!!Html::script('assets/datatables.net-buttons/js/dataTables.buttons.min.js')!!}
    {!!Html::script('assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')!!}
    {!!Html::script('assets/datatables.net-responsive/js/dataTables.responsive.min.js')!!}
    {!!Html::script('assets/datatables.net-responsive-bs/js/responsive.bootstrap.js')!!}
    {!!Html::script('assets/datatables.net-scroller/js/dataTables.scroller.min.js')!!}

    <!-- Custom Theme Scripts -->
    {!!Html::script('assets/build/js/custom.js')!!}

  </body>
</html>
