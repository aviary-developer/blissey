@if ($tipo==0 && $pantalla==2 && !App\DetalleCaja::cajaApertura())
  <meta http-equiv="refresh" content="0;URL=../detalleCajas/create">
  @php
      $centinela=0;
  @endphp
@else
  @php
  $centinela=1;
  @endphp
@endif
