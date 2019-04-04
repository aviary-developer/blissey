$(document).ready(async function () { 
	var vector = [];
	/*Elementos de vector
	* 0: Habitacion
	*/
	await load_habitacion();
	await load_cama();
	v_habitacion();

	$("#radioBtn > a").on('click', async function () {
		await load_habitacion();
		load_cama();
		if ($("#tipo").val() == 1) {
			$("#c_tiempo").text('Día');
		} else {
			$("#c_tiempo").text("Hora");
		}
		v_habitacion();
	});

	$("#c_habitacion").on('change', load_cama);

	$("#c_cama").on('change', v_habitacion);
	$("#c_cantidad").on('change keyup', v_habitacion);
	
	async function load_habitacion() {
		var valor = $("#tipo").val();

		await $.ajax({
			type: 'get',
			url: $('#guardarruta').val() + '/ingreso/calculadora/habitacion',
			data: {
				tipo: valor
			},
			success: function (r) {
				$("#c_habitacion").empty();
				$(r).each(function (k, v) {
					html = '<option value="' + v.id + '"> Habitación ' + v.numero + '</option>';
					$("#c_habitacion").append(html);
				});
			}
		});
	}

	async function load_cama() {
		var valor = $("#c_habitacion").val();
		var texto = $("#c_habitacion option:selected").text();
		var aux = texto.split(' ');
		var tipo = $("#tipo").val();
		if (tipo == 1) {
			t_tipo = 'I';
		} else if (tipo == 0) {
			t_tipo = 'O';
		} else {
			t_tipo = 'M';
		}
		console.log(valor);

		await $.ajax({
			type: 'get',
			url: $("#guardarruta").val() + '/ingreso/calculadora/cama',
			data: {
				id: valor
			},
			success: function (r) {
				$("#c_cama").empty();
				if (r.length > 0) {
					$(r).each(function (k, v) {
						html = '<option value="' + v.id + '"> Cama H' + aux[2] + t_tipo + v.numero + '<b> ($' + v.precio + ')</b></option>';
						$("#c_cama").append(html);
					});
				} else {
					$("#c_cama").append('<option value="0" disabled>No hay camas disponibles</option>');
				}
				v_habitacion();
			}
		});
	}

	function v_habitacion() {
		var cantidad = $("#c_cantidad").val();
		var cama = $("#c_cama").val();
		if (cama == 0) {
			vector[0] = parseInt(cantidad) * parseFloat(0);
			amount();
		} else {
			$.ajax({
				type: 'get',
				url: $("#guardarruta").val() + '/ingreso/calculadora/precio/habitacion',
				data: {
					id : cama
				},
				success: function (r) {
					vector[0] = parseInt(cantidad) * parseFloat(r);
					amount();
				}
			});
		}
	}

	function amount() {
		var acumulaldor = 0;
		$(vector).each(function (k, v) {
			acumulaldor += v;
		});
		$("#c_amount").text('$ ' + acumulaldor);
	}
});