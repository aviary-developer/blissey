//MAR20.20 Se utilizará una estructura de arrays de objectos para poder reutilizar las funciones de dibujo de la receta en la pantalla modal y así poder reducir el código necesario para poder copiar una receta guardada en una nueva.
var ar_medicamentos = [];
var ar_laboratorios = [];
var ar_ultrasonografias = [];
var ar_rayosx = [];
var ar_tacs = [];
var indicaciones = "";

$("#cambio_div_consulta").on('click', function (e) {
  e.preventDefault();
  $("#div_previo").hide();
  $("#div_consulta").show();
});

$("#cancelar_consulta").on('click', function (e) {
  e.preventDefault();
  $("#div_previo").show();
  $("#div_consulta").hide();
});

async function v_consulta(id, tipo, nivel = 0) {
  if (tipo == 3) {

    await $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/consultar',
      data: {
        id: id
      },
      success: function (r) {
        $("#fechado").text(r.fecha);
        $("#s_motivo").text(r.consulta.motivo);
        $("#s_historia").text(r.consulta.historia);
        $("#s_fisico").text(r.consulta.examen_fisico);
        $("#s_diagnostico").text(r.consulta.diagnostico);
        $("#s_medico").text(r.medico);
        $("#id_sel").val(r.consulta.f_ingreso);
      }
    });

    $("#historial").hide();
    $("#ver_consulta").show();
    $("#action_bar").show();
		$("#ver_ingresos").hide();
		$("#ver_seguimiento").hide();
	} else if (tipo == -1) {
		
		await v_seguimiento(id);

		$("#historial").hide();
		$("#ver_consulta").hide();
		$("#action_bar").show();
		$("#ver_ingresos").hide();
		$("#ver_seguimiento").show();
	}else {

    await $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/consultar_ingresos',
      data: {
        id: id
      },
      success: function (r) {
        $("#ver_ingresos").empty();

        $(r.consultas).each(function (key, value) {
          var ubicacion = window.location.hostname;
          var ruta = "/";
          if (ubicacion == "localhost") {
            ruta = "/blissey/public/";
					}
					if (r.tipo[key] == "Consulta") {
						var html = '<div class="col-sm-12 m-1 border border-secondary rounded">' +
							'<div class="flex-row">' +
							'<center>' +
							'<h6 class="text-primary mt-1">' +
							'<i class="far fa-calendar"></i> ' +
							r.fechas[key] +
							'</h6>' +
							'</center>' +
							'</div>' +
							'<div class="flex-row mb-1">' +
							'<div class="col-sm-9">' +
							'<div class="flex-row">' +
							'<center>' +
							'<span class="font-weight-bold">' +
							'<i class="fa fa-stethoscope"></i> ' +
							r.medicos[key] +
							'</span>' +
							'</center>' +
							'</div>' +
							'<div class="flex-row mb-1">' +
							'<center>' +
							'<i>' +
							'<span>' +
							'"' + value.diagnostico + '"' +
							'</span>' +
							'</i>' +
							'</center>' +
							'</div>' +
							'<div class="flex-row">' +
							'<center><span class="col-6 badge font-sm mb-2 badge-info">Evolución</span></center>' +
							'</div>' +
							'</div>' +
							'<div class="col-sm-3">' +
							'<div class="btn-group">' +
							'<button type="button" class="mb-2 btn btn-sm btn-dark" style="margin: auto" onclick="v_consulta(' + value.id + ',3,1)">' +
							'<i class="fa fa-eye"></i>' +
							'</button>';///INICIO
							if(key==0){
								html+='<button type="button" class="btn btn-sm btn btn-success mb-2" data-toggle="modal" data-target="#editarConsulta" id="botonEditarConsulta" onclick="asignarIdConsulta('+value.id+')">'+
								'<i class="fa fa-edit"></i>'+
								'</button>';
							}///FIN
							html+='<a href="' + $('#guardarruta').val() + '/recetas/' + value.id + '" target="_blank" class="btn btn-sm btn-primary mb-2">' +
							'<i class="fas fa-prescription"></i>' +
							'</a>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'</div>';
					} else {
						var html = '<div class="col-sm-12 m-1 border border-secondary rounded">' +
							'<div class="flex-row">' +
							'<center>' +
							'<h6 class="text-primary mt-1">' +
							'<i class="far fa-calendar"></i> ' +
							r.fechas[key] +
							'</h6>' +
							'</center>' +
							'</div>' +
							'<div class="flex-row mb-1">' +
							'<div class="col-sm-10">' +
							'<div class="flex-row">' +
							'<center>' +
							'<span class="font-weight-bold">' +
							'<i class="fa fa-stethoscope"></i> ' +
							r.medicos[key] +
							'</span>' +
							'</center>' +
							'</div>' +
							'<div class="flex-row">' +
							'<center><span class="col-6 badge font-sm mb-2 badge-dark">Seguimiento</span></center>' +
							'</div>' +
							'</div>' +
							'<div class="col-sm-2">' +
							'<div class="btn-group">' +
							'<button type="button" class="mb-2 btn btn-sm btn-dark" style="margin: auto" onclick="v_consulta(' + value.id + ',-1,1)">' +
							'<i class="fa fa-eye"></i>' +
							'</button>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'</div>';
					}

          $("#ver_ingresos").append(html);
        });
      }
    });

    $("#historial").hide();
    $("#ver_consulta").hide();
    $("#ver_ingresos").show();
		$("#action_bar").show();
		$("#ver_seguimiento").hide();
  }
  $("#nivel").val(nivel);
  $("#back_historial").show();
}
////Editar Consulta MODAL
function asignarIdConsulta(id){
	$("#idConsultaEditar").val(id);
	let idEditar=$("#idConsultaEditar").val();
      $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/consultar',
      data: {
        id: idEditar
      },
      success: function (r) {
        //$("#fechado").text(r.fecha);
        $("#motivoEditar").text(r.consulta.motivo);
        $("#historiaEditar").text(r.consulta.historia);
        $("#ex_fisicoEditar").text(r.consulta.examen_fisico);
        $("#diagnosticoEditar").text(r.consulta.diagnostico);
        //$("#s_medico").text(r.medico);
        //$("#id_sel").val(r.consulta.f_ingreso);
      }
    });
  }////FIN Editar Consulta MODAL

  $("#verRecetaEditar").on('click', function (e) {
	e.preventDefault();
	$("#estaEditandoReceta").val("1");
	$("#editarConsulta").modal('toggle');
	$("#receta").modal('show');
	var idEditar=$("#idConsultaEditar").val();
	ver_receta_Editar(idEditar);
	$("#copy_receta").show();
  });

