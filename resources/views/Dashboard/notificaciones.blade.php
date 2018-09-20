@if (Auth::check())
  @include('Dashboard.notificaciones.recepcion')
  @include('Dashboard.notificaciones.laboratorio')
  @include('Dashboard.notificaciones.ultrasonografia')
  @include('Dashboard.notificaciones.rayosx')
  @include('Dashboard.notificaciones.farmacia')
@endif