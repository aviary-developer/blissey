<div class="row">
  <div class="col-xs-9">
    <h3>Servicios Hospitalarios	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_transaccion" onclick="cambio_radios_especial(3)">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
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
          <th style="width: 120px">Opcion</th>
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
              <td>
                @if (!$detalle->estado)
                  @if (Auth::user()->tipoUsuario == "Enfermería")
                    <span class="label label-lg label-warning col-xs-12">Pendiente</span>
                  @else
                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Confirmar" onclick={{"accion24(2,".$detalle->id.")"}}><i class="fa fa-check" ></i></button>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={{"accion24(0,".$detalle->id.")"}}><i class="fa fa-remove" ></i></button>
                  @endif
                @else
                  @if ($detalle->created_at->between($ultima24,$ultima48) && Auth::user()->tipoUsuario != "Enfermería")
                    <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" onclick={{"accion24(1,".$detalle->id.")"}}><i class="fa fa-edit" ></i></button>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={{"accion24(0,".$detalle->id.")"}}><i class="fa fa-remove" ></i></button>
                  @endif
                @endif
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