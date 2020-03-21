<div class="row">
	<div class="col-12">
		<div class="x_panel m_panel">
			<div class="flex-row">
				<center>
					<h4 class="text-danger">
						<i class="fas fa-prescription"></i>
						Tratamiento
					</h4>
				</center>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-6">
		<div class="x_panel m_panel">
			<div class="flex-row">
				<center>
					<h5>Buscar Receta</h5>
				</center>
			</div>
			<div class="flex-row">
				<div class="form-group col-sm-12">
					<label class="" for="nombre_receta_buscar">Nombre de la receta *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-search"></i></div>
						</div>
						<input type="text" class="form-control form-control-sm" placeholder="Nombre de la receta a buscar" id="nombre_receta_buscar">
					</div>
				</div>
			</div>
		</div>
		<div class="x_panel m_panel" style="height: 302px;">
			<div class="flex-row">
				<center>
					<h5>Resultados</h5>
				</center>
			</div>
			<div id="resultado_buscar_receta" style="height:252px; overflow-x:hidden; overflow-y: scroll;">
				<div class="col-12">
					<div class="flex-row">
						<center>
							Dígite el nombre de la receta a buscar en el campo de texto.
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6">
		<div class="x_panel m_panel" style="height: 440px">
			<div class="flex-row">
				<center>
					<h5 id="nombre_receta_a_buscar"></h5>
				</center>
			</div>
			<div class="row" id="texto_receta_buscar" style="overflow-x: hidden; overflow-y: scroll; height: 355px">
				<div class="col-12">
					<div class="flex-row">
						<center>
							Seleccione un resultado para poder visualizarlo.
						</center>
					</div>
				</div>
			</div>
			<div class="flex-row">
				<center>
					<button type="button" class="btn btn-sm btn-primary" id="copy_receta" style="display: none">Copiar</button>
				</center>
			</div>
		</div>
	</div>
</div>
<div class="m_panel x_panel bg-transparent" style="border:0px !important">
	<center>
		<button type="button" class="btn-sm btn-primary btn col-2" id="nuevo_receta_btn">Nuevo</button>
		<button type="button" class="btn btn-light col-2 btn-sm" data-dismiss="modal">Cerrar</button>
	</center>
</div>