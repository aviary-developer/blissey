<div class="flex-row">
	<center>
		<h4>Laboratorio clínico</h4>
		<hr>
	</center>
</div>
<div class="row">
	<div class="col-10">
		<div class="row">
			<div class="form-group col-12">
				<label class="" for="area">Área</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-cubes"></i></div>
					</div>
					<select name="area" id="c_area" class="form-control form-control-sm">
						<option value="BACTERIOLOGIA">Bacteriología</option>
						<option value="EXAMENES DE ORINA">Uroanálisis</option>
						<option value="EXAMENES DE HECES">Coprología</option>
						<option value="HEMATOLOGIA">Hematología</option>
						<option value="QUIMICA SANGUINEA">Química sanguínea</option>
						<option value="INMUNOLOGIA">Inmunología</option>
						<option value="ENZIMAS">Enzimas</option>
						<option value="PRUEBAS ESPECIALES">Pruebas especiales</option>
						<option value="OTROS">Otros</option>
					</select>
				</div>
			</div>
		</div>
		<div id="panel_ver_examenes">
			@php
					$areas = [
						'BACTERIOLOGIA',
						'EXAMENES DE ORINA',
						'EXAMENES DE HECES',
						'HEMATOLOGIA',
						'QUIMICA SANGUINEA',
						'INMUNOLOGIA',
						'ENZIMAS',
						'PRUEBAS ESPECIALES',
						'OTROS'
						];
			@endphp
			@foreach ($areas as $k => $area)
				@php
					if($k == 0){
						$estilo ="display:block; height:250px; overflow-y:scroll; overflow-x:hidden";
					}else{
						$estilo ="display:none; height:250px; overflow-y:scroll; overflow-x:hidden";
					}
					$id_div = str_replace(' ','_',$area);
					$count_examenes_area = $examenes->where('area',$area)->count();
				@endphp
				<div id="{{$id_div}}" style="{{$estilo}}" class="div_area">
					<div class="flex-row">
						<center>
							<h5 class="text-secondary">{{$area}}</h5>
						</center>
					</div>
					@if ($count_examenes_area == 0)
					<div class="flex-row">
						<center>
							<i>No se encontró ningun <b>examen clínico</b> guardado en esta área</i>
						</center>
					</div>
					@else
						@foreach ($examenes->where('area',$area) as $examen)	
							<div class="row">
								<div class="col-9">
									<h6>
										{{$examen->nombreExamen}}
										<span class="badge border border-success text-success badge-light badge-pill" id="price_m">
											{{'$ '.number_format($examen->servicio->precio,2,'.',',')}}
										</span>
									</h6>
								</div>
								<div class="col-3">
									<div class="form-group">
										<div class="input-group mb-2 mr-sm-2">
											<input type="number" name="c_cantidad_examen" id="c_cantidad_examen" class="form-control form-control-sm" min="0" step="1" value="0">
										</div>
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			@endforeach
		</div>
	</div>
	<div class="col-2" id="count_column">
		@foreach ($areas as $k => $area)
			@php
				if($k == 0){
					$estilo ="badge badge-dark col-12 font-sm my-1 contadores";
				}else{
					$estilo ="badge badge-primary col-12 font-sm my-1 contadores";
				}
				$id_div = str_replace(' ','_',$area);
			@endphp
			<span class="{{$estilo}}" id="{{'c_'.$id_div}}">
				0
			</span>
		@endforeach
	</div>
</div>