<div class="left_col scroll-view">

  <div class="navbar nav_title sticky-top" style="border: 0;">
    <a href={{asset( '/')}}>
      <center>
        <img src={{asset('img/blissey1.svg')}} alt="" style="width: 55%;">
      </center>
    </a>
  </div>

  <img src={!! asset(Storage::url((Auth::check())?Auth::user()->foto:"NoImgen.jpg")) !!} alt="" class="image-porfile">

  <center>
    <span>
        @if (Auth::check())
          {{(Auth::user()->sexo)?"Bienvenido":"Bienvenida"}}
        @endif
    </span>
  </center>

  <center>
    <spna class="font-sm">
      @if (Auth::check())
        <a href={{asset( '/usuarios/'.Auth::user()->id)}} class="text-light text-uppercase" style="text-shadow: 1px 1px #000;"> 
          {{Auth::user()->nombre}}
        </a>
      @else
      @endif
    </spna>
  </center>

  <div class="ln_solid mt-1 mb-1"></div>
  <div class="clearfix"></div>

  <div class="main_menu_side hidden-print main_menu" id="sidebar-menu">
    <div class="menu_section">
      @if (Auth::check())
        <ul class="nav side-menu d-block" style="">
          @if (Auth::user()->tipoUsuario == "Recepción")
            @include('Dashboard.menu_recepcion')
          @elseif(Auth::user()->tipoUsuario == "Laboaratorio")
            @include('Dashboard.menu_laboratorio')
          @elseif(Auth::user()->tipoUsuario == "Farmacia")
            @include('Dashboard.menu_farmacia')
          @elseif(Auth::user()->tipoUsuario == "Enfermería" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Gerencia")
            @include('Dashboard.menu_medico')
          @elseif(Auth::user()->tipoUsuario == "Ultrasonografía")
            @include('Dashboard.menu_ultra')
          @elseif(Auth::user()->tipoUsuario == "Rayos X")
            @include('Dashboard.menu_rayosx')
          @elseif(Auth::user()->tipoUsuario == "TAC")
            @include('Dashboard.menu_tac')
          @endif
          @if (Auth::user()->administrador)
            @include('Dashboard.menu_admin')
          @endif
          @include('Dashboard.menu_general')
        </ul>
      @else
        <center>
          <span class="badge badge-danger">
            Registro del primer usuario
          </span>
        </center>
      @endif
    </div>
  </div>
</div>