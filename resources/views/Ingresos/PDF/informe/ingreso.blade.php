<div class="row">
  <div class="col-xs-6">
    <h4><center>Medicamentos</center></h4>
    <table class="table-simple">
      <thead>
        <th style="width: 80px;">Cantidad</th>
        <th>Medicamento</th>
        <th style="width: 80px;">Total</th>
      </thead>
      <tbody>
        @php
          $total_med = 0;
        @endphp
        @for ($i = 0; $i <= $dias; $i++)
          @php
            $date_after_origen = $ingreso->fecha_ingreso->addDays($i);
            $date_next_after = $ingreso->fecha_ingreso->addDays(($i + 1));
            $date_before_after = $ingreso->fecha_ingreso->addDays(($i-1));
          @endphp
          @if ($i != 0)
            <tr>
              <td class="text-center" colspan="2"><b>{{$date_before_after->formatLocalized('Total del %d de %B de %Y')}}</b></td>
              <td class="text-right blue"><b>{{'$ '.number_format(($total_med),2,'.',',')}}</b></td>
            </tr>
          @endif
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_servicio',null) as $medicamento)
            @if ($medicamento->created_at->between($date_after_origen,$date_next_after))
              <tr>
                <td class="text-center">
                  {{$medicamento->cantidad.' '.$medicamento->divisionProducto->division->nombre}}
                </td>
                <td>
                  {{$medicamento->divisionProducto->producto->nombre.' '}}
                  
                </td>
                <td class="text-right">{{'$ '.number_format(($medicamento->precio * $medicamento->cantidad),2,'.',',')}}</td>
                @php
                  $total_med += ($medicamento->precio * $medicamento->cantidad);
                @endphp
              </tr>
            @endif
          @endforeach
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>{{$date_after_origen->formatLocalized('Total del %d de %B de %Y')}}</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_med),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-xs-6">
    <h4><center>Servicios hospitalarios</center></h4>
    <table class="table-simple">
      <thead>
        <th style="width: 100px">Fecha</th>
        <th>Habitación</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_habitacion= 0; $i <= $dias; $i++)
          @php
            $date_after_origen = $ingreso->fecha_ingreso->addDays($i);
            $date_next_after = $ingreso->fecha_ingreso->addDays(($i + 1));
          @endphp
          @php
            $habitacion_count = app\DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$date_after_origen)->count();
          @endphp
          @if ($habitacion_count == 0)
            <tr>
              <td class="text-center">{{$date_after_origen->format('d / m / Y')}}</td>
              <td>{{'Habitación '.$ingreso->habitacion->numero}}</td>
              <td class="text-right">{{'$ '.number_format(($ingreso->habitacion->servicio->precio),2,'.',',')}}</td>
              @php
                $total_habitacion += number_format(($ingreso->habitacion->servicio->precio),2,'.',',');
              @endphp
            </tr>
          @else
            @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle)
              @if ($detalle->servicio->categoria->nombre == "Habitación" && ($detalle->created_at == $date_after_origen))
                <tr>
                  <td class="text-center">{{$date_after_origen->format('d / m / Y')}}</td>
                  <td>{{$detalle->servicio->nombre}}</td>
                  <td class="text-right">{{'$ '.number_format(($detalle->precio),2,'.',',')}}</td>
                  @php
                    $total_habitacion += number_format(($detalle->precio),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
          @endif 
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de habitación</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_habitacion),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
    <br>
    <table class="table-simple">
      <thead>
        <th style="width: 100px">Fecha</th>
        <th>Examen</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_laboratorio = 0; $i <= $dias; $i++)
          @php
            $date_after_origen = $ingreso->fecha_ingreso->addDays($i);
            $date_next_after = $ingreso->fecha_ingreso->addDays(($i + 1));
          @endphp
          @if (count($ingreso->transaccion->solicitud) > 0)
            @foreach ($ingreso->transaccion->solicitud as $solicitud)
              @if ($solicitud->estado != 0 && ($solicitud->created_at->between($date_after_origen,$date_next_after)))
                <tr>
                  <td class="text-center">{{$date_after_origen->format('d / m / Y')}}</td>
                  <td>{{$solicitud->examen->nombreExamen}}</td>
                  <td class="text-right">{{'$ '.number_format(($solicitud->examen->servicio->precio),2,'.',',')}}</td>
                  @php
                    $total_laboratorio += number_format(($solicitud->examen->servicio->precio),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
          @endif
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de laboratorio clínico</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_laboratorio),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
    <br>
    <table class="table-simple">
      <thead>
        <th style="width: 100px">Fecha</th>
        <th>Servicio</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_servicio = 0; $i <= $dias; $i++)
          @php
            $date_after_origen = $ingreso->fecha_ingreso->addDays($i);
            $date_next_after = $ingreso->fecha_ingreso->addDays(($i + 1));
          @endphp
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle)
              @if ($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Habitación" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && ($detalle->created_at->between($date_after_origen,$date_next_after)))
                <tr>
                  <td class="text-center">{{$date_after_origen->format('d / m / Y')}}</td>
                  <td>{{$detalle->servicio->nombre}}</td>
                  <td class="text-right">{{'$ '.number_format(($detalle->precio * $detalle->cantidad),2,'.',',')}}</td>
                  @php
                    $total_servicio += number_format(($detalle->precio * $detalle->cantidad),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de servicios</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_servicio),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
    <br>
    <h4><center>Honorarios Médicos</center></h4>
    <table class="table-simple">
      <thead>
        <th style="width: 100px">Fecha</th>
        <th>Médico</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_honorario = 0; $i <= $dias; $i++)
          @php
            $date_after_origen = $ingreso->fecha_ingreso->addDays($i);
            $date_next_after = $ingreso->fecha_ingreso->addDays(($i + 1));
          @endphp
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle)
              @if ($detalle->servicio->categoria->nombre == "Honorarios" && ($detalle->created_at->between($date_after_origen,$date_next_after)))
                <tr>
                  <td class="text-center">{{$date_after_origen->format('d / m / Y')}}</td>
                  <td>{{$detalle->servicio->nombre}}</td>
                  <td class="text-right">{{'$ '.number_format(($detalle->precio * $detalle->cantidad),2,'.',',')}}</td>
                  @php
                    $total_honorario += number_format(($detalle->precio * $detalle->cantidad),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de honorarios médicos</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_honorario),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
    <br>
    <h4><center>Abonos</center></h4>
    <table class="table-simple">
      <thead>
        <th>Fecha</th>
        <th style="width: 80px">Abono</th>
      </thead>
      <tbody>
        @for ($i = $total_abonado = 0; $i <= $dias; $i++)
          @php
            $date_after_origen = $ingreso->fecha_ingreso->addDays($i);
            $date_next_after = $ingreso->fecha_ingreso->addDays(($i + 1));
          @endphp
          @foreach ($ingreso->transaccion->Abono as $abono)
            @if ($abono->created_at->between($date_after_origen, $date_next_after))
              <tr>
                <td>{{$date_after_origen->formatLocalized('%d de %B de %Y')}}</td>
                <td class="text-right">{{'$ '.number_format(($abono->monto),2,'.',',')}}</td>
                @php
                  $total_abonado += number_format(($abono->monto),2,'.',',');
                @endphp
              </tr>
            @endif
          @endforeach
        @endfor
        <tr>
          <td class="text-center"><b>Total abonado</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_abonado),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <br>
  <h4><center>Resumen</center></h4>
  <div class="col-xs-4">
    <table style="width: 100%">
      <tr>
        <td>Habitación</td>
        <td class="text-right">{{'$ '.number_format(($total_habitacion),2,'.',',')}}</td>
      </tr>
      <tr>
        <td>Laboratorio Clínico</td>
        <td class="text-right">{{'$ '.number_format(($total_laboratorio),2,'.',',')}}</td>
      </tr>
      <tr>
        <td>Servicios</td>
        <td class="text-right">{{'$ '.number_format(($total_servicio),2,'.',',')}}</td>
      </tr>
      @php
        $total_servicio_hospitalario = number_format(($total_habitacion),2,'.',',') + number_format(($total_servicio),2,'.',',') + number_format(($total_laboratorio),2,'.',',');
      @endphp
      <tr style="border-top: 1px black double">
        <td><b>Total servicios hospitalarios</b></td>
        <td class="text-right blue">{{'$ '.number_format(($total_servicio_hospitalario),2,'.',',')}}</td>
      </tr>
    </table>
  </div>
  <div class="col-xs-4" style="border-left: 1px black solid; border-right: 1px black solid;">
    <table style="width: 100%">
      <tr>
        <td>Servicios hospitalarios</td>
        <td class="text-right">{{'$ '.number_format(($total_servicio_hospitalario),2,'.',',')}}</td>
      </tr>
      <tr>
        <td>Medicamentos</td>
        <td class="text-right">{{'$ '.number_format(($total_med),2,'.',',')}}</td>
      </tr>
      <tr>
        <td>Honorarios médicos</td>
        <td class="text-right">{{'$ '.number_format(($total_honorario),2,'.',',')}}</td>
      </tr>
      @php
        $subtotal = number_format(($total_servicio_hospitalario),2,'.',',') + number_format(($total_med),2,'.',',') + number_format(($total_honorario),2,'.',',');
      @endphp
      <tr style="border-top: 1px black double">
        <td><b>Subtotal</b></td>
        <td class="text-right blue">{{'$ '.number_format(($subtotal),2,'.',',')}}</td>
      </tr>
      @php
        $iva = number_format(($subtotal),2,'.',',') * 0.13;
        $total = number_format(($subtotal),2,'.',',') + number_format($iva,2,'.',',');
      @endphp
      <tr>
        <td>IVA (13%)</td>
        <td class="text-right">{{'$ '.number_format(($iva),2,'.',',')}}</td>
      </tr>
      <tr style="border-top: 1px black double">
        <td><b>Total</b></td>
        <td class="text-right blue">{{'$ '.number_format(($total),2,'.',',')}}</td>
      </tr>
    </table>
  </div>
  <div class="col-xs-4">
    <table style="width: 100%">
      <tr>
        <td>Total</td>
        <td class="text-right">{{'$ '.number_format(($total),2,'.',',')}}</td>
      </tr>
      <tr>
        <td>(-) Abonos</td>
        <td class="text-right">{{'$ '.number_format(($total_abonado),2,'.',',')}}</td>
      </tr>
      @php
        $a_pagar = number_format(($total),2,'.',',') - number_format(($total_abonado),2,'.',',');
      @endphp
      <tr style="border-top: 1px black double">
        <td><b>Saldo pendiente</b></td>
        @if ($a_pagar > 0)
          <td class="text-right red">{{'$ '.number_format(($a_pagar),2,'.',',')}}</td>
        @else
          <td class="text-right">{{'$ '.number_format(($a_pagar),2,'.',',')}}</td>
        @endif
      </tr>
    </table>
  </div>
</div>