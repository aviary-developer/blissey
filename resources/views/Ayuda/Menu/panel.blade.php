<div class="left_col scroll-view" style="background: #3498DB   !important;">

  <div class="navbar nav_title sticky-top" style="border: 0; background: #2471A3 !important;">
    <a href={{asset( '/ayuda/general')}}>
      <center>
        <img src={{asset('img/blisseyh.svg')}} alt="" style="width: 55%;">
      </center>
    </a>
  </div>

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
        <a href={{asset('#')}} class="text-light text-uppercase" style="text-shadow: 1px 1px #000;"> 
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
			<ul class="nav side-menu d-block" style="">
				@include('Ayuda.Menu.menu')
			</ul>
    </div>
  </div>
</div>