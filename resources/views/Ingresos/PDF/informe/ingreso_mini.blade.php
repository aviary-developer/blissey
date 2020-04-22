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
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $fecha_anterior = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              $fecha_anterior->subDay();
            }
            $fecha_anterior->subDay();
            $ultima_24->addDay();
          @endphp 
          @if ($i != 0)
            <tr>
              <td class="text-center" colspan="2"><b>{{$fecha_anterior->formatLocalized('Total acumulado al %d de %B de %Y')}}</b></td>
              <td class="text-right blue"><b>{{'$ '.number_format(($total_med),2,'.',',')}}</b></td>
            </tr>
          @endif
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_servicio',null)->where('estado',true) as $medicamento)
            @if ($medicamento->created_at->between($fecha_origen,$ultima_24))
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
          <td class="text-center" colspan="2"><b>{{$fecha_origen->formatLocalized('Total acumulado al %d de %B de %Y')}}</b></td>
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
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp 
          @php
            $habitacion_count = app\DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$fecha_origen)->count();
          @endphp
          @if ($habitacion_count == 0)
            <tr>
              <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
              <td>{{$ingreso->habitacion->servicio->nombre}}</td>
              <td class="text-right">{{'$ '.number_format(($ingreso->habitacion->servicio->precio),2,'.',',')}}</td>
              @php
                $total_habitacion += number_format(($ingreso->habitacion->servicio->precio),2,'.',',');
              @endphp
            </tr>
          @else
            @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle)
              @if ($detalle->servicio->categoria->nombre == "Cama" && ($detalle->created_at == $fecha_origen))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
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
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
          @if ($ingreso->transaccion->solicitud!=null)
            @foreach ($ingreso->transaccion->solicitud as $solicitud)
              @if ($solicitud->estado != 0 && ($solicitud->created_at->between($fecha_origen,$ultima_24) && $solicitud->f_examen != null))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
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
        <th>Rayos X</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_rayos_x = 0; $i <= $dias; $i++)
          @php
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
          @if ($ingreso->transaccion->solicitud!=null)
            @foreach ($ingreso->transaccion->solicitud as $solicitud)
              @if ($solicitud->estado != 0 && ($solicitud->created_at->between($fecha_origen,$ultima_24) && $solicitud->f_rayox != null))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
                  <td>{{$solicitud->rayox->nombre}}</td>
                  <td class="text-right">{{'$ '.number_format(($solicitud->rayox->servicio->precio),2,'.',',')}}</td>
                  @php
                    $total_rayos_x += number_format(($solicitud->rayox->servicio->precio),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
          @endif
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de Rayos X</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_rayos_x),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
    <br>
    <table class="table-simple">
      <thead>
        <th style="width: 100px">Fecha</th>
        <th>Ultrasonografía</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_ultras = 0; $i <= $dias; $i++)
          @php
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
          @if ($ingreso->transaccion->solicitud!=null)
            @foreach ($ingreso->transaccion->solicitud as $solicitud)
              @if ($solicitud->estado != 0 && ($solicitud->created_at->between($fecha_origen,$ultima_24) && $solicitud->f_ultrasonografia != null))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
                  <td>{{$solicitud->ultrasonografia->nombre}}</td>
                  <td class="text-right">{{'$ '.number_format(($solicitud->ultrasonografia->servicio->precio),2,'.',',')}}</td>
                  @php
                    $total_ultras += number_format(($solicitud->ultrasonografia->servicio->precio),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
          @endif
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de ultrasonografías</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_ultras),2,'.',',')}}</b></td>
        </tr>
      </tbody>
    </table>
    <br>
    <table class="table-simple">
      <thead>
        <th style="width: 100px">Fecha</th>
        <th>TAC</th>
        <th style="width: 80px">Total</th>
      </thead>
      <tbody>
        @for ($i = $total_tac = 0; $i <= $dias; $i++)
          @php
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
          @if ($ingreso->transaccion->solicitud!=null)
            @foreach ($ingreso->transaccion->solicitud as $solicitud)
              @if ($solicitud->estado != 0 && ($solicitud->created_at->between($fecha_origen,$ultima_24) && $solicitud->f_tac != null))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
                  <td>{{$solicitud->tac->nombre}}</td>
                  <td class="text-right">{{'$ '.number_format(($solicitud->tac->servicio->precio),2,'.',',')}}</td>
                  @php
                    $total_tac += number_format(($solicitud->tac->servicio->precio),2,'.',',');
                  @endphp
                </tr>
              @endif
            @endforeach
          @endif
        @endfor
        <tr>
          <td class="text-center" colspan="2"><b>Total de ultrasonografías</b></td>
          <td class="text-right blue"><b>{{'$ '.number_format(($total_tac),2,'.',',')}}</b></td>
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
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true) as $detalle)
              @if ($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Cama" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && $detalle->servicio->categoria->nombre != "Ultrasonografía" && $detalle->servicio->categoria->nombre != "Rayos X" && $detalle->servicio->categoria->nombre != "TAC" && ($detalle->created_at->between($fecha_origen,$ultima_24)))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
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
						$fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
						$fecha_origen_honorario = $ingreso->fecha_ingreso->addDays($i)->hour(0)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
					@foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle)
							<tr>{{$detalle->created_at->between($fecha_origen,$ultima_24)}}</tr>
              @if ($detalle->servicio->categoria->nombre == "Honorarios" && ($detalle->created_at->between($fecha_origen_honorario,$ultima_24)))
                <tr>
                  <td class="text-center">{{$fecha_origen->format('d/m/Y')}}</td>
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
            $fecha_origen = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            $ultima_24 = $ingreso->fecha_ingreso->addDays($i)->hour(7)->minute(0);
            
            $fecha_ingreso = $ingreso->fecha_ingreso->addDays($i);
            if($fecha_ingreso->lt($fecha_origen)){
              $fecha_origen->subDay();
              $ultima_24->subDay();
              
            }
            $ultima_24->addDay();
          @endphp
          @foreach ($ingreso->transaccion->Abono as $abono)
            @if ($abono->created_at->between($fecha_origen, $ultima_24))
              <tr>
                <td>{{$fecha_origen->formatLocalized('%d de %B de %Y')}}</td>
                <td class="text-right">{{'$ '.number_format(($abono->monto),2,'.',',')}}</td>
                @php
                  $total_abonado += floatval($abono->monto);
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
<div class="flex-row">
  <br>
  <h4><center>Resumen</center></h4>
  <div class="col-xs-4">
    <table style="width: 100%">
      @php
        $var_habitacion = number_format($total_habitacion,2,'.','');
        $var_laboratorio = number_format($total_laboratorio,2,'.','');
        $var_servicio = number_format($total_servicio,2,'.','');
        $total_servicio_hospitalario = 0;
        $total_servicio_hospitalario += floatval($total_habitacion);
				$total_servicio_hospitalario += floatval($total_laboratorio) + floatval($total_servicio) + floatval($total_rayos_x) + floatval($total_ultras) + floatval($total_tac);
				$total_evaluaciones = 0;
				$total_evaluaciones += floatval($total_laboratorio) + floatval($total_rayos_x) + floatval($total_ultras) + floatval($total_tac);
      @endphp
      <tr>
        <td>Habitación</td>
        <td class="text-right">{{'$ '.$var_habitacion}}</td>
      </tr>
      <tr>
        <td>Evaluaciones</td>
        <td class="text-right">{{'$ '.number_format($total_evaluaciones,2,'.',',')}}</td>
      </tr>
      <tr>
        <td>Servicios</td>
        <td class="text-right">{{'$ '.$var_servicio}}</td>
      </tr>
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
        $subtotal = 0;
        $subtotal += floatval($total_servicio_hospitalario);
        $subtotal += floatval($total_med) + floatval($total_honorario);
      @endphp
      <tr style="border-top: 1px black double">
        <td><b>Subtotal</b></td>
        <td class="text-right blue">{{'$ '.number_format(($subtotal),2,'.',',')}}</td>
      </tr>
			@php
				if($ingreso->iva){
					$iva = floatval($subtotal) * 0.13;
				}else{
					$iva = 0;
				}
				$total = floatval($subtotal) + floatval($iva);
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
        $a_pagar = floatval($total) - floatval($total_abonado);
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