@if(Auth::user()->tipoUsuario == "Laboaratorio")
  @php
    $solicitudes= App\SolicitudExamen::join('examens', 'solicitud_examens.f_examen', '=','examens.id')
            ->where('solicitud_examens.estado','=',1)
            ->where('examens.area','=','BACTERIOLOGIA')
            ->orderBy('solicitud_examens.created_at','asc')
            ->select('solicitud_examens.id','solicitud_examens.codigo_muestra','solicitud_examens.f_examen',
            'solicitud_examens.f_paciente','solicitud_examens.estado','solicitud_examens.created_at','solicitud_examens.updated_at',
            'solicitud_examens.f_transaccion','solicitud_examens.cancelado','solicitud_examens.completo','solicitud_examens.enviarClinica')
            ->get();
  @endphp
  <li class="dropdown nav-item">
    <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
      <i class="fas fa-bell"></i>
      @if ($solicitudes->count() > 0)
        <span class="badge badge-danger">{{$solicitudes->count()}}</span>
      @else
        <span class="badge badge-success">{{$solicitudes->count()}}</span>
      @endif
    </a>
    <div class="dropdown-menu new-drop msg_list list-unstyled" aria-labelledby="navbarDropdownMenuLink">
      @foreach ($solicitudes as $key => $notificacion)
        <a class="dropdown-item" href="{{asset('/solicitudesBacteriologia?tipo=examenes&vista=examenes')}}">
          <div class="flex-row">
            @php
              $apellido = explode(" ", $notificacion->paciente->apellido);
            @endphp
              <span class="text-uppercase text-monospace font-weight-light">{{$apellido[0]}}, {{$notificacion->paciente->nombre}}</span>
          </div>
          @php
            $muestraNoQs= explode(" ", $notificacion->codigo_muestra." siQS");
          @endphp
          <span class="message">
          {{$notificacion->examen->nombreExamen}} &nbsp Muestra:<strong>{{$muestraNoQs[0]}}</strong>
          </span>
          <center><span class="badge badge-primary">{{$notificacion->created_at->diffForHumans()}}</span></center>
        </a>
        <div class="dropdown-divider"></div>
        @php
          if($key==4)
          {break;}
        @endphp
      @endforeach
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-center" href="{{asset('/solicitudesBacteriologia?tipo=examenes&vista=examenes')}}">
        <strong>Ver solicitudes de bacteriología</strong>
        <i class="fas fa-angle-right"></i>
      </a>
    </div>
  </li>
@endif