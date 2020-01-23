<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal1">
  <div class="modal-dialog modal-lg">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Sección
					<span class="badge badge-danger">Agregar</span>
				</h4>
			</center>
		</div>

		<div class="x_panel m_panel">
			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Tipo de sección *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-tint"></i></div>
					</div>
					<select class="form-control form-control-sm" id="seccion_select" >
						@foreach ($secciones as $seccion)
							<option value={{$seccion->id}}>
								{{ $seccion->nombre}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="x_panel m_panel" style="height:295px;">
					<div class="form-group col-sm-12">
						<label class="" for="parametro_select">Parámetro *</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-tint"></i></div>
							</div>
							<select class="form-control form-control-sm" id="parametro_select" >
								@foreach ($parametros as $parametro)
									<option value={{$parametro->id}}>
										{{ $parametro->nombreParametro}}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<center>
							<label>
								<input type="checkbox" name="checkReactivo" id="checkReactivo" onClick="chekearReactivo(this,0);" class="js-switch" unchecked /> Añadir reactivo
							</label>
						</center>
					</div>

					<div class="form-group col-sm-12" id="divReactivo0" style="display:none">
						<label class="" for="parametro_select">Parámetro *</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-tint"></i></div>
							</div>
							<select class='form-control form-control-sm' id="reactivo_select">
								@foreach ($reactivos as $reactivo)
									<option value={{$reactivo->id}}>
										{{ $reactivo->nombre}}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="ln_solid"></div>
					<center>
						<button type="button" class="btn btn-sm btn-primary" id="agregar_parametro_x">
							Agregar
							<i class="fa fa-arrow-right"></i>
						</button>
					</center>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="x_panel m_panel" style="height:295px; width: 100%">
					<div class="flex-row">
						<center>
							<h5>Parámetros agregados</h5>
						</center>
					</div>
					<div style="overflow-x:hidden; overflow-y:scroll; height:225px; width:100%">
	
						<table class="table table-hover table-striped table-sm" id="tabla_parametros">
							<thead>
								<th>Parámetro</th>
								<th>Reactivo</th>
								<th style="width: 80px">Opción</th>
							</thead>
							<tbody>
	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" class="btn btn-sm btn-primary disabled col-2" id="listo_x">¡Listo!</button>
        <button type="button" class="btn btn-sm btn-light col-2" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
			</center>
		</div>

  </div>
</div>