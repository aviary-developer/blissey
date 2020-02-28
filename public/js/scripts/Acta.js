$(document).ready(function () {
	var b_dui = true;
	var b_telefono = true;
	var b_direccion = true;
	var b_rdui = true;
	var pac_i; //Id del paciente
	var res_i; //Id del resposable
	var ing_i; //Id del ingreso

	$("#tabla-ingreso-index").on("click", "#generated_acta", function (e) {
		e.preventDefault();

		let id = $(this).data("id");
		ing_i = $(this).data("ingreso");

		$.ajax({
			type: 'get',
			url: $('#guardarruta').val() + "/ingreso/acta/datos",
			data: {
				id: id
			},
			success: function (r) {
				$("#acta-p-nombre").val(r.paciente.nombre);
				$("#acta-p-apellido").val(r.paciente.apellido);
				let fecha = moment(r.paciente.fechaNacimiento);
				$("#acta-p-fecha").val(fecha.format("YYYY-MM-DD"));

				if (r.paciente.edad < 18) {
					$("#acta-p-dui").prop("disabled", true);
				} else {
					$("#acta-p-dui").prop("disabled", false);
					if (r.paciente.dui != null) {
						if (r.paciente.dui.length == 0) {
							$("#acta-p-dui").addClass("border border-danger");
							b_dui = false;
						} else {
							$("#acta-p-dui").val(r.paciente.dui);
						}
					}
				}

				if (r.paciente.telefono != null) {
					if (r.paciente.telefono.length == 0) {
						$("#acta-p-telefono").addClass("border border-danger");
						b_telefono = false;
					} else {
						$("#acta-p-telefono").val(r.paciente.telefono);
					}
				}

				//Línea faltante
				if (r.paciente.direccion != null) {
					if (r.paciente.direccion.length == 0) {
						$("#acta-p-direccion").addClass("border border-danger");
					} else {
						$("#acta-p-direccion").val(r.paciente.direccion);
					}
				}

				pac_i = r.paciente.id;
				res_i = r.responsable.id;

				if (pac_i == res_i) {
					$("#acta-datos_resposable").hide();
				} else {
					$("#acta-datos_responsable").show();
					$("#acta-r-nombre").val(r.responsable.nombre);
					$("#acta-r-apellido").val(r.responsable.apellido);

					if (r.responsable.dui.length == 0 && r.responsable.edad > 17) {
						$("#acta-r-dui").addClass("border border-danger");
					} else {
						$("#acta-r-dui").val(r.responsable.dui);
					}
				}

				$("#acta-btn-generar").data({
					paciente: r.paciente.id,
					responsable: r.responsable.id
				});

				bloqueo();
			}
		});
	});

	$("#acta-r-dui, #acta-p-dui, #acta-p-telefono, #acta-p-direccion").keyup(function () {
		habilitar(this);
		bloqueo();
	});

	function bloqueo() {
		b_dui = ($("#acta-p-dui").val().length == 0) ? false : true;
		b_telefono = ($("#acta-p-telefono").val().length == 0) ? false : true;
		b_direccion = ($("#acta-p-direccion").val().length == 0) ? false : true;
		b_rdui = ($("#acta-r-dui").val().length == 0 && pac_i != res_i) ? false : true;

		if (b_dui && b_direccion && b_telefono && b_rdui) {
			$("#acta-btn-generar").prop("disabled", false).removeClass("btn-secondary").addClass("btn-primary");
		} else {
			$("#acta-btn-generar").prop("disabled", true).addClass("btn-secondary").removeClass("btn-primary");
		}
	}

	function habilitar(obj) {
		console.log("E");
		if ($(obj).val().length == 0) {
			$(obj).addClass("border border-danger");
		} else {
			$(obj).removeClass("border border-danger");
		}
	}

	$("#acta-btn-generar").click(function (e) {
		e.preventDefault();

		$.ajax({
			type: 'post',
			url: $('#guardarruta').val() + "/paciente/acta/datos",
			data: {
				paciente_id: $(this).data("paciente"),
				nombre: $("#acta-p-nombre").val(),
				apellido: $("#acta-p-apellido").val(),
				dui: $("#acta-p-dui").val(),
				fecha: $("#acta-p-fecha").val(),
				direccion: $("#acta-p-direccion").val(),
				telefono: $("#acta-p-telefono").val(),
				responsable_id: $(this).data("responsable"),
				r_nombre: $("#acta-r-nombre").val(),
				r_apellido: $("#acta-r-apellido").val(),
				r_dui: $("#acta-r-dui").val()
			},
			success: function (r) {
				if (r == 1) {
					$("#launch").prop('href', $('#guardarruta').val() + "/acta/" + ing_i);

					document.getElementById("launch").click();

					location.reload();
				}
			}
		});
	});
});