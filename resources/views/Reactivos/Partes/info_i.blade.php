<table class="table table-striped table-sm table-hover" id="index-table">
	<thead>
		<th>Fecha</th>
		<th>Descripción</th>
		<th>Anterior</th>
		<th>Movimiento</th>
		<th>Posterior</th>
	</thead>
	<tbody>
		@if ($movimientos->count() > 0)
			@foreach ($movimientos as $key => $movimiento)
			<tr>
				<td>{{$movimiento->created_at->formatLocalized('%d/%m/%Y  %H:%M:%S')}}</td>
				<td>{{$movimiento->descripcionExistencias}}</td>
				<td align="right">{{$movimiento->anterior}}</td>
				<td align="right">{{$movimiento->movimiento}}</td>
				<td align="right">{{$movimiento->posterior}}</td>
			</tr>
			@endforeach
		@else
			<tr>
				<td colspan="5">
					<center>
						No se ha realizado ningun movimiento de este reactivo
					</center>
				</td>
			</tr>
		@endif
	</tbody>
</table>