<div class="flex-row">
	<center>
		<h4>Ingreso</h4>
		<hr>
	</center>
</div>
<div class="flex-row">
	<center>
		<h6>Tipo de Ingreso</h6>
	</center>
</div>
<div class="flex-row">
	<div id="radioBtn" class="btn-group col-12">
		<a class="btn btn-primary btn-sm active col-4" data-toggle="tipo" data-title="1">Hospitalización</a>
		<a class="btn btn-primary btn-sm notActive col-4" data-toggle="tipo" data-title="0">Observación</a>
		<a class="btn btn-primary btn-sm notActive col-4" data-toggle="tipo" data-title="2">Medio Ingreso</a>
	</div>
	<input type="hidden" name="tipo" id="tipo" value="1">
</div>
<br>
<div class="flex-row">
	<center>
		<h6>Habitación y Cama</h6>
	</center>
</div>
<div class="row">
	<div class="form-group col-6">
		<label class="" for="cantidad_resultado">Habitación</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-cubes"></i></div>
			</div>
			<select name="habitacion" id="c_habitacion" class="form-control form-control-sm">

			</select>
		</div>
	</div>

	<div class="form-group col-6">
		<label class="" for="cantidad_resultado">Cama</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-cubes"></i></div>
			</div>
			<select name="cama" id="c_cama" class="form-control form-control-sm">

			</select>
		</div>
	</div>
</div>

<div id="tiempo_de_hospitalizacion">
	<div class="flex-row">
		<center>
			<h6>Tiempo de Hospitalización</h6>
		</center>
	</div>
	
	<div class="row">
		<div class="form-group col-6">
			<label class="" for="cantidad_resultado">Cantidad</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-cubes"></i></div>
				</div>
				<input type="number" name="c_cantidad" id="c_cantidad" class="form-control form-control-sm" min="1" step="1" value="1">
			</div>
		</div>
	
		<div class="form-group col-6">
			<label class="" for="cantidad_resultado">Tiempo</label>
			<div class="input-group mb-2 mr-sm-2">
				<h5 id="c_tiempo">Día</h5>
			</div>
		</div>
	</div>
</div>
