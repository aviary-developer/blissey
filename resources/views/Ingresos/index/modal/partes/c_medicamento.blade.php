<div class="flex-row">
	<center>
		<h4>Medicamentos</h4>
		<hr>
	</center>
</div>
<div class="row">
	<div class="form-group col-4">
		<label class="" for="cantidad_resultado">Cantidad</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-cubes"></i></div>
			</div>
			<input type="number" name="" id="c_cantidad_medicamento" class="form-control form-control-sm" value="1" step="1" min="1">
		</div>
	</div>

	<div class="form-group col-8">
		<label class="" for="cantidad_resultado">Nombre o Código</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-search"></i></div>
			</div>
			<input type="text" class="form-control form-control-sm" id="c_nombre_medicamento">
		</div>
	</div>
</div>
<div id="panel_ver_medicamentos">
	<div class="flex-row">
		<center>
			<h5 class="text-secondary">Medicamentos agregados</h5>
		</center>
	</div>
	<div class="flex-row" id="subpanel_ver_medicamentos" style="height:218px; overflow-x:hidden; overflow-y:scroll;">
		<center>
			<h6 class="font-weight-bold" style="margin-top: 50px;">¡Vacío!</h6>
			No se ha agregado ningún medicamento a la calculadora.
		</center>
	</div>
</div>
<div id="panel_buscar_medicamentos" style="display:none">
	<div class="flex-row">
		<center>
			<h5 class="text-secondary">Resultado de la búsqueda</h5>
		</center>
	</div> 
	<div class="flex-row" style="height:218px; overflow-x:hidden; overflow-y:scroll;">
		<table class="table table-sm" id="table_buscar_medicamentos">
		</table>
	</div>
</div>