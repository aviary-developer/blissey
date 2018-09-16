<div class="left_col scroll-view">

  <div class="navbar nav_title sticky-top" style="border: 0;">
    <a href={{asset( '/')}} class="site_title">
      <center>
        <img src={{asset('img/blissey.svg')}} alt="" style="width: 55%;">
      </center>
    </a>
  </div>

  <img src={!! asset(Storage::url((Auth::check())?Auth::user()->foto:"NoImgen.jpg")) !!} alt="" class="image-porfile">

  <center>
    <span>
      {{(Auth::user()->sexo)?"Bienvenido":"Bienvenida"}}
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
        @if (Auth::user()->tipoUsuario == "Recepción")
          <ul class="nav side-menu d-block" style="">
            @include('Dashboard.menu_recepcion')
          </ul>
        @endif
      @else
        <center>
          <span class="badge badge-danger font-sm">
            Registro del primer usuario
          </span>
        </center>
      @endif
    </div>
  </div>
</div>