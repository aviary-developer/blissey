@if (Auth::check())
  @include('Dashboard.notificaciones.recepcion')
@endif