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
@if ($ingreso->transaccion->detalleTransaccion->where('f_servicio','=',null)!=null)
  <div class="row">
    <div class="col-xs-12">
      <table class="table" id="tablaDetalle">
        <thead>
          <th style="width: 120px">Fecha</th>
          <th style="width: 200px">Cantidad</th>
          <th>Detalle</th>
          <th style="width: 120px">Opciones</th>
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
  <div class="row" id="mensaje_provisional">
    <p>No hay medicamentos seleccionados para este paciente</p>
  </div>
@endif