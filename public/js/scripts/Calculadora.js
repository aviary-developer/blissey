$(document).ready(async function () {
	var vector = [];
	/*Elementos de vector
	* 0: Habitacion
	*/
	await load_habitacion();
	await load_cama();
	v_habitacion();
	v_medico();
	v_medicamento();
	v_servicio();
	v_laboratorio();
	v_ultra();
	v_rayo();
	v_tac();

	$("#radioBtn > a").on('click', async function () {
		await load_habitacion();
		load_cama();
		if ($("#tipo").val() == 1) {
			$("#c_tiempo").text('Día');
			$("#tiempo_de_hospitalizacion").show();
		} else {
			$("#c_tiempo").text("Hora");
			$("#tiempo_de_hospitalizacion").hide();
		}
		v_habitacion();
	});

	$("#c_nombre_medicamento").on('keyup', function () {
		var obj = $(this);
		if (obj.val().length < 2) {
			$("#panel_ver_medicamentos").show();
			$("#panel_buscar_medicamentos").hide();
		} else {
			$("#panel_ver_medicamentos").hide();
			$("#panel_buscar_medicamentos").show();

			var valor = obj.val();
			var ruta = $('#guardarruta').val() + "/buscarProductoVenta/" + valor;
			var tabla = $("#table_buscar_medicamentos");
			$.get(ruta, function (res) {
				tabla.empty();
				cab = "<thead>" +
					"<th colspan='2'>Resultado</th>" +
					"<th>Precio</th>" +
					"<th style='width : 50px'>Acción</th>" +
					"</thead><tbody id='tbody_table_buscar_medicamentos'><tbody/>";
				tabla.append(cab);
				$(res).each(function (key, value) {
					if (parseFloat(value.inventario) > 0) {
						if (value.u_nombre != null) {
							var aux = value.u_nombre;
						} else {
							var aux = value.p_nombre;
						}
						html = "<tr>" +
							"<td id='cu" + value.id + "'>" + value.nombre + "</td>" +
							"<td id='cd" + value.id + "'>" + " " + value.d_nombre + " " + value.cantidad + " " + aux + "</td>" +
							"<td>$ <label id='cc" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
							"<td>" +
							"<center><button type='button' class='btn btn-sm btn-primary' id='add_buscar_medicamentos'>" +
							"<i class='fa fa-check'></i>" +
							"</button></center>" +
							"</td>" +
							"</tr>";
						tabla.append(html);
					}
				});
			});
		}
	});

	$("#table_buscar_medicamentos").on('click', '#add_buscar_medicamentos', function (e) {
		e.preventDefault();
		var nombre = $(this).parents('tr').find('td:eq(0)').text();
		var presentacion = $(this).parents('tr').find('td:eq(1)').text();
		var precio = $(this).parents('tr').find('td:eq(2)').find('label').text();
		var cantidad = $("#c_cantidad_medicamento").val();

		var subpanel = $("#subpanel_ver_medicamentos");

		if ($("#subpanel_ver_medicamentos > div.row").length == 0) {
			subpanel.empty();
		} else {
			subpanel.append('<hr>');
		}

		var html = '<div class="row">' +//Primer div row
			'<div class="col-10">' + //Primer div col-10
			'<h6>' + nombre +
			' <span class="badge border border-success text-success badge-pill badge-light" id="price_m">$ ' + precio + '</span>' +
			'</h6>' +
			'<div class="row ml-1">' + //Segundo div row
			'<span class="badge badge-primary">' + presentacion + '</span>' +
			'</div>' +
			'</div>' + //Primer divl col-10
			'<div class="col-2">' + //Primer div col-2
			'<div class="form-group">' + //Primer div form-group
			'<div class="input-group mb-2 mr-sm-2">' + //Primer div --
			'<input type="number" name="c_cantidad_medicamento" id="c_cantidad_medicamento" class="form-control form-control-sm" min="0" step="1" value="' + cantidad + '">' +
			'</div>' + //Primer div --
			'</div>' + //Primer div form-group
			'</div>' + //Primer div col-2
			'</div>'; //Primer div row

		subpanel.append(html);
		$("#c_nombre_medicamento").val("");
		$("#panel_ver_medicamentos").show();
		$("#panel_buscar_medicamentos").hide();

		v_medicamento();
	});

	$("#c_nombre_servicio").on('keyup', function () {
		var obj = $(this);
		if (obj.val().length == 0) {
			$("#panel_ver_servicios").show();
			$("#panel_buscar_servicios").hide();
		} else {
			$("#panel_ver_servicios").hide();
			$("#panel_buscar_servicios").show();

			var valor = obj.val();
			var ruta = $('#guardarruta').val() + "/buscarServicios/" + valor + "/h";
			var tabla = $("#table_buscar_servicios");
			$.get(ruta, function (res) {
				tabla.empty();
				cab = "<thead>" +
					"<th>Resultado</th>" +
					"<th>Precio</th>" +
					"<th style='width : 50px'>Acción</th>" +
					"</thead><tbody id='tbody_table_buscar_servicios'><tbody/>";
				tabla.append(cab);
				$(res).each(function (key, value) {
					html = "<tr>" +
						"<td id='cu" + value.id + "'>" + value.nombre + "</td>" +
						"<td>$ <label id='cd" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
						"<td>" +
						"<center><button type='button' class='btn btn-sm btn-primary' id='add_buscar_servicios'>" +
						"<i class='fa fa-check'></i>" +
						"</button></center>" +
						"</td>" +
						"</tr>";
					tabla.append(html);
				});
			});
		}
	});

	$("#table_buscar_servicios").on('click', '#add_buscar_servicios', function (e) {
		e.preventDefault();
		var nombre = $(this).parents('tr').find('td:eq(0)').text();
		var precio = $(this).parents('tr').find('td:eq(1)').find('label').text();
		var cantidad = $("#c_cantidad_servicio").val();

		var subpanel = $("#subpanel_ver_servicios");

		if ($("#subpanel_ver_servicios > div.row").length == 0) {
			subpanel.empty();
		} else {
			subpanel.append('<hr>');
		}

		var html = '<div class="row">' +//Primer div row
			'<div class="col-10">' + //Primer div col-10
			'<h6>' + nombre +
			' <span class="badge border border-success text-success badge-pill badge-light" id="price_m">$ ' + precio + '</span>' +
			'</h6>' +
			'</div>' + //Primer divl col-10
			'<div class="col-2">' + //Primer div col-2
			'<div class="form-group">' + //Primer div form-group
			'<div class="input-group mb-2 mr-sm-2">' + //Primer div --
			'<input type="number" name="c_cantidad_servicio" id="c_cantidad_servicio" class="form-control form-control-sm" min="0" step="1" value="' + cantidad + '">' +
			'</div>' + //Primer div --
			'</div>' + //Primer div form-group
			'</div>' + //Primer div col-2
			'</div>'; //Primer div row

		subpanel.append(html);
		$("#c_nombre_servicio").val("");
		$("#panel_ver_servicios").show();
		$("#panel_buscar_servicios").hide();

		v_servicio();
	});

	$("#c_habitacion").on('change', load_cama);

	$("#c_cama").on('change', v_habitacion);
	$("#c_cantidad").on('change keyup', v_habitacion);

	$("#body-m").on('change keyup', '#c_cantidad_m', function () {
		v_medico();
	});

	$("#subpanel_ver_medicamentos").on('change keyup', '#c_cantidad_medicamento', function () {
		v_medicamento();
	});

	$("#subpanel_ver_servicios").on('change keyup', '#c_cantidad_servicio', function () {
		v_servicio();
	});

	$("#body-ultra").on('change keyup', "#c_cantidad_ultra", function () {
		v_ultra();
	});

	$("#body-tac").on('change keyup', "#c_cantidad_tac", function () {
		v_tac();
	});

	$("#body-rayo").on('change keyup', "#c_cantidad_rayo", function () {
		v_rayo();
	});

	$("#panel_ver_examenes").on('change keyup', '#c_cantidad_examen', function () {
		v_laboratorio();

		var grupo = $(this).parents('.div_area');
		var id_grupo = $(grupo).attr('id');

		var contador = 0;
		$('#' + id_grupo + ' > div.row').each(function (k, v) {
			var txt_cantidad = $(v).find('#c_cantidad_examen').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			contador += cantidad;
		});

		$("#c_" + id_grupo).text(contador);
	});

	$("#c_area").on('change', function () {
		var valor = $("#c_area").val();

		$("#panel_ver_examenes > div.div_area").each(function (k, v) {
			$(v).hide();
		});
		$("#count_column > span.contadores").each(function (k, v) {
			$(v).removeClass('badge-dark').addClass('badge-primary');
		});

		var id_div = valor.replace(/ /g, '_');
		$("#" + id_div).show();
		$("#c_" + id_div).removeClass('badge-primary').addClass('badge-dark');
	});

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
			t_tipo = 'I';
		}

		await $.ajax({
			type: 'get',
			url: $("#guardarruta").val() + '/ingreso/calculadora/cama',
			data: {
				id: valor,
				tipo: tipo
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
		if (cama == 0 || cama == null) {
			vector[0] = parseInt(cantidad) * parseFloat(0);
			amount();
		} else {
			$.ajax({
				type: 'get',
				url: $("#guardarruta").val() + '/ingreso/calculadora/precio/habitacion',
				data: {
					id: cama,
					tipo: $("#tipo").val()
				},
				success: function (r) {
					if ($("#tipo").val() == 1) {
						vector[0] = parseInt(cantidad) * parseFloat(r);
					} else {
						vector[0] = parseFloat(r);
					}
					amount();
				}
			});
		}
	}

	function v_medico() {
		var acumulador = 0;
		$("#body-m > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_m').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});

		vector[1] = acumulador;
		amount();
	}

	function v_medicamento() {
		var acumulador = 0;
		$("#subpanel_ver_medicamentos > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_medicamento').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});

		vector[2] = acumulador;
		amount();
	}

	function v_servicio() {
		var acumulador = 0;
		$("#subpanel_ver_servicios > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_servicio').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});

		vector[3] = acumulador;
		amount();
	}

	function v_laboratorio() {
		var acumulador = 0;
		$("#panel_ver_examenes > .div_area > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_examen').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});
		vector[4] = acumulador;
		amount();
	}

	function v_ultra() {
		var acumulador = 0;
		$("#body-ultra > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_ultra').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});

		vector[5] = acumulador;
		amount();
	}

	function v_tac() {
		var acumulador = 0;
		$("#body-tac > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_tac').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});

		vector[6] = acumulador;
		amount();
	}

	function v_rayo() {
		var acumulador = 0;
		$("#body-rayo > div.row").each(function (k, v) {
			var txt_precio = $(v).find('#price_m').text();
			txt_precio = txt_precio.trim();
			var aux = txt_precio.split(" ");
			var precio = aux[1];
			precio = parseFloat(precio);

			var txt_cantidad = $(v).find('#c_cantidad_rayo').val();
			if (txt_cantidad != "") {
				txt_cantidad = txt_cantidad.trim();
				var cantidad = parseInt(txt_cantidad);
			} else {
				var cantidad = 0;
			}

			acumulador += (precio * cantidad);
		});

		vector[7] = acumulador;
		amount();
	}

	function amount() {
		var acumulador = 0;
		$(vector).each(function (k, v) {
			acumulador += v;
		});
		var numero = new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(acumulador);
		$("#c_amount").text('$ ' + numero);
	}
});