<div class="row">
  <div class="col-sm-8">
		<h5 class="text-success">
			Notificaciones
			@if ($lista_paquetes != null && $lista_honorarios != null)
				<span class="badge badge-pill badge-danger font-sm" id="count_notificaciones">
					{{count($lista_paquetes) + count($lista_honorarios)}}
				</span>
			@else
				<span class="badge badge-pill badge-success font-sm" id="count_notificaciones">
					0
				</span>
			@endif
		</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-success" id="nuevo_abono" title="Nuevo Abono"><i class="far fa-money-bill-alt"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#informe_fin" title="Informe financiero"><i class="fa fa-file"></i></button>
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_finanzas" id="btn_v_f" title="Ver"><i class="fa fa-search"></i></button>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-8">
		<div class="row">
			<div style="height:244px; overflow-x:none; overflow-y:scroll; width:100%">
				@include('Ingresos.dashboard.partes.noticias_r')
			</div>
		</div>
	</div>
	<div class="col-4">
		<hr class="my-1">
		<div class="flex-row text-monospace">
			<center><i class="far fa-calendar"></i> Días hospitalizado</center>
		</div>
		<div class="flex-row">
			<center>
				<h4 class="text-secondary">
					@if ($ingreso->tipo != 0)
						{{($horas).(($horas > 1)?' horas':' hora')}}
					@else
						{{($dias).(($dias > 1)?' días':' día')}}
					@endif
				</h4>
			</center>
		</div>
		<hr class="my-1">
		<div class="flex-row text-monospace">
			<center><i class="far fa-money-bill-alt"></i> Total de gastos</center>
		</div>
		<div class="flex-row">
			<center>
				<h4 class="text-secondary" id="total_gastos_label">
					{{'$ '.number_format($total_gastos,2,'.',',')}}
				</h4>
				<input type="hidden" id="total_gastos" value="{{number_format($total_gastos,2,'.','')}}">
			</center>
		</div>
		<hr class="my-1">
		<div class="flex-row text-monospace">
			<center><i class="fa fa-arrow-up text-success"></i> Total abonado</center>
		</div>
		<div class="flex-row">
			<center>
				<h4 class="text-success">
					{{'$ '.number_format($total_abono,2,'.',',')}}
				</h4>
			</center>
		</div>
		<hr class="my-1">
		<div class="flex-row text-monospace">
			<center><i class="fa fa-arrow-down text-danger"></i> Total a pagar</center>
		</div>
		<div class="flex-row">
			<center>
				<h4 class="text-danger" id="total_deuda_label">
					{{'$ '.number_format($total_deuda,2,'.',',')}}
				</h4>
				<input type="hidden" id="total_deuda" value="{{number_format($total_deuda,2,'.','')}}">
			</center>
		</div>
		<hr class="my-1">
	</div>
</div>
@include('Ingresos.dashboard.modales.ver_finanzas')
@include('Ingresos.dashboard.modales.informe_fin')
@include('Ingresos.dashboard.modales.paquete');
@include('Ingresos.dashboard.modales.honorario');