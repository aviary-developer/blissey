<div class="x_panel">
  <div class="form-group">
    <label class="" for="nombre">Nombre *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
      </div>
      {!! Form::text('nombre',null,['class'=>'form-control form-control-sm','placeholder'=>'Nombre del servicio','id'=>'campo1']) !!}
    </div>
	</div>
	
	<div class="form-group">
    <label class="" for="nombre">Precio *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-money-bill-alt"></i></div>
      </div>
      {!! Form::number('precio',null,['class'=>'form-control form-control-sm','placeholder'=>'0.00','min'=>'0.00','step'=>'0.05','id'=>'campo2']) !!}
    </div>
	</div>
	
	<div class="form-group">
    <label class="" for="nombre">Categoría de servicio *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
      </div>
      <select class="form-control form-control-sm" name="f_categoria" id="campo3">
				@foreach ($categorias as $categoria)
					@if ($categoria->nombre != "Cama" && $categoria->nombre != "Laboratorio Clínico" && $categoria->nombre != "Ultrasonografía" && $categoria->nombre != "TAC" && $categoria->nombre != "Honorarios" && $categoria->nombre != "Rayos X")	
						@if ($create)
							<option value={{ $categoria->id }}>{{ $categoria->nombre }}</option>
						@else
							@if ($servicios->f_categoria == $categoria->id)
								<option value={{ $categoria->id }} selected>{{ $categoria->nombre }}</option>
							@else
								<option value={{ $categoria->id }}>{{ $categoria->nombre }}</option>
							@endif
						@endif
					@endif
        @endforeach
      </select>
    </div>
  </div>
</div>
@if($create==true)
<div class="x_panel">
  <center>
  <div class="btn-group">
    <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-success btn-sm" title="Buscar">
      <i class="fa fa-search"></i>
    </button>
</div>
  </center>
</div>
@endif
<div class="x_panel">
  <center>
    <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/servicios') !!} class="btn btn-light btn-sm">Cancelar</a>
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
		
		var valido = new Validated('campo3');
    valido.required();
    is_valid = valido.value(is_valid);

    if(is_valid){
      $('#form').submit();
    }
  });
</script>
