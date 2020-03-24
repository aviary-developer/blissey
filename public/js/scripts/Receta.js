var v_inv_receta = []; //Almacenar el inventario de la receta
var v_pre_receta = []; //Almacenar el precio de la receta
var v_est_receta = []; //Estante de la receta
var v_niv_receta = []; //Nivel del medicamento de la receta

$(document).on('ready', function () {
  $("#med-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#med-btn").removeClass('btn-light').addClass('btn-danger');
    $('#lab-btn').removeClass('btn-danger').addClass('btn-light');
    $('#ryu-btn').removeClass('btn-danger').addClass('btn-light');
    $('#otro-btn').removeClass('btn-danger').addClass('btn-light');

    //Metodos de los divs
    $("#med-div").show();
    $("#lab-div").hide();
    $("#ryu-div").hide();
    $("#otro-div").hide();
  });

  $("#lab-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#lab-btn").removeClass('btn-light').addClass('btn-danger');
    $('#med-btn').removeClass('btn-danger').addClass('btn-light');
    $('#ryu-btn').removeClass('btn-danger').addClass('btn-light');
    $('#otro-btn').removeClass('btn-danger').addClass('btn-light');

    //Metodos de los divs
    $("#lab-div").show();
    $("#med-div").hide();
    $("#ryu-div").hide();
    $("#otro-div").hide();
  });

  $("#ryu-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#ryu-btn").removeClass('btn-light').addClass('btn-danger');
    $('#lab-btn').removeClass('btn-danger').addClass('btn-light');
    $('#med-btn').removeClass('btn-danger').addClass('btn-light');
    $('#otro-btn').removeClass('btn-danger').addClass('btn-light');

    //Metodos de los divs
    $("#ryu-div").show();
    $("#lab-div").hide();
    $("#med-div").hide();
    $("#otro-div").hide();
  });

  $("#otro-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#otro-btn").removeClass('btn-light').addClass('btn-danger');
    $('#lab-btn').removeClass('btn-danger').addClass('btn-light');
    $('#ryu-btn').removeClass('btn-danger').addClass('btn-light');
    $('#med-btn').removeClass('btn-danger').addClass('btn-light');

    //Metodos de los divs
    $("#otro-div").show();
    $("#lab-div").hide();
    $("#ryu-div").hide();
    $("#med-div").hide();
  });

  $("#nombre_producto").on('change keyup', async function () {
    var texto = $("#nombre_producto").val();

    if (texto.length > 0) {
      await $.ajax({
        type: 'get',
        url: $('#guardarruta').val() + '/consultas/datos_producto',
        data: {
          valor: texto
        },
        success: function (r) {
          $("#presentacion-selecta").text(r.presentacion);
          if (r.presentacion != "¡No está disponible!") {
            $("#presentacion-selecta").addClass('blue').removeClass('gray red');
          } else {
            $("#presentacion-selecta").addClass('red').removeClass('gray blue');
          }
        }
      });
    } else {
      $("#presentacion-selecta").text('Buscando...');
      $("#presentacion-selecta").addClass('gray').removeClass('blue red');
    }
  });

  $("#alergia_btn").on("click", function (e) {
    var paciente = $("#id_p").val();
    var alergia = $("#alergias").text();
    if (alergia == "Ninguna") {
      alergia = "";
    }

    var html_ = '<input type="text" class="swal2-input" id="a_lergia" placeholder="Alergias del paciente" value="' + alergia + '" autofocus>';

    swal({
      title: 'Alergias',
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: $('#guardarruta').val() + "/editar_alergia",
          type: "POST",
          data: {
            id: paciente,
            alergia: $("#a_lergia").val()
          },
          success: function (r) {
            if (r != 2) {
              swal({
                type: 'success',
                toast: true,
                title: '¡Acción exitosa!',
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
              });
              $("#alergias").text(r);
            } else {
              swal({
                type: 'error',
                toast: true,
                title: '¡Algo salio mal!',
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
              });
            }
          }
        });
      }
    });
  });

  $("#agregar-medicamento-receta").click(function (e) {
    e.preventDefault();

		//Variables de información
		let parametros = {
			nombre_medicamento: $("#nombre_producto").val(),
			cant_dosis : $("#numero-dosis").val(),
			forma_dosis : $("#forma-dosis").val(),
			texto_forma_dosis : $("#forma-dosis option:selected").text(),
			cant_frec : $("#numero-frec").val(),
			forma_frec : $("#forma-frec").val(),
			texto_forma_frec : $("#forma-frec option:selected").text(),
			cant_duracion : $("#numero-duracion").val(),
			forma_duracion : $("#forma-duracion").val(),
			texto_forma_duracion : $("#forma-duracion option:selected").text(),
			observacion : $("#observacion-receta").val(),
			presentacion : $("#presentacion-selecta").text()
		}

		built_medicamento(parametros);

    $("#nombre_producto").val("");
    $("#numero-dosis").val("1");
    $("#forma-dosis").val(0);
    $("#numero-frec").val("1");
    $("#forma-frec").val(0);
    $("#numero-duracion").val("1");
    $("#forma-duracion").val(0);
    $("#observacion-receta").val("");
    $("#presentacion-selecta").text('Buscando...');
    $("#presentacion-selecta").addClass('gray').removeClass('blue red');

    $("#checkObservacion").prop('unchecked');
    $("#divObservacion").hide();

    $("#nombre_producto").focus();
  });

  $("#texto-medicamento").on('click', '#remove_medicamento', function (e) {
    e.preventDefault();

    $(this).parent('p').parent('div').parent('div').remove();
  });

  $("#texto-evaluacion").on('click', '#remove_eva', function (e) {
    e.preventDefault();

    $(this).parent('p').parent('div').parent('div').remove();
  });

  $("#agregar_ultra_receta").click(function (e) {
		e.preventDefault();
		let p = {
			tipo: 'ultra',
			texto: $("#f_ultra_receta option:selected").text(),
			id: $("#f_ultra_receta").val()
		};
    agregar_text_receta_evaluacion(p);
  });

  $("#agregar_rayo_receta").click(function (e) {
		e.preventDefault();
		let p = {
			tipo: 'rayo',
			texto: $("#f_rayo_receta option:selected").text(),
			id: $("#f_rayo_receta").val()
		};
    agregar_text_receta_evaluacion(p);
  });

  $("#agregar_tac_receta").click(function (e) {
		e.preventDefault();
		let p = {
			tipo: 'tac',
			texto: $("#f_tac_receta option:selected").text(),
			id :$("#f_tac_receta").val()
		};
    agregar_text_receta_evaluacion(p);
  });

  $("#buscar_receta_m").click(async function (e) {
    e.preventDefault();
    var codigo = $("#codi-receta").val();
    await $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/receta/buscar_medicamento',
      data: {
        codigo: codigo
      },
      success: function (r) {
        if (r.cero) {
          $("#res_solicitud_m").hide();
          $("#res_negativa_m").show();
          $("#lista_paneles").hide();
        } else {
          $("#res_solicitud_m").show();
          $("#res_negativa_m").hide();
          $("#lista_paneles").show();

          $("#n_pac").text(r.paciente);
          $("#id_p_").val(r.id_p);
          $("#f_rec").text(r.fecha);

          var lista_paneles = $("#lista_paneles");

          lista_paneles.empty();
          $(r.productos).each(function (key, value) {
            var presentacion = value.presentacion;
            var html = '<div class="x_panel m_panel" style="margin-left: -3px">' +
              '<form class="form-horizontal form-badge-left input_mask">' +
              '<div class="flex-row">' +
              '<center>' +
              '<h5><span>' +
              value.nombre + '</span> ' +
              '<b class="badge font-sm badge-primary">' +
              value.presentacion +
              '</b>' +
              '</h5>' +
              '</center>' +
              '<input type="hidden" name="id_pro" value="' + value.id + '">' +
              '</div>' +
              '<div class="ln_solid mb-2 mt-"></div>' +
              '<div class="row">' +
              '<div class="form-group col-sm-12">' +
              '<label>' +
              'División:' +
              '</label>' +
              '<div class="input-group mb-2 mr-sm-2">' +
              '<div class="input-group-prepend">' +
              '<div class="input-group-text"><i class="fas fa-cubes"></i></div>' +
              '</div>' +
              '<select class="form-control form-control-sm" id="div_seleccion">';

            var indice = key;
            var precio = [];
            var inventario = [];
            var estante = [];
            var nivel = [];
            $(r.divisiones[indice]).each(function (key, value) {
              html += '<option value="' + value.id + '">' +
                ((value.contenido == 0) ? (value.nombre + ' ' + value.cantidad + ' ' + presentacion) : (value.nombre + ' ' + value.cantidad + ' ' + value.contenido)) +
                '</option>';

              precio.push(new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio));
              inventario.push(value.inventario);
              estante.push(value.estante);
              nivel.push(value.nivel);
            });
            v_pre_receta.push(precio);
            v_inv_receta.push(inventario);
            v_niv_receta.push(nivel);
            v_est_receta.push(estante);

            html += '</select>' +
              '<input type="hidden" name="index_panel" value="' + indice + '">' +
              '</div>' +
              '</div>' +
              '<div class="form-group col-sm-12">' +
              '<label>' +
              'Cantidad:' +
              '</label>' +
              '<div class="input-group mb-2 mr-sm-2">' +
              '<div class="input-group-prepend">' +
              '<div class="input-group-text"><i class="fas fa-cubes"></i></div>' +
              '</div>' +
              '<input class="form-control form-control-sm" id="cant" value="1" type="number" min="1">' +
              '</div>' +
              '</div>' +
              '</div>' +
              '<div class="row">' +
              '<div class="col-sm-4">' +
              '<center>' +
              '<label>' +
              'Precio' +
              '</label>' +
              '</center>' +
              '</div>' +
              '<div class="col-sm-4">' +
              '<center>' +
              '<label>' +
              'Inventario' +
              '</label>' +
              '</center>' +
              '</div>' +
              '<div class="col-sm-4">' +
              '<center>' +
              '<label>' +
              'Estante | Nivel' +
              '</label>' +
              '</center>' +
              '</div>' +
              '</div>' +
              '<div class="row">' +
              '<div class="col-sm-4">' +
              '<h5 class=""><b class="badge font-sm badge-success col-sm-12"> $ ' +
              v_pre_receta[indice][0] +
              '</b></h5>' +
              '</div>' +
              '<div class="col-sm-4">' +
              '<h5 class=""><b class="badge font-sm badge-light col-sm-12">' +
              v_inv_receta[indice][0] +
              '</b></h5>' +
              '</div>' +
              '<div class="col-sm-4">' +
              '<div class="col-sm-6">' +
              '<h5 class=""><b class="badge font-sm badge-primary col-sm-12">' +
              ((v_inv_receta[indice][0] == 0) ? '--' : v_est_receta[indice][0]) +
              '</b></h5>' +
              '</div>' +
              '<div class="col-sm-6">' +
              '<h5 class=""><b class="badge font-sm badge-cian col-sm-12">' +
              ((v_inv_receta[indice][0] == 0) ? '--' : v_niv_receta[indice][0]) +
              '</b></h5>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '<div class="ln_solid mb-2 mt-2"></div>' +
              '<div class="flex-row">' +
              '<center>' +
              '<button type="button" id="add_m_receta" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Agregar</button>' +
              '</center>' +
              '</div>' +
              '</form>' +
              '</div>';

            lista_paneles.append(html);
          });
        }
      }
    });

    $("#codi-receta").val('');
  });

  $("#lista_paneles").on('change', '#div_seleccion', function (e) {
    var index = $(this).prop('selectedIndex');
    var panel = $(this).parent('div').find('input').val();

    var precio = $(this).parent('div').parent('div').parent('div').parent('form').find('h5:eq(1)').find('b');
    var inventario = $(this).parent('div').parent('div').parent('div').parent('form').find('h5:eq(2)').find('b');
    var estante = $(this).parent('div').parent('div').parent('div').parent('form').find('h5:eq(3)').find('b');
    var nivel = $(this).parent('div').parent('div').parent('div').parent('form').find('h5:eq(4)').find('b');

    precio.text('$ ' + v_pre_receta[panel][index]);
    inventario.text(v_inv_receta[panel][index]);
    estante.text((v_inv_receta[panel][index] == 0) ? '--' : v_est_receta[panel][index]);
    nivel.text((v_inv_receta[panel][index] == 0) ? '--' : v_niv_receta[panel][index]);
  });

  $("#lista_paneles").on('click', '#add_m_receta', function (e) {
    e.preventDefault();

    var n_producto = $(this).parent('center').parent('div').parent('form').find('h5:eq(0)').find('span').text();
    var n_division = $(this).parent('center').parent('div').parent('form').find('select option:selected').text();
    var id_division = $(this).parent('center').parent('div').parent('form').find('select option:selected').val();
    var precio = $(this).parent('center').parent('div').parent('form').find('h5:eq(1)').find('b').text();
    var inventario = $(this).parent('center').parent('div').parent('form').find('h5:eq(2)').find('b').text();
    var cantidad = $(this).parent('center').parent('div').parent('form').find('#cant').val();

    cantidad = parseInt(cantidad);
    inventario = parseInt(inventario);
    precio = precio.trim();
    precio = precio.substr(1);
    console.log(precio);
    precio = parseFloat(precio).toFixed(2);
    if (cantidad > inventario || componentes_agregados.includes("" + id_division + "")) {
      if (cantidad > inventario) {
        notaError("La cantidad solicitada supera las existencias");
      } else {
        notaError('El producto ya se encuentra incluido');
      }
    } else {
      total_c = parseFloat(cantidad * precio);
      cambiarTotal(total_c, 1);
      var tabla = $("#tablaDetalle");
      var html = "<tr id='itr" + contadorcp + "'>" +
        '<td>' + cantidad + '</td>' +
        '<td>' + n_division + '</td>' +
        '<td>' + n_producto + '</td>' +
        '<td>$ ' + precio + '</td>' +
        '<td>$ ' + parseFloat(cantidad * precio).toFixed(2) + '</td>' +
        '<td>' +
        '<input type="hidden" name="f_producto[]" value="' + id_division + '">' +
        '<input type="hidden" name="cantidad[]" value="' + cantidad + '">' +
        '<input type="hidden" name="precio[]" value="' + precio + '">' +
        '<input type="hidden" name="tipo_detalle[]" value="1">' +
        "<button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#modalcp' onclick='cambiarPrecio(" + contadorcp + ");'>" +
        "<i class='fas fa-dollar-sign'></i>" +
        "</button>" +
        '<button type="button" class="btn btn-sm btn-danger" id="eliminar_detalle">' +
        '<i class="fa fa-times"></i>' +
        '</button>' +
        '</td>' +
        '</tr>';

      tabla.append(html);
      componentes_agregados.push("" + id_division + "");
      contadorcp++;
      notaInfo('Ha sido agregado en detalles');
    }
  });

  $("#close-search-receta-m").click(function (e) {
    $("#codi-receta").val('');
    $("#res_negativa_m").hide();
    $("#res_solicitud_m").hide();
    $("#lista_paneles").hide();
  });
});

