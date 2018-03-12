<div class="row">
  <div class="col-xs-9">
    <h3>Tratamiento	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_transaccion" onclick="cambio_radios_especial(1)">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
<br>
<input type="hidden" id="transaccion_count_p" value={{count($ingreso->transaccion->detalleTransaccion->where('f_servicio','=',null))}}>
@if (count($ingreso->transaccion->detalleTransaccion->where('f_servicio','=',null))>0)
  <div class="row">
    <div class="col-xs-12">
      <table class="table" id="tablaDetalle">
        <thead>
          <th style="width: 120px">Fecha</th>
          <th style="width: 200px">Cantidad</th>
          <th>Detalle</th>
        </thead>
        <tbody>
          @foreach ($ingreso->transaccion->detalleTransaccion as $k => $detalle)
          @if ($detalle->f_servicio == null) 
            <tr>
              <td>{{$detalle->created_at->format('d / m / Y')}}</td>
              <td>
                {{$detalle->cantidad.' '}}
                @if($detalle->divisionProducto->unidad==null)
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                @else
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                @endif
              </td>
              <td>{{$detalle->divisionProducto->producto->nombre}}</td>
            </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@else
  <div class="row" id="mensaje_provisional">
    <p>No hay medicamentos seleccionados para este paciente</p>
  </div>
@endif