$("#back_historial").on('click', function (e) {
  e.preventDefault();
  nivel = $("#nivel").val();

  if (nivel == 0) {
    $("#historial").show();
    $("#ver_consulta").hide();
    $("#action_bar").hide();
		$("#ver_ingresos").hide();
		$("#ver_seguimiento").hide();

    $("#back_historial").hide();
  } else {
    $("#historial").hide();
    $("#ver_consulta").hide();
    $("#action_bar").show();
    $("#ver_ingresos").show();
		$("#ver_seguimiento").hide();
    $("#nivel").val(0);
  }
});

//MAR20.20 Actualizaciones del buscador de recetas
$("#nuevo_receta_btn").click(function () {
	$("#buscar_receta_div").hide();
	$("#nueva_receta_div").show();
});

$("#nombre_receta_buscar").on('keyup', function () {
	if ($(this).val().length > 1) {
		$.ajax({
			type: 'get',
			url: $('#guardarruta').val() + '/receta/buscar',
			data: {
				valor: $(this).val()
			},
			success: function (r) {
				let div = $("#resultado_buscar_receta");
				let html = "";
				div.empty();
				if (r.length > 0) {
					$(r).each(function (k, v) {
						html += '<div class="row">';
						html += '<div class="col-10">';
						html += '<div class="flex-row">';
						html += '<span class="font-md">';
						html += '<b>';
						html += v.nombre;
						html += '</b>';
						html += '</span> ';
						html += '</div>';
						html += '<div class="flex-row">';
						html += '<span><i>"';
						html += v.diagnostico
						html += '"</i></span>';
						html += '</div>';
						html += '<div class="flex-row">';
						html += '<span>';
						html += v.medico;
						html += '</span>';
						html += '<span class="badge badge-light border border-primary text-primary badge-pill float-right">';
						html += '<i class="far fa-calendar"></i> ';
						html += v.fecha;
						html += '</span>';
						html += '</div>';
						html += '</div>';//Div col 10
						html += '<div class="col-2">';
						html += '<button type="button" id="ver_receta_buscar" class="btn btn-sm btn-info" data-id="' + v.id + '" title="Ver">';
						html += '<i class="fas fa-eye"></i>';
						html += '</button>';
						html += '</div>';
						html += '</div>';
						html += '<hr class="my-1">';
					});
				} else {
					html = '<div class="flex-row"><center>No hay registros que cumplan con la búsqueda</center></div>';
				}
				div.append(html);
			}
		});
	}
});