$("#receta").on('shown.bs.modal', function () {
  $(document).off('focusin.modal');
});

function agregar_text_receta_evaluacion(p) {
	let texto = p.texto;
	let id = p.id;
	let tipo = p.tipo;
  if (tipo == 'ultra') {
    var tipo_l = 'una ultrasonografía';
  } else if (tipo == 'rayo') {
    var tipo_l = 'una radiografía';
  } else {
    var tipo_l = 'una tomografía';
  }

  var ultima = texto.substr(-1, 1);
  var penultima = texto.substr(-2, 1);
  var art = 'del';
  if (ultima == 'a') {
    art = 'de la';
  } else if (ultima == 'o' || ultima == 'e' || ultima == 'i' || ultima == 'u') {
    art = 'del';
  } else if (ultima == 's') {
    if (penultima == 'a') {
      art = 'de las';
    } else if (penultima == 'o' || penultima == 'e' || penultima == 'i' || penultima == 'u') {
      art = 'de los';
    }
  } else {
    if (penultima == 'a') {
      art = 'de la';
    } else if (penultima == 'o' || penultima == 'e' || penultima == 'i' || penultima == 'u') {
      art = 'del';
    }
  }

  var html = '<div class="row">' +
    '<div class="row" style="margin: 0 10px 0 15px">' +
    '<p class="mb-1 h-auto" style="font-size: medium">' +
    '<button type="button" class="btn btn-sm btn-danger" id="remove_eva">' +
    '<i class="fa fa-times"></i>' +
    '</button>' +
    'Realizarse ' + tipo_l + ' ' + art + ' <b class="blue">' +
    texto +
    '</b>' +
    '</p>' +
    '<input type="hidden" name="' + tipo + '_v[]" id="i_' + tipo + '" value="' + id + '">' +
    '</div>' +
    '</div>';

  $("#texto-evaluacion > div").append(html);
}

