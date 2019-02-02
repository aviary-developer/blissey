@php
setlocale(LC_ALL,'es');
$detalles=$transaccion->detalleTransaccion;
@endphp

@foreach ($detalles as $detalle)
	<div class="x_panel">
		<div class="col-sm-4">
			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					Producto
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					<i class="fas fa-prescription-bottle-alt"></i>
					{{$detalle->divisionProducto->producto->nombre}}
				</h6>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					División
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					<i class="fas fa-cubes"></i>
					@if($detalle->divisionProducto->unidad==null)
						{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
					@else
						{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
					@endif
				</h6>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="flex-row">
				<span class="font-weight-light text-monospace">
					Código de barras
				</span>
			</div>
			<div class="flex-row">
				<h6 class="font-weight-bold">
					<i class="fas fa-barcode"></i>
					{{$detalle->divisionProducto->codigo}}
				</h6>
			</div>
		</div>
		<table class="table table-striped table-hover table-sm">
			<thead>
				<th>Cantidad</th>
				<th>Fecha de vencimiento</th>
				<th>Lote</th>
				<th>Estante</th>
				<th>Nivel</th>
			</thead>
			<tbody>
					@php
	
					$inventario=App\DivisionProducto::inventario($detalle->f_producto,1);
						$compras=App\DivisionProducto::compras($detalle->f_producto,1);
						$cuenta=0;
						$i=0;
						$ultimos=[];
						foreach ($compras as $compra) {
							$devoluciones=App\DetalleDevolucion::total($compra->id);
							$retirados=App\CambioProducto::total($compra->id);
							$diferencia=$compra->cantidad-$devoluciones-$retirados;
							if ($diferencia>0) {
								$cuenta=$cuenta+$diferencia;
								$compra->cantidad=$diferencia;
								$ultimos[$i]=$compra;
								if($cuenta>=$inventario)
								break;
								$i++;
							}
						}
						$diferencia=$cuenta-$inventario;
						if($diferencia!=0  && isset($ultimos[$i])){
							if($ultimos!=null){
								$fila=$ultimos[$i];
								$fila->cantidad=$fila->cantidad-$diferencia;
								$ultimos[$i]=$fila;
							}
						}
						$regresivo=$detalle->cantidad;
						for ($b=$i; $b>=0 ; $b--) {
							$fila=$ultimos[$b];
							$inv=App\DetalleTransacion::find($fila->id);
							if($fila->cantidad<$regresivo){
							@endphp
							<tr>
								<td>
									{{$fila->cantidad}}
								</td>
								<td>{{$inv->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
								<td>{{$fila->lote}}</td>
								<td>{{$fila->f_estante}}</td>
								<td>{{$fila->nivel}}</td>
							</tr>
							@php
							$regresivo=$regresivo-$fila->cantidad;
						}elseif($regresivo!=0){
							@endphp
							<tr>
								<td>
									{{$regresivo}}
								</td>
								<td>{{$inv->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
								<td>{{$fila->lote}}</td>
								<td>{{App\Estante::find($fila->f_estante)->codigo}}</td>
								<td>{{$fila->nivel}}</td>
							</tr>
							@php
							$regresivo=0;
						}
						}
					@endphp
			</tbody>
		</table>
	</div>
@endforeach

<div class="x_panel">
	<div class="flex-row">
		<center>
			<a href={!! asset('/atenderPeticion/'.$transaccion->id) !!} class="btn btn-primary btn-sm">Confirmar</a>
		</center>
	</div>
</div>