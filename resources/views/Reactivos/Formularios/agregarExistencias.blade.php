<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalExistencias">
  <div class="modal-dialog">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Existencia de Reactivos
					<span class="badge badge-danger">Editar</span>
				</h4>
			</center>
		</div>

		<div class="x_panel m_panel">
			<div class="alert alert-warning alert-dismissible" role="alert">
				<center>
					Actualmente tiene: <strong><span id="spanExistenciasActuales"></span> <span id="spanNomReac"></span> en existencias</strong>
				</center>
			</div>
									
			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Cantidad *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					{!! Form::number(
						'cantidadExistencias',
						null,['id'=>'cantidadExistencias',
						'class'=>'form-control form-control-sm',
						'placeholder'=>'0']) !!}
				</div>
			</div>

			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Descripción	</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					{!! Form::textarea('descripcionExistencias',null,['id'=>'descripcionExistencias','class'=>'form-control form-control-sm','placeholder'=>'Describa el movimiento en la cantidad de reactivos','rows'=>'3']) !!}
				</div>
			</div>
			<input type="hidden" name="idReactivo" id="idReactivo">
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" id="guardarCantidadExistencias" onclick="comprobacionTemporal();" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
			</center>
		</div>

  </div>
</div>
<script>
function botonExistencias(existencias,nombre,id) {
  $("#spanExistenciasActuales").text(existencias.value);
  $("#spanNomReac").text(nombre);
  $("#idReactivo").val(id);
	$("#cerrar_modalExistencias").on('click', function () {
		$("#cantidadExistencias").val("");
	});
}

function comprobacionTemporal(){
  var total;
  var descripcion=$('#descripcionExistencias').val();
  var actual= parseInt($("#spanExistenciasActuales").text());
  var cantidad= parseInt($("#cantidadExistencias").val());
	total=actual+cantidad;
	
	var valido = new Validated('descripcionExistencias');
	valido.required();
	bandera = valido.value(true);

	var valido = new Validated('cantidadExistencias');
	valido.required();
	bandera = valido.value(bandera);

	if(bandera){

		if(Number.isNaN(cantidad)){
			swal({
				type: 'error',
				toast: true,
				title: '¡Error!',
				text: 'Ingrese una cantidad valida',
				showConfirmButton: false,
				timer: 4000
			});
		}else if(total<0){
			swal({
				type: 'error',
				toast: true,
				title: '¡Error!',
				text: 'Cantidad total menor a cero',
				showConfirmButton: false,
				timer: 4000
			});
		}else if(total==0){
			swal({
				title: 'Existencias igual a cero',
				text: '¿Está seguro? ¡No se realizarán exámenes con este reactivo!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Si, ¡Estoy seguro!',
				cancelButtonText: 'No, ¡Cancelar!',
				confirmButtonClass: 'btn btn-warning',
				cancelButtonClass: 'btn btn-light',
				buttonsStyling: false
			}).then((result) => {
				if(result.value){
					guardarExistencias(total);
				}
			});
		}else if(total>0){
			guardarExistencias(total,cantidad);
		}
	}

}
function guardarExistencias(total,cantidad){
  var ruta=$('#guardarruta').val() + "/actualizarExistenciaReactivos";
  var id = $('#idReactivo').val();
  var descripcion = $('#descripcionExistencias').val();
  $.ajax({
    url:ruta,
    type:'POST',
    data: {
      id:id,
      contenidoPorEnvase:total,
      movimiento:cantidad,
      descripcionExistencias:descripcion
    },
    success: function(){
      localStorage.setItem('msg','yes');
      location.reload();
    }
  });
  $("#cantidadExistencias").val("");
}
</script>
