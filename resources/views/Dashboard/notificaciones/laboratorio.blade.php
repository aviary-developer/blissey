@if(Auth::user()->tipoUsuario == "Laboaratorio")
  @php
    $solicitudes= App\SolicitudExamen::where('estado','=',0)->orderBy('id','desc')->get();
  @endphp
  <li class="dropdown nav-item">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
      <i class="fas fa-bell"></i>
      @if ($solicitudes->count() > 0)
        <span class="badge badge-danger">{{$solicitudes->count()}}</span>
      @else
        <span class="badge badge-success">{{$solicitudes->count()}}</span>
      @endif
    </a>
    <div class="dropdown-menu new-drop msg_list list-unstyled" aria-labelledby="navbarDropdownMenuLink">
      @foreach ($solicitudes as $key => $notificacion)
        <a class="dropdown-item" href="{{asset('/solicitudex?vista=paciente')}}">
          <div class="flex-row">
            @php
              $apellido = explode(" ", $notificacion->paciente->apellido);
            @endphp
            <center>
              <span class="text-uppercase text-monospace font-weight-light">{{$apellido[0]}}, {{$notificacion->paciente->nombre}}</span>
              <span class="badge badge-primary">{{$notificacion->created_at->diffForHumans()}}</span>
            </center>
          </div>
          <span class="message">
          {{$notificacion->examen->nombreExamen}} &nbsp Muestra:<strong>{{$notificacion->codigo_muestra}}</strong>
          </span>
        </a>
        <div class="dropdown-divider"></div>
        @php
          if($key==4)
          {break;}
        @endphp
      @endforeach
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-center" href="{{asset('/solicitudex')}}">
        <strong>Ver todas las solicitudes</strong>
        <i class="fas fa-angle-right"></i>
      </a>
    </div>
  </li>
@endif