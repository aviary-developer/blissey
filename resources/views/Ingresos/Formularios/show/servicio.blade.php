<div class="row">
  <div class="col-xs-9">
    <h3>Servicios Hospitalarios	</h3>
  </div>
  <div class="col-xs-2 alignright">
    <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_transaccion" onclick="cambio_radios_especial(3)">
      <i class="fa fa-plus"></i> Nuevo
    </button>
  </div>
</div>
<br>
@php
  $total = 0;
  foreach($ingreso->transaccion->detalleTransaccion->where('f_producto','=',null) as $detallado){
    if($detallado->servicio->categoria->nombre != "Honorarios" && $detallado->servicio->categoria->nombre != "Habitación" && $detallado->servicio->categoria->nombre != "Laboratorio Clínico"){
      $total++;
    }
  }
  
@endphp
<input type="hidden" id="transaccion_count_s" value={{$total}}>
@if ($total>0)
  <div class="row">
    <div class="col-xs-12">
      <table class="table" id="tablaDetalle_s">
        <thead>
          <th style="width: 120px">Fecha</th>
          <th style="width: 100px">Cantidad</th>
          <th>Detalle</th>
        </thead>
        <tbody>
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $k => $detalle)
          @if ($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Habitación" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico") 
            <tr>
              <td>{{$detalle->created_at->format('d / m / Y')}}</td>
              <td>
                {{$detalle->cantidad.' '}}
              </td>
              <td>
                {{$detalle->servicio->nombre}}
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@else
  <div class="row" id="mensaje_provisional_s">
    <p>No hay servicios seleccionados para este paciente</p>
  </div>
@endif