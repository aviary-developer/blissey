{{--  MODAL INICIO--}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
  <div class="modal-dialog modal-lg">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					<i class="fas fa-search"></i>
					Buscar
				</h4>
			</center>
		</div>

		<div class="x_panel m_panel">
			<div class="form-group col-sm-8">
				<label class="" for="seccion_select">Producto *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-search"></i></div>
					</div>
					{!! Form::text('resultadoRequisicion',null,['id'=>'resultadoRequisicion','class'=>'form-control form-control-sm','placeholder'=>'Buscar','autocomplete'=>'off']) !!}
				</div>
			</div>
			<div class="form-group col-sm-4">
				<label class="" for="seccion_select">Cantidad *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-cubes"></i></div>
					</div>
					{!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control form-control-sm','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
				</div>
			</div>
		</div>

		<div class="x_panel m_panel">
			<div class="flex-row">
				<center>
					<h5>Resultado de la Búsqueda</h5>
				</center>
			</div>
			<table class="table table-sm table-hover table-striped" id="tablaRequisicion">
				<thead>
				</thead>
			</table>
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" class="btn btn-light btn-sm col-4" data-dismiss="modal" onclick="limpiarTablaVenta()">Cerrar</button>
			</center>
		</div>
  </div>
</div>
  {{-- MODAL FINAL --}}
