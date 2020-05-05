$(document).ready(function () {
	$("#save_seguimiento_create").click(function () {
		var is_valid = true;
		//Validar nombre
		var valido = new Validated('fecha_seguimiento_create');
		valido.required();
		is_valid = valido.value(is_valid);

		//Validar apellido
		var valido = new Validated('descripcion_seguimiento_create');
		valido.required();
		is_valid = valido.value(is_valid);

		if (is_valid) {
			let data = $("#seguimiento_create_form").serializeArray();
			data.push({ name: 'f_ingreso', value: $("#id").val() });
			$.ajax({
				type: 'post',
				url: $('#guardarruta').val() + '/seguimientos',
				data: data,
				success: function (r) {
					console.log(r);
					if (r) {
						localStorage.setItem('msg', 'yes');
						location.reload();
					} else {
						swal("¡Error!", "Algo salio mal", "error");
					}
				}
			});
		} else {
			swal({
				toast: true,
				title: '¡Error!',
				text: 'La información no es correcta',
				type: 'error',
				position: 'top-end',
				timer: 4000,
				showConfirmButton: false
			});
		}
	});
});