async function built_medicamento(p) {
	//Variables de información
	let medicamento = p.nombre_medicamento;
	let cant_dosis = p.cant_dosis;
	let forma_dosis = p.forma_dosis;
	let texto_dosis = p.texto_forma_dosis;
	let cant_frec = p.cant_frec;
	let forma_frec = p.forma_frec;
	let texto_frec = p.texto_forma_frec;
	let cant_duracion = p.cant_duracion;
	let forma_duracion = p.forma_duracion;
	let texto_duracion = p.texto_forma_duracion;
	let observacion = p.observacion;
	let presentacion = p.presentacion;

	let html = '';

	if (medicamento.length > 0) {

		html += '<div class="row">' +
			'<div class="row" style="margin: 0 10px 0 15px">' +
			'<p class="mb-1 h-auto" style="font-size: medium">' +
			'<button type="button" class="btn btn-sm btn-danger" id="remove_medicamento">' +
			'<i class="fa fa-times"></i>' +
			'</button>' +
			cant_dosis + ' ' + ((forma_dosis == 0 && presentacion != "¡No está disponible!") ? presentacion : texto_dosis) + ' de ' +
			'<b class="blue">' +
			medicamento +
			'</b>' +
			' cada ' + cant_frec + ' ' + texto_frec + ' durante ' + ((forma_duracion == 5) ? ('tiempo ' + texto_duracion) : (cant_duracion + ' ' + texto_duracion)) + '. ' +
			((observacion.length > 0) ? ('<i>' + 'Nota: ' + observacion + '</i>') : "") +
			'</p>' +
			'<input type="hidden" name="medicamento[]" id="i_medicamento" value="' + medicamento + '">' +
			'<input type="hidden" name="cant_dosis[]" id="i_cant_dosis" value="' + cant_dosis + '">' +
			'<input type="hidden" name="forma_dosis[]" id="i_forma_dosis" value="' + forma_dosis + '">' +
			'<input type="hidden" name="cant_frec[]" id="i_cant_frec" value="' + cant_frec + '">' +
			'<input type="hidden" name="forma_frec[]" id="i_forma_frec" value="' + forma_frec + '">' +
			'<input type="hidden" name="cant_duracion[]" id="i_cant_duracion" value="' + cant_duracion + '">' +
			'<input type="hidden" name="forma_duracion[]" id="i_forma_duracion" value="' + forma_duracion + '">' +
			'<input type="hidden" name="observacion[]" id="i_observacion" value="' + observacion + '">' +
			'</div>' +
			'</div>';
	} else {
		swal({
			title: '¡Error!',
			text: 'No ha seleccionado ningún medicamento',
			type: 'error',
			toast: true,
			timer: 4000,
			showConfirmButton: false
		});
	}

	$("#texto-medicamento > div").append(html);
}