<div class="row">
  <div class="col-xs-9">
    <h3>Tratamiento	</h3>
  </div>
  <div class="col-xs-2 alignright">
    <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_transaccion">
      <i class="fa fa-plus"></i> Nuevo
    </button>
  </div>
</div>
<br>
<input type="hidden" id="transaccion_count" value={{count($ingreso->transaccion->detalleTransaccion)}}>
<input type="hidden" id="transaccion" value={{$ingreso->transaccion->id}}>
<input type="hidden" id="tokenTransaccion" name="tokenTransaccion" value="<?php echo csrf_token(); ?>">
@if (count($ingreso->transaccion->detalleTransaccion)>0)
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