<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="paquete_m" data-backdrop="static">
  <div class="modal-dialog">
    <div class="x_panel m_panel text-danger">
      <center>
        <h4 class="mb-1">
          <i class="fas fa-plus"></i>
          Paquete hospitalario
        </h4>
      </center>
    </div>

    <div class="m_panel x_panel">
      <div class="form-group col-sm-12">
				<label class="" for="altura">Paquete hospitalario</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					<select name="paquete" id="tipo_paquete" class="form-control form-control-sm">
						@foreach ($paquetes_hospitalarios as $pac)
								@if ($ingreso->tipo == 0 &&$pac->nombre == "Ingreso")
									<option value="{{$pac->id}}" selected>{{$pac->nombre}}</option>
								@elseif ($ingreso->tipo == 1 &&$pac->nombre == "Medio ingreso")
									<option value="{{$pac->id}}" selected>{{$pac->nombre}}</option>
								@elseif ($ingreso->tipo == 2 &&$pac->nombre == "Observación")
									<option value="{{$pac->id}}" selected>{{$pac->nombre}}</option>
								@else
									<option value="{{$pac->id}}">{{$pac->nombre}}</option>
								@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="" for="altura">Precio</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					<input type="number" step="0.01" min="0" class="form-control form-control-sm" placeholder="Precio del paquete" id="precio_paquete">
				</div>
			</div>
			<input type="hidden" id="id_paquete">
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-primary btn-sm col-2" id="paquete_save">Guardar</button>
      <button type="button" class="btn btn-sm btn-light col-2" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>