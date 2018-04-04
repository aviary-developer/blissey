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
</head>

<body class="nav-md footer_fixed">
  @if(Session::has('mensaje'))
    <?php $mensaje = Session::get('mensaje');
    echo "<script>swal('$mensaje', 'Acción realizada satisfactorimente', 'success')</script>";?> @endif @if(Session::has('error'))
      <?php $men=Session::pull('error');
      echo "<script>swal('$men', 'Acción no realizada', 'error')</script>";?> @endif @if(Session::has('info'))
        <?php $men=Session::pull('info');
        echo "<script>swal('$men', 'Click al botón', 'info')</script>";?> @endif
        <div class="container body">
          <div class="main_container">
            <div class="col-md-3 left_col">
              <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                  <a href={{asset( '/')}} class="site_title">
                    <i class="fa fa-medkit"></i>
                    <span>Blissey</span>
                  </a>
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
                        <a href={{asset( '/usuarios/'.Auth::user()->id)}} style="color:#FFF"> {{Auth::user()->nombre}}
                        </a>
                      @else {{"Invitado"}} @endif
                      </h2>
                    </div>
                  </div>
                  <!-- /menu profile quick info -->

                  <br />

                  <!-- sidebar menu -->
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                      @if (Auth::check())
                        <h3>Menú</h3>
                        <ul class="nav side-menu">
                          @if (Auth::user()->tipoUsuario == "Recepción")
                            <li>
                              <a>
                                <i class="fa fa-hospital-o"></i> Hospital
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                  <a href={{asset( '/pacientes')}}>Pacientes</a>
                                </li>
                                <li>
                                  <a href={{asset( '/ingresos')}}>Hospitalización</a>
                                </li>
                                <li>
                                  <a>Mantenimiento
                                    <span class="fa fa-chevron-down"></span>
                                  </a>
                                  <ul class="nav child_menu">
                                    <li>
                                      <a href={{asset( '/servicios')}}>Servicios</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/categoria_servicios')}}>Categorias de servicios</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/habitaciones')}}>Habitaciones</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <a>
                                <i class="fa fa-flask"></i> Laboratorio Clínico
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                <a href={{asset( '/solicitudex')}}>Solicitud de examen</a>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <a>
                                <i class="fa fa-medkit"></i> Botiquín
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                  <a href={{asset( '/inventarios')}}>Inventario</a>
                                </li>
                                <li>
                                  <a href={{asset( '/transacciones?tipo=0')}}>Pedidos</a>
                                </li>
                                <li>
                                  <a href={{asset( '/transacciones?tipo=2')}}>Ventas</a>
                                </li>
                                <li>
                                  <a href={{asset( '/requisiciones?tipo=4')}}>Requisiciones</a>
                                </li>
                                <li>
                                  <a>Mantenimiento
                                    <span class="fa fa-chevron-down"></span>
                                  </a>
                                  <ul class="nav child_menu">
                                    <li>
                                      <a href={{asset( '/estantes')}}>Estantes</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                          @elseif(Auth::user()->tipoUsuario == "Laboaratorio")
                            <li>
                              <a>
                                <i class="fa fa-flask"></i> Laboratorio Clínico
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                  <a>Evaluación de examen<span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu">
                                    <li>
                                      <a href={{asset( '/solicitudex')}}>Solicitudes</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/examenesEvaluados?vista=paciente')}}>Evaluados</a>
                                    </li>
                                  </ul>
                                </li>
                                <li>
                                  <a href={{asset( '/bancosangre')}}>Banco de sangre</a>
                                </li>
                                <li>
                                  <a>Mantenimiento
                                    <span class="fa fa-chevron-down"></span>
                                  </a>
                                  <ul class="nav child_menu">
                                    <li>
                                      <a href={{asset( '/examenes')}}>Exámenes</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/reactivos')}}>Reactivos</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/parametros')}}>Parametros</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/secciones')}}>Tipo de secciones</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/muestras')}}>Tipo de muestras</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/unidades')}}>Unidades de medida</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                          @elseif(Auth::user()->tipoUsuario == "Farmacia")
                            <li>
                              <a>
                                <i class="fa fa-users"></i> Personas
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                  <a href={{asset( '/pacientes')}}>Clientes</a>
                                </li>
                                <li>
                                  <a href={{asset( '/proveedores')}}>Proveedores</a>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <a>
                                <i class="fa fa-medkit"></i> Farmacia
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                  <a href={{asset( '/inventarios')}}>Inventario</a>
                                </li>

                                <li>
                                  <a href={{asset( '/transacciones?tipo=0')}}>Pedidos</a>
                                </li>
                                <li>
                                  <a href={{asset( '/transacciones?tipo=2')}}>Ventas</a>
                                </li>
                                <li>
                                  <a>Mantenimiento
                                    <span class="fa fa-chevron-down"></span>
                                  </a>
                                  <ul class="nav child_menu">
                                    <li>
                                      <a href={{asset( '/productos')}}>Productos</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/categoria_productos')}}>Categorías de productos</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/presentaciones')}}>Presentaciones</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/componentes')}}>Componentes</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/divisiones')}}>Divisiones</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/estantes')}}>Estantes</a>
                                    </li>
                                    <li>
                                      <a href={{asset( '/unidades')}}>Unidades de medida</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                          @endif
                          @if (Auth::user()->administrador)
                            <li>
                              <a>
                                <i class="fa fa-lock"></i> Administrador
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                <li>
                                  <a href={{asset( '/usuarios')}}>Usuarios</a>
                                </li>
                                <li>
                                  <a href={{asset( '/especialidades')}}>Especialidades Médicas</a>
                                </li>
                              </ul>
                            </li>
                          @endif
                          <li>
                            <a>
                              <i class="fa fa-info-circle"></i> Información
                              <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                              <li>
                                <a href={{asset( '/usuarios/'.Auth::user()->id)}}>Mi Perfil</a>
                              </li>
                              <li>
                                <a href={{asset( '/grupo_promesa')}}>Grupo Promesa</a>
                              </li>
                              <li>
                                <a href={{asset( '/historial')}}>Historial</a>
                              </li>
                            </ul>
                          </li>
                      </ul>
                    @else
                    <center>
                      <span class="label label-lg label-danger">
                        Registro del primer usuario
                      </span>
                    </center>
                    @endif
                  </div>

                </div>
                <div class="clearfix"></div>
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
          <div class="clearfix"></div>

          <!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
              <nav>
                <div class="nav toggle">
                  <a id="menu_toggle">
                    <i class="fa fa-bars"></i>
                  </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <img src={!! asset(Storage::url((Auth::check())?Auth::user()->foto:"NoImgen.jpg")) !!} alt=""> {{(Auth::check())?Auth::user()->nombre:"Invitado"}}
                      <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                      <li>
                        <a href={{(Auth::check())?asset( '/usuarios/'.Auth::user()->id):"#"}}>Mi Perfil</a>
                      </li>
                      <li>
                        <a href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                      </li>
                      <li>
                        <a href="javascript:;">Help</a>
                      </li>
                      <li>
                        <a href="{{ route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out pull-right"></i> Salir
                      </a>
                    </li>
                  </ul>
                </li>
                @if (Auth::check())
                  @if(Auth::user()->tipoUsuario == "Laboaratorio")
                    <!--INICIO DE NOTIICACIÓN-->
                    @php
                      $solicitudes= App\SolicitudExamen::where('estado','=',0)->orderBy('id','desc')->get();
                    @endphp
                    <li role="presentation" class="dropdown">
                      <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-red">{{count($solicitudes)}}</span>
                      </a>
                      <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach ($solicitudes as $key => $notificacion)
                        <li>
                          <a href="{{asset('/solicitudex?vista=paciente')}}">
                            <span>
                              @php
                              $apellido = explode(" ", $notificacion->paciente->apellido);
                            @endphp
                              <span><strong> {{$apellido[0]}}, {{$notificacion->paciente->nombre}}</strong></span>
                              <span class="time">{{$notificacion->created_at->diffForHumans()}}</span>
                            </span>
                            <span class="message">
                            {{$notificacion->examen->nombreExamen}} &nbsp Muestra:<strong>{{$notificacion->codigo_muestra}}</strong>
                            </span>
                          </a>
                        </li>
                        @php
                          if($key==4)
                          {break;}
                        @endphp
                        @endforeach
                        <li>
                          <div class="text-center">
                            <a href="{{asset('/solicitudex')}}">
                              <strong>Ver todas las solicitudes</strong>
                              <i class="fa fa-angle-right"></i>
                            </a>
                          </div>
                        </li>
                  </ul>
                    </li>
                    <!--FIN notificación-->
                  @endif
                  {{--inicio notificaciones de farmacia --}}
                  @if(Auth::user()->tipoUsuario == "Farmacia")
                    @php
                      $requisiciones= App\Transacion::where('tipo',4)->count();
                      $ultima= App\Transacion::where('tipo',4)->orderBy('id','asc')->get()->last();
                      $conteostock=App\DivisionProducto::conteo();
                      $stock=0;
                      if($conteostock>0){
                        $stock=1;
                      }
                      $porvencer=0;
                      $vencidos=0;
                      $total=$requisiciones+$stock+$porvencer+$vencidos;
                    @endphp
                    <li role="presentation" class="dropdown">
                      <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-red">{{$total}}</span>
                      </a>
                      @if ($total>0)
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @if ($requisiciones>0)
                              <li>
                              <a href="{{asset('/verrequisiciones?tipo=4')}}">
                                <span>
                                  <span><strong>Requisiciones del hospital</strong></span>
                                  <span class="time">Cantidad: <strong>{{$requisiciones}}</strong></span>
                                </span>
                                <span class="message">
                                  Más reciente: <strong>{{$ultima->created_at->diffForHumans()}}</strong>
                                </span>
                              </a>
                            </li>
                            @endif
                            @if ($stock>0)
                              <li>
                              <a onclick="verstockbajo()">
                                <span>
                                  <span><strong>Invetario bajo</strong></span>
                                  <span class="time">Cantidad: <strong>{{$conteostock}}</strong></span>
                                </span>
                                <span class="message">
                                  Existen <strong>{{$conteostock}} productos</strong>  bajo el stock mínimo
                                </span>
                              </a>
                            </li>
                            @endif
                    </ul>
                      @endif
                    </li>
                  @endif
                  {{--fin notificaciones de farmacia--}}
                  {{--inicio notificaciones de Recepción --}}
                  @if(Auth::user()->tipoUsuario == "Recepción")
                    @php
                      $requisiciones= App\Transacion::where('tipo',5)->count();
                      $ultima= App\Transacion::where('tipo',5)->orderBy('id','asc')->get()->last();
                      $conteostock=App\DivisionProducto::conteo();
                      $stock=0;
                      if($conteostock>0){
                        $stock=1;
                      }
                      $porvencer=0;
                      $vencidos=0;
                      $total=$requisiciones+$stock+$porvencer+$vencidos;
                    @endphp
                    <li role="presentation" class="dropdown">
                      <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-red">{{$total}}</span>
                      </a>
                      @if ($total>0)
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @if ($requisiciones>0)
                              <li>
                              <a href="{{asset('/requisiciones?tipo=5')}}">
                                <span>
                                  <span><strong>Requisiciones por ubicar</strong></span>
                                  <span class="time">Cantidad: <strong>{{$requisiciones}}</strong></span>
                                </span>
                                <span class="message">
                                  Más reciente: <strong>{{$ultima->created_at->diffForHumans()}}</strong>
                                </span>
                              </a>
                            </li>
                            @endif
                            @if ($stock>0)
                              <li>
                              <a onclick="verstockbajo()">
                                <span>
                                  <span><strong>Invetario bajo</strong></span>
                                  <span class="time">Cantidad: <strong>{{$conteostock}}</strong></span>
                                </span>
                                <span class="message">
                                  Existen <strong>{{$conteostock}} productos</strong>  bajo el stock mínimo
                                </span>
                              </a>
                            </li>
                            @endif
                    </ul>
                      @endif
                    </li>
                  @endif
                  {{--fin notificaciones de Recepción--}}
                @endif

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
          <div class="clearfix"></div>
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
    {!!Html::script('assets/flot.orderbars/js/jquery.flot.orderBars.js')!!} {!!Html::script('assets/flot-spline/js/jquery.flot.spline.min.js')!!}
    {!!Html::script('assets/flot.curvedlines/curvedLines.js')!!}
    <!-- DateJS -->
    {!!Html::script('assets/DateJS/build/date.js')!!}
    <!-- JQVMap -->
    {!!Html::script('assets/jqvmap/dist/jquery.vmap.js')!!} {!!Html::script('assets/jqvmap/dist/maps/jquery.vmap.world.js')!!}
    {!!Html::script('assets/jqvmap/examples/js/jquery.vmap.sampledata.js')!!}
    <!-- bootstrap-daterangepicker -->
    {!!Html::script('assets/moment/min/moment.min.js')!!} {!!Html::script('assets/bootstrap-daterangepicker/daterangepicker.js')!!}
    {!!Html::script('assets/ion.rangeSlider/js/ion.rangeSlider.min.js')!!} {!!Html::script('assets/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')!!}
    {!!Html::script('assets/datatables.net/js/jquery.dataTables.js')!!} {!!Html::script('assets/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}
    {!!Html::script('assets/datatables.net-buttons/js/dataTables.buttons.min.js')!!} {!!Html::script('assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')!!}
    {!!Html::script('assets/datatables.net-responsive/js/dataTables.responsive.min.js')!!} {!!Html::script('assets/datatables.net-responsive-bs/js/responsive.bootstrap.js')!!}
    {!!Html::script('assets/datatables.net-scroller/js/dataTables.scroller.min.js')!!}

      <!--para mensajes de error en validaciones-->
      {!!Html::script('assets/pnotify/dist/pnotify.js')!!}
      {!!Html::script('assets/pnotify/dist/pnotify.buttons.js')!!}
      {!!Html::script('assets/jQuery-Smart-Wizard/js/jquery.smartWizard.js')!!}
      {!!Html::script('assets/iCheck/icheck.min.js')!!}
      {!!Html::script('assets/switchery/dist/switchery.min.js')!!}
      <!--js agregados -->
      {!!Html::script('js/scripts/proveedores.js')!!}<!--para el funcionamiento de ingresar en proveedores-->
      {!!Html::script('js/scripts/Usuarios.js')!!}
      {!!Html::script('js/scripts/Examenes.js')!!}
      {!!Html::script('js/scripts/Examenes2.js')!!}
      {!!Html::script('js/scripts/Productos.js')!!}
      {!!Html::script('js/scripts/Transacciones.js')!!}
      {!!Html::script('js/scripts/Ingreso.js')!!}
      {!!Html::script('js/scripts/Paciente.js')!!}
      {!!Html::script('js/scripts/Empresa.js')!!}
      {!!Html::script('js/scripts/Solicitud.js')!!}
      {!!Html::script('js/scripts/Presentaciones.js')!!}
      {!!Html::script('js/general.js')!!}
      {!!Html::script('js/scripts/Requisiciones.js')!!}
      @section('scripts')
      @show

      <!-- Custom Theme Scripts -->

      {!!Html::script('assets/build/js/custom.js')!!}
  </body>
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
      <script type="text/javascript">
      function verstockbajo(){
        return swal({
          title: 'Seleccione una opción',
          text: "Como desea ver los productos que estan bajo el stock mínimo!",
          type: 'info',
          showCancelButton: true,
          confirmButtonText: 'Todos los productos',
          cancelButtonText: 'Por proveedor',
          confirmButtonClass: 'btn btn-info',
          cancelButtonClass: 'btn btn-info',
          buttonsStyling: false
        }).then(function () {
          var dominio = window.location.host;
          location.href ='http://'+dominio+'/blissey/public/stockTodos/';
        }, function (dismiss) {
          if (dismiss === 'cancel') {
            location.href ='http://'+dominio+'/blissey/public/stockProveedor/';
          }
        });
        }
      </script>
