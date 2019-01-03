<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal5">
	<div class="modal-dialog">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Tipo de Sección
					<span class="badge badge-danger">Nueva</span>
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
						['id'=>'nombreSeccionModal',
						'class'=>'form-control form-control-sm',
						'placeholder'=>'Nombre del tipo de sección']) !!}
				</div>
			</div>
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" id="guardarSeccionModal" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
			</center>
		</div>

	</div>
</div>

<script>
	$("#guardarSeccionModal").click(async function(e){
		e.preventDefault();
		var v_nombre = $("#nombreSeccionModal").val();

		var valido = new Validated('nombreSeccionModal');
		valido.required();
		bandera = valido.value(true);

		if(bandera){
			await $.ajax({
				url: $('#guardarruta').val() + "/ingresoSeccion",
				type: 'POST',
				data: {
					nombre: v_nombre,
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

			rellenarSeccion();
			$("#nombreSeccionModal").val("");
			$("#modal5").modal('hide');
		}

	});

	function rellenarSeccion() {
		var secciones = $("#seccion_select");
		var ruta = $('#guardarruta').val() + "/llenarSeccionExamenes";
		$.get(ruta, function (res) {
			secciones.empty();
			$(res).each(function (key, value) {
				secciones.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
			});
		});
	}
</script>
