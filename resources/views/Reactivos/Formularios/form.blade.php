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
				<div class="input-group-text"><i class="fas fa-flask"></i></div>
			</div>
			{!! Form::text('nombre',null,['class'=>'form-control form-control-sm','placeholder'=>'Nombre del reactivo','id'=>'campo1']) !!}
		</div>
	</div>

	<div class="form-group col-sm-12">
		<label class="" for="seccion_select">Fecha de vencimiento*</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-calendar"></i></div>
			</div>
			@php
				$ahora = Carbon\Carbon::now();
			@endphp
			{!! Form::date('fechaVencimiento',$fecha,['min'=>$ahora->addDay(1)->format('Y-m-d'),'class'=>'form-control form-control-sm','id'=>'campo2']) !!}
		</div>
	</div>
@if ($create)
	<div class="form-group col-sm-12">
		<label class="" for="seccion_select">Existencias *</label>
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-cubes"></i></div>
			</div>
			{!! Form::number('contenidoPorEnvase',0,['min'=>0,'class'=>'form-control form-control-sm','placeholder'=>'Existencias en unidades','id'=>'campo3']) !!}
		</div>
	</div>
@endif
</div>

<div class="x_panel">
  <center>
    <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset($ruta) !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>

<script>
  $("#save_me").click(function(){
    var valido = new Validated('campo1');
    valido.required();
		is_valid = valido.value(true);
		
		var valido = new Validated('campo2');
    valido.required();
		is_valid = valido.value(is_valid);
		
    if(is_valid){
      $('#form').submit();
    }
  });
</script>
