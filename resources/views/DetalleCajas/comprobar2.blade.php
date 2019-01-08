@if ($tipo==0 && $pantalla==2 && !App\DetalleCaja::cajaApertura())
  <meta http-equiv="refresh" content="0;URL=../detalleCajas/create">
@endif
