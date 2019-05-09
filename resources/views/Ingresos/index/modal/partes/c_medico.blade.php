<div class="flex-row">
	<center>
		<h4>Médicos</h4>
		<hr>
	</center>
</div>
<div style="height: 300px; overflow-x:hidden; overflow-y:scroll" id="body-m">
	@foreach ($medicos as $medico)
		<div class="row">
			<div class="col-10">
				<h6>
					{{(($medico->sexo)?'Dr. ':'Dra. ').$medico->apellido.', '.$medico->nombre}}
					<span class="badge border border-success text-success badge-light badge-pill" id="price_m">
						{{'$ '.number_format($medico->servicio->precio + $medico->servicio->retencion,2,'.',',')}}
					</span>
				</h6>
				<div class="row ml-1">
					@if (count($medico->union) > 0)
						@foreach ($medico->union as $union)
							@if ($union->principal)
								<span class="badge badge-success">
									{{$union->especialidad->nombre}}
								</span>
							@else
								<span class="badge badge-primary ml-1">
									{{$union->especialidad->nombre}}
								</span>
							@endif
							
						@endforeach
					@else
						<span class="badge badge-secondary">Médico General</span>
					@endif
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2">
						<input type="number" name="c_cantidad_m" id="c_cantidad_m" class="form-control form-control-sm" min="0" step="1" value="0">
					</div>
				</div>
			</div>
		</div>
		<hr>
	@endforeach
</div>