$("#resultado_buscar_receta").on('click', '#ver_receta_buscar', function (e) {
	e.preventDefault();
	ver_receta_(this);
});

$("#copy_receta").click(function (e) {
	e.preventDefault();
	$(ar_medicamentos).each(function (k, v) {
		built_medicamento(v);
	});
	$(ar_laboratorios).each(function (k, v) {
		v.click();
	});
	$(ar_ultrasonografias).each(function (k, v) {
		agregar_text_receta_evaluacion(v);
	});
	$(ar_rayosx).each(function (k, v) {
		agregar_text_receta_evaluacion(v);
	});
	$(ar_tacs).each(function (k, v) {
		agregar_text_receta_evaluacion(v);
	});

	$('#editor-one').html(indicaciones);

	$("#buscar_receta_div").hide();
	$("#nueva_receta_div").show();
});

function ver_receta_(obj) {
	$.ajax({
		type: 'get',
		url: $('#guardarruta').val() + '/receta/ver',
		data: {
			id: $(obj).data('id'),
		},
		success: function (r) {
			console.log(r);
			$("#nombre_receta_a_buscar").text(r.nombre);
			let div = $("#texto_receta_buscar");
			div.empty();
			let html = '<div class="col-12">';
			if (r.medicamentos.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Medicametos'
				html += '</span>';
				html += '</div>';

				ar_medicamentos = [];

				$(r.medicamentos).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += v.dosis;
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += ' cada ';
					html += v.frecuencia;
					html += ' durante ';
					html += v.duracion;

					if (v.nota != null) {
						html += '<i> ';
						html += 'Nota: ';
						html += v.nota;
						html += '</i>';
					}

					html += '</span>';
					html += '</div>';

					let parametros = {
						nombre_medicamento: v.nombre,
						cant_dosis: v.cant_dosis,
						forma_dosis: v.forma_dosis,
						texto_forma_dosis: v.texto_dosis,
						cant_frec: v.cant_frec,
						forma_frec: v.forma_frec,
						texto_forma_frec: v.texto_frec,
						cant_duracion: v.cant_duracion,
						forma_duracion: v.forma_duracion,
						texto_forma_duracion: v.texto_duracion,
						observacion: v.nota,
						presentacion: v.presentacion
					}

					ar_medicamentos.push(parametros);
				});

				html += '<hr class="my-2">';

			}

			if (r.laboratorios.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Laboratorio Clínico'
				html += '</span>';
				html += '</div>';

				$(r.laboratorios).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse un examen de ';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let obj = $(document).find('input[type="checkbox"][value="' + v.f_examen + '"]').parent('span').find('button.col-sm-12');
					ar_laboratorios.push(obj);

				});

				html += '<hr class="my-2">';
			}

			if (r.ultrasonografias.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Ultrasonografía'
				html += '</span>';
				html += '</div>';

				$(r.ultrasonografias).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse una ultrasonografía';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let ul = {
						tipo: 'ultra',
						texto: v.texto,
						id: v.f_ultrasonografia
					}

					ar_ultrasonografias.push(ul);
				});

				html += '<hr class="my-2">';
			}

			if (r.rayos_xs.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Rayos X'
				html += '</span>';
				html += '</div>';

				$(r.rayos_xs).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse una rafiografía ';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let rx = {
						tipo: 'rayo',
						texto: v.texto,
						id: v.f_rayox
					}

					ar_rayosx.push(rx);
				});

				html += '<hr class="my-2">';
			}

			if (r.tacs.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Tomografía Axial Computarizada (TAC)'
				html += '</span>';
				html += '</div>';

				$(r.tacs).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse una tomografía ';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let tc = {
						tipo: 'tac',
						texto: v.texto,
						id: v.f_tac
					}

					ar_tacs.push(tc);
				});

				html += '<hr class="my-2">';
			}

			if (r.texto != null) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Tratamiento'
				html += '</span>';
				html += '</div>';
				html += '<div class="flex-row">';
				html += '<p>';
				html += r.texto;
				html += '</p>';
				html += '</div>';

				indicaciones = r.texto;
			}

			html += '</div>';
			div.append(html);

			$("#copy_receta").show();
		}
	});
}

