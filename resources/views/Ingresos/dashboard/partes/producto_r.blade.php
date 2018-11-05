<div class="row">
  <div class="col-sm-8">
    <h5 class="text-primary">Medicamentos</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1 && Auth::user()->tipoUsuario != "Médico")  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#productos_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_productos" id="btn_v_p"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($count_p24 > 0)    
  <div class="flex-row" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
    <table class="table-basic">
      <thead>
        <tr>
          <th>Detalle</th>
          <th style="width: 50px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detalle_p as $detalle)
          @if ($detalle->created_at->between($ultima24,$ultima48))
            <tr>
              <td>
                <small>
                  {{$detalle->cantidad.' '}}
                  @if($detalle->divisionProducto->unidad==null)
                    {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                  @else
                    {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                  @endif
                </small>
                &nbsp;
                <b class="">{{$detalle->divisionProducto->producto->nombre}}</b>
              </td>
              <td>
                <center>
									<div class="btn-group">
										@if ($ingreso->estado == 2 || Auth::user()->tipoUsuario != "Recepción")
											<button type="button" class="btn btn-light btn-sm" disabled><i class="fa fa-ban"></i></button>
										@else
											@if (!$detalle->estado)
												<button class="btn btn-sm btn-success" title="Confirmar" onclick={{"accion24(2,".$detalle->id.")"}}><i class="fa fa-check" ></i></button>
											@endif
											<button class="btn btn-sm btn-danger" title="Eliminar" onclick={{"accion24(0,".$detalle->id.")"}}><i class="fa fa-times" ></i></button>
										@endif
									</div>
                </center>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <div class="flex-row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningun medicamento al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.productos')
@include('Ingresos.dashboard.modales.ver_productos')