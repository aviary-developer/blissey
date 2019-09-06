<div class="flex-row">
	<center>
		<h4>Rayos X</h4>
		<hr>
	</center>
</div>
<div style="height: 300px; overflow-x:hidden; overflow-y:scroll" id="body-rayo">
	@foreach ($rayosx as $rayo)
		<div class="row">
			<div class="col-10">
				<h6>
					{{$rayo->nombre}}
					<span class="badge border border-success text-success badge-light badge-pill" id="price_m">
						{{'$ '.number_format($rayo->servicio->precio,2,'.',',')}}
					</span>
				</h6>
			</div>
			<div class="col-2">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2">
						<input type="number" name="c_cantidad_rayo" id="c_cantidad_rayo" class="form-control form-control-sm" min="0" step="1" value="0">
					</div>
				</div>
			</div>
		</div>
		<hr class="my-1">
	@endforeach
</div>