//MAY4.20 Actualizacion del seguimiento de enfermeria
function v_seguimiento(id) {
	 $.ajax({
		type: 'get',
		url: $('#guardarruta').val() + '/seguimientos',
		data: {
			id: id
		},
		success: function (r) {
			$("#fecha_seguimiento").text(r.fecha_f);
			$("#descripcion_seguimiento").text(r.descripcion);
			$("#enfermeria_seguimiento").text(r.nombre);
			$("#id_seguimiento").val(r.f_ingreso);
		}
	});
}
/////VER RECETA EN EDITAR
function ver_receta_Editar(id) {
	$.ajax({
		type: 'get',
		url: $('#guardarruta').val() + '/receta/verEditar',
		data: {
			id: id,
		},
		success: function (r) {
			console.log(r);
			$("#nombre_receta_a_buscar").text(r.nombre);
			let div = $("#texto_receta_buscar");
			div.empty();
			let html = '<div class="col-12">';
			if (r.medicamentos.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Medicametos'
				html += '</span>';
				html += '</div>';

				ar_medicamentos = [];

				$(r.medicamentos).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += v.dosis;
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += ' cada ';
					html += v.frecuencia;
					html += ' durante ';
					html += v.duracion;

					if (v.nota != null) {
						html += '<i> ';
						html += 'Nota: ';
						html += v.nota;
						html += '</i>';
					}

					html += '</span>';
					html += '</div>';

					let parametros = {
						nombre_medicamento: v.nombre,
						cant_dosis: v.cant_dosis,
						forma_dosis: v.forma_dosis,
						texto_forma_dosis: v.texto_dosis,
						cant_frec: v.cant_frec,
						forma_frec: v.forma_frec,
						texto_forma_frec: v.texto_frec,
						cant_duracion: v.cant_duracion,
						forma_duracion: v.forma_duracion,
						texto_forma_duracion: v.texto_duracion,
						observacion: v.nota,
						presentacion: v.presentacion
					}

					ar_medicamentos.push(parametros);
				});

				html += '<hr class="my-2">';

			}

			if (r.laboratorios.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Laboratorio Clínico'
				html += '</span>';
				html += '</div>';

				$(r.laboratorios).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse un examen de ';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let obj = $(document).find('input[type="checkbox"][value="' + v.f_examen + '"]').parent('span').find('button.col-sm-12');
					ar_laboratorios.push(obj);

				});

				html += '<hr class="my-2">';
			}

			if (r.ultrasonografias.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Ultrasonografía'
				html += '</span>';
				html += '</div>';

				$(r.ultrasonografias).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse una ultrasonografía';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let ul = {
						tipo: 'ultra',
						texto: v.texto,
						id: v.f_ultrasonografia
					}

					ar_ultrasonografias.push(ul);
				});

				html += '<hr class="my-2">';
			}

			if (r.rayos_xs.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Rayos X'
				html += '</span>';
				html += '</div>';

				$(r.rayos_xs).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse una rafiografía ';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let rx = {
						tipo: 'rayo',
						texto: v.texto,
						id: v.f_rayox
					}

					ar_rayosx.push(rx);
				});

				html += '<hr class="my-2">';
			}

			if (r.tacs.length > 0) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Tomografía Axial Computarizada (TAC)'
				html += '</span>';
				html += '</div>';

				$(r.tacs).each(function (k, v) {
					html += '<div class="flex-row">';
					html += '<span>';
					html += '<i class="fas fa-check"></i> ';
					html += 'Realizarse una tomografía ';
					html += '<b> ';
					html += v.nombre;
					html += '</b>';
					html += '</span>';
					html += '</div>';

					let tc = {
						tipo: 'tac',
						texto: v.texto,
						id: v.f_tac
					}

					ar_tacs.push(tc);
				});

				html += '<hr class="my-2">';
			}

			if (r.texto != null) {
				html += '<div class="flex-row">';
				html += '<span class="font-md font-weight-bold">';
				html += 'Tratamiento'
				html += '</span>';
				html += '</div>';
				html += '<div class="flex-row">';
				html += '<p>';
				html += r.texto;
				html += '</p>';
				html += '</div>';

				indicaciones = r.texto;
			}

			html += '</div>';
			div.append(html);

			$("#copy_receta").show();
		}
	});
}