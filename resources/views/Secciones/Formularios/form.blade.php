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
				'nombre',
				null,
				['id'=>'nombreSeccionModal',
				'class'=>'form-control form-control-sm',
				'placeholder'=>'Nombre del tipo de sección']) !!}
		</div>
	</div>
</div>

<div class="x_panel">
  <center>
    <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/secciones') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>

<script>
  $("#save_me").click(function(){
    var valido = new Validated('nombreSeccionModal');
    valido.required();
    is_valid = valido.value(true);

    if(is_valid){
      $('#form').submit();
    }
  });
</script>
