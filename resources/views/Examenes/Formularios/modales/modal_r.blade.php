<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal3">
	  <div class="modal-dialog">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Reactivo
					<span class="badge badge-danger">Nuevo</span>
				</h4>
			</center>
		</div>

		<div class="x_panel m_panel">
			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Nombre *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					{!! Form::text(
						'nombre',
						null,
						['id'=>'nombreReactivoModal',
						'class'=>'form-control form-control-sm',
						'placeholder'=>'Nombre del reactivo']) !!}
				</div>
			</div>

			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Fecha de vencimiento *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					@php
						$ahora = Carbon\Carbon::now();
					@endphp
					{!! Form::date(
						'fechaVencimiento',
						$fecha,
						['min'=>$ahora->addDay(1)->format('Y-m-d'),
						'id'=>'fechaVencimientoReactivoModal',
						'class'=>'form-control form-control-sm']) !!}
				</div>
			</div>

			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Contenido por envase *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					{!! Form::number(
						'contenidoPorEnvase',
						null,
						['min'=>1,
						'id'=>'contenidoReactivoModal',
						'class'=>'form-control form-control-sm',
						'placeholder'=>'Contenido en ml']) !!}
				</div>
			</div>
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" id="guardarReactivoModal" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
			</center>
		</div>

  </div>
</div>
<script>
	$("#guardarReactivoModal").click(async function(e){
		var v_nombre = $("#nombreReactivoModal").val();
		var fechaVencimiento = $("#fechaVencimientoReactivoModal").val();
		var contenido = $("#contenidoReactivoModal").val();

		var valido = new Validated('nombreReactivoModal');
		valido.required();
		bandera = valido.value(true);

		var valido = new Validated('fechaVencimientoReactivoModal');
		valido.required();
		bandera = valido.value(bandera);

		var valido = new Validated('contenidoReactivoModal');
		valido.required();
		bandera = valido.value(bandera);

		if(bandera){
			await $.ajax({
				url: $('#guardarruta').val() + "/ingresoReactivo",
				type: 'POST',
				data: {
					nombre: v_nombre,
					fechaVencimiento: fechaVencimiento,
					contenidoPorEnvase: contenido
				},
				success: function () {
					swal({
						type: 'success',
						toast: true,
						title: '¡Acción exitosa!',
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});
				}
			});
	
			rellenarReactivo();
			$("#nombreReactivoModal").val("");
			$("#descripcionReactivoModal").val("");
			$("#contenidoReactivoModal").val("");
			$("#modal3").modal('hide');
		}
	});

function rellenarReactivo(){
  var reactivos = $("#reactivo_select");
  var ruta=$('#guardarruta').val() + "/llenarReactivosExamenes";
  $.get(ruta,function(res){
    reactivos.empty();
    $(res).each(function(key,value){
      reactivos.append("<option value='"+value.id+"'>"+value.nombre+"</option>");
    });
  });
}
</script>
