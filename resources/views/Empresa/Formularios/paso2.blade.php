<div style="height: 350px;">
	<div class="flex-row">
		<center>
			<h5>Datos de Laboratorio Clínico</h5>
		</center>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
      <label class="" for="nombre">Código *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
        </div>
        {!! Form::text('codigo_laboratorio',null,['class'=>'form-control form-control-sm','placeholder'=>'Código del laboratorio']) !!}
      </div>
		</div>
		<div class="form-group">
      <label class="" for="nombre">Nombre *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
        </div>
        {!! Form::text('nombre_laboratorio',null,['class'=>'form-control form-control-sm','placeholder'=>'Nombre del laboratorio']) !!}
      </div>
		</div>
		<div class="form-group">
      <label class="" for="nombre">Correo electrónico*</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-envelope"></i></div>
        </div>
        {!! Form::email('correo_laboratorio',null,['class'=>'form-control form-control-sm','placeholder'=>'Dirección de correo electronico']) !!}
      </div>
		</div>
		<div class="form-group">
      <label class="" for="nombre">Télefono*</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-phone"></i></div>
        </div>
        {!! Form::text('telefono_laboratorio_input',null,['id'=>'telefono_laboratorio','class'=>'form-control form-control-sm','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
          <span class="input-group-btn">
            <button type="button" name="button" class="btn btn-primary btn-sm" id="agregar_telefono_laboratorio">
              <i class="fa fa-save"></i>
            </button>
          </span>
      </div>
		</div>
		<div class="form-group">
      <label class="" for="nombre">Dirección*</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
        </div>
        {!! Form::textarea('direccion_laboratorio',null,['class'=>'form-control form-control-sm','placeholder'=>'Dirección del laboratorio','rows'=>'2'])
				!!}
      </div>
		</div>
	</div>
	<div class="col-sm-6">
	<table class="table table-sm table-hover" id='tabla_telefono_laboratorio'>
      <thead>
        <th>Teléfono</th>
        <th style="width : 80px">Opción</th>
      </thead>
      <tbody>
        @if (!$create)
          @foreach ($telefonos as $key => $telefono)
						@if($telefono->tipo == 'laboratorio')								
							<tr>
								<td>{{$telefono->telefono}}</td>
								<td>
									<input type="hidden" id={{"telefono".$key}} value={{ $telefono->id }}>
									<button type="button" name="button" class="btn btn-danger btn-sm" id="eliminar_telefono_antiguo">
										<i class="fa fa-times"></i>
									</button>
								</td>
							</tr>
						@endif
        	@endforeach
      	@endif
    	</tbody>
  	</table>
	</div>
</div>