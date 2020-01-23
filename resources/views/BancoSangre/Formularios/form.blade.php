<div class="col-sm-12">
	<div class="alert alert-danger" id="mout">
		<center>
			<p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
		</center>
	</div>
</div>

<div class="col-sm-6">
	<div class="x_panel">
		<div class="form-group">
		<label class="" for="nombre">Tipo de sangre *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-tint"></i></div>
				</div>
				<select class="form-control form-control-sm" name="tipoSangre" id="campo1">
					@if ($create)
					<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
					@else
						<option value="A+" {{($tipeo ==='A+') ? 'selected' : ''}}>A+</option>
						<option value="A-" {{($tipeo ==='A-') ? 'selected' : ''}}>A-</option>
						<option value="B+" {{($tipeo ==='B+') ? 'selected' : ''}}>B+</option>
						<option value="B-" {{($tipeo ==='B-') ? 'selected' : ''}}>B-</option>
						<option value="AB+" {{($tipeo ==='AB+') ? 'selected' : ''}}>AB+</option>
						<option value="AB-" {{($tipeo ==='AB-') ? 'selected' : ''}}>AB-</option>
						<option value="O+" {{($tipeo ==='O+') ? 'selected' : ''}}>O+</option>
						<option value="O-" {{($tipeo ==='O-') ? 'selected' : ''}}>O-</option>
					@endif
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="" for="nombre">Prueba cruzada *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="custom-file input-group">
					<input type="file" name="pruebaCruzada" class="custom-file-input" id="pruebaCruzada" lang="es" required>
					<label class="form-control-sm custom-file-label " for="customFileLang">Seleccionar Archivo</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="" for="nombre">Fecha de vencimiento *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-calendar"></i></div>
				</div>
				@php
          $ahora = Carbon\Carbon::now();
        @endphp
        {!! Form::date('fechaVencimiento',$fecha,['id'=>'campo3','min'=>$ahora->addDay(1)->format('Y-m-d'),'class'=>'form-control form-control-sm']) !!}
			</div>
		</div>
	</div>

	<div class="x_panel">
		<center>
			<button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
			<button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
			<a href={!! asset('/bancosangre') !!} class="btn btn-light btn-sm">Cancelar</a>
		</center>
	</div>
</div>
<div class="col-sm-6">
	<div class="x_panel">
		<center>
      <output id="listPC" style="height:400px">
        @if ($create)
          <img src={{asset(Storage::url('noImgen.jpg'))}} style="height: 400px; width: 400px; object-fit: scale-down">
        @else
          <img src={{asset(Storage::url($donacion->pruebaCruzada))}} style="height: 400px; width: 400px; object-fit: scale-down">
        @endif
      </output>
    </center>
	</div>
</div>
<input type="hidden" id="tipo" value={{$create}}>

<script>
	var cambio_ = false;

	$("#save_me").click(function(){
		var tipo = $("#tipo").val();
    var valido = new Validated('campo1');
    valido.required();
		is_valid = valido.value(true);

		var valido = new Validated('pruebaCruzada');
    valido.required();
    is_valid = valido.value(is_valid);

		var valido = new Validated('campo3');
    valido.required();
    is_valid = valido.value(is_valid);

    if(is_valid && (cambio_ || !tipo)){
      $('#form').submit();
    }
	});

function pruebaCruzada(evt){
	cambio_ = true;
  var files = evt.target.files;

  for(var i = 0, f; f = files[i]; i++){
    if(!f.type.match('image.*')){
      continue;
    }

    var reader = new FileReader();

    reader.onload = (function(theFile){
      return function(e){
        document.getElementById('listPC').innerHTML = ['<img style="height: 400px; width: 400px; object-fit: scale-down" src = "', e.target.result,'"/>'].join('');
      };
    })(f);
    reader.readAsDataURL(f);
  }
}
document.getElementById('pruebaCruzada').addEventListener('change', pruebaCruzada, false);
</script>
