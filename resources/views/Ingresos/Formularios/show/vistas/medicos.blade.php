<div class="row">
  <div class="col-xs-9">
    <h3>Médicos</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)    
      <button type="button" class="btn btn-sm btn-primary alignright" data-toggle="modal" data-target="#modal_medico">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
@php
  $total_medicos = 0;
  foreach($ingreso->transaccion->detalleTransaccion->where('f_producto','=',null) as $detallado){
    if($detallado->servicio->categoria->nombre == "Honorarios"){
      $total_medicos++;
    }
  }
@endphp
@if ($total_medicos>0)
  <div class="row">
    <div class="col-xs-12">
      <table class="table" id="tablaDetalle_s">
        <thead>
          <th style="width: 120px">Fecha</th>
          <th>Detalle</th>
          <th style="width: 120px">Opciones</th>
        </thead>
        <tbody>
          @foreach ($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $k => $detalle)
          @if ($detalle->servicio->categoria->nombre == "Honorarios") 
            <tr>
              <td>{{$detalle->created_at->format('d / m / Y')}}</td>
              <td>
                {{$detalle->servicio->nombre}}
              </td>
              <td>
                @if ($detalle->created_at->between($ultima24,$ultima48))
                  <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={{"accion24(0,".$detalle->id.")"}}><i class="fa fa-remove" ></i></button>
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
    <p>No hay médicos seleccionados para este paciente</p>
  </div>
@endif