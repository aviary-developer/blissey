<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>

<div class="x_panel">
	<div class="form-group col-sm-12">
		<label class="" for="seccion_select">Nombre *</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
			</div>
			{!! Form::text(
				'nombreParametro',
				null,
				['id'=>'nombreParametro',
				'class'=>'form-control form-control-sm',
				'placeholder'=>'Nombre del parámetro']) !!}
		</div>
	</div>

	<div class="form-group">
		<center>
			<div class="">
				<label>
					<input type="checkbox"name="checkValores" id="checkValores" class="js-switch" unchecked /> Información avanzada
				</label>
			</div>
		</center>
	</div>
	
	<div id="divValoresNormales" style="display:none;">
		<div class="form-group col-sm-12">
			<label class="" for="seccion_select">Unidad de medida</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-weight"></i></div>
				</div>
				<select class="form-control form-control-sm" id="selectUnidadParametro" name="unidad">
					@if ($create)
						<option value=""></option>
						@foreach ($unidades as $unidad)
							<option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
						@endforeach
					@else
						@if ($parametros->unidad == null)
							<option value="" selected></option>
						@else
							<option value=""></option>
						@endif
						@foreach ($unidades as $unidad)
							@if ($parametros->unidad == $unidad->id)	
								<option value={{ $unidad->id }} selected>{{ $unidad->nombre }}</option>
							@else
								<option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
							@endif
						@endforeach
					@endif
				</select>
			</div>
		</div>

		<div class="flex-row">
			<div class="col-sm-1"></div>
			<span class="badge font-sm border border-primary text-primary col-sm-4">Masculino</span>
			<div class="col-sm-2"></div>
			<span class="badge font-sm border border-pink text-pink col-sm-4">Femenino</span>
		</div>

		<div class="form-group col-sm-6">
			<label class="" for="seccion_select">Valor mínimo</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-minus-square text-primary"></i></div>
				</div>
				{!! Form::number(
					'valorMinimo',
					null,
					['id'=>'valorMinimo',
					'class'=>'form-control form-control-sm',
					'placeholder'=>'0',
					'step'=>'any']) !!}
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="" for="seccion_select">Valor mínimo</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-minus-square text-pink"></i></div>
				</div>
				{!! Form::number(
					'valorMinimoFemenino',
					null,
					['id'=>'valorMinimoFemenino',
					'class'=>'form-control form-control-sm',
					'placeholder'=>'0',
					'step'=>'any']) !!}
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="" for="seccion_select">Valor máximo</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-plus-square text-primary"></i></div>
				</div>
				{!! Form::number(
					'valorMaximo',
					null,
					['id'=>'valorMaximo',
					'class'=>'form-control form-control-sm',
					'placeholder'=>'0',
					'step'=>'any']) !!}
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="" for="seccion_select">Valor máximo</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-plus-square text-pink"></i></div>
				</div>
				{!! Form::number(
					'valorMaximoFemenino',
					null,[
						'id'=>'valorMaximoFemenino',
						'class'=>'form-control form-control-sm',
						'placeholder'=>'0',
						'step'=>'any']) !!}
			</div>
		</div>

	</div>

	<div class="form-group col-sm-12">
		<label class="" for="seccion_select">Valor predeterminado</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
			</div>
			{!! Form::text(
				'valorPredeterminado',
				null,
				['id'=>'valorPredeterminado',
				'class'=>'form-control form-control-sm',
				'placeholder'=>'Valor predeterminado']) !!}
		</div>
	</div>
</div>

<div class="x_panel">
  <center>
    <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/parametros') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>

<script>
  $("#save_me").click(function(){
    var valido = new Validated('nombreParametro');
    valido.required();
    is_valid = valido.value(true);

    if(is_valid){
      $('#form').submit();
    }
  });
</script>