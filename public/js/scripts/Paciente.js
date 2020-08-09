$(document).on('ready', function () {
  var minimo = $("#min").val();
  var maximo = $("#max").val();
  var desde = $("#from").val();
  var hasta = $("#to").val();
  var ubicacion = window.location.pathname;

  if (ubicacion.indexOf("pacientes/") > -1) {
    if ($("#ubi").val() != "show") {
      cargar_municipio();
      cambio_residencia();
    } else {
      var ingreso_tabla = $("#ingreso-table").DataTable();
      var consulta_tabla = $("#consulta-table").DataTable();
      var solicitud_tabla = $("#solicitud-table").DataTable();
    }
  }

  function cargar_municipio() {
    var v_departamento = $("#departamento_select").val();
    var municipio_select = $("#municipio_select");
    var editado = $("#municipio_edit").val();

    $.ajax({
      type: "GET",
      url: $('#guardarruta').val() + "/municipios/" + v_departamento,
      success: function (respuesta) {
        municipio_select.empty();
        $(respuesta).each(function (key, value) {
          if (editado == value) {
            municipio_select.append("<option value='" + value + "' selected>" + value + "</option>");
          } else {
            municipio_select.append("<option value='" + value + "'>" + value + "</option>");
          }
        });
      }
    });
  }

  $("#departamento_select").on("change", function () {
    cargar_municipio();
  });

  $("#range_paciente_edad").ionRangeSlider({
    type: "double",
    grid: true,
    min: minimo,
    max: maximo,
    from: desde,
    to: hasta,
    step: 1,
    postfix: " años",
    onChange: function () {
      peticion();
    }
  });

  var slider = $("#range_paciente_edad").data("ionRangeSlider");

  $("#limpiar_paciente_filtro").on("click", function () {
    $("#nombre").val("");
    $("#apellido").val("");
    $("#sexo1").parents('div').addClass("checked");
    $("#sexo1").prop("checked", true);
    $("#sexo2").parents('div').removeClass("checked");
    $("#sexo3").parents('div').removeClass("checked");
    $("#telefono").val("");
    $("#dui").val("");
    $("#direccion").val("");
    slider.update({
      from: desde,
      to: hasta
    });
  });

  $("#nombre").on("keyup", function () {
    peticion();
  });

  $("#apellido").on("keyup", function () {
    peticion();
  });

  $("#telefono").on("keyup", function () {
    peticion();
  });

  $("#dui").on("keyup", function () {
    peticion();
  });

  $("#direccion").on("keyup", function () {
    peticion();
  });

  $("#sexo1").on("click", function () {
    peticion();
  });

  $("#sexo2").on("click", function () {
    peticion();
  });

  $("#sexo3").on("click", function () {
    peticion();
  });

  $("#abrir_filtro").on("click", function () {
    peticion();
  });

  function peticion() {
    var v_nombre = $("#nombre").val();
    var v_apellido = $("#apellido").val();
    var v_sexo = $("#sexo").val();
    var v_telefono = $("#telefono").val();
    var v_dui = $("#dui").val();
    var v_direccion = $("#direccion").val();
    var v_edad = $("#range_paciente_edad").val();
    var v_estado = $("#estado").val();

    $.ajax({
      type: "GET",
      url: $('#guardarruta').val() + "/filtrarPaciente",
      data: {
        nombre: v_nombre,
        apellido: v_apellido,
        sexo: v_sexo,
        telefono: v_telefono,
        dui: v_dui,
        direccion: v_direccion,
        edad: v_edad,
        estado: v_estado
      },
      dataType: 'json',
      success: function (respuesta) {
        var p = $("#texto");
        p.empty();
        if (respuesta > 0 && respuesta < 3) {
          var html =
            "La búsqueda generará " +
            "<b style = 'color: rgb(0,128,64);'>" +
            respuesta + " registros" +
            "</b>" +
            " es óptimo para reportes";
        } else {
          var html =
            "La búsqueda generará " +
            "<b style = 'color: rgb(255,60,60);'>" +
            respuesta + " registros" +
            "</b>" +
            " no podrá generar reportes";
        }
        p.append(html);
      },
    });
  }

  $("#fecha_paciente").on("change", function () {
		if (fecha_dui("#fecha_paciente")) {
			$("#dui_paciente").show();
		} else {
			$("#dui_paciente").hide();
		}
	});

	$("#acta-p-fecha").on("change", function () {
		if (fecha_dui("#acta-p-fecha")) {
			$("#acta-p-dui").prop({
				disabled: false
			});
		} else {
			$("#acta-p-dui").prop({
				disabled: true
			});
		}
	});
	
	function fecha_dui(object) {
		var hoy = new Date();
		var fecha = $(object).val();
		var a_fecha = fecha.split('-');
		var is_anio = true;
		var is_mes = true;
		var is_dia = true;
		var anio = parseInt(a_fecha[0]);
		var mes = parseInt(a_fecha[1]);
		var dia = parseInt(a_fecha[2]);

		if (isNaN(anio)) {
			is_anio = false;
		}
		if (isNaN(mes)) {
			is_mes = false;
		}
		if (isNaN(dia)) {
			is_dia = false;
		}

		if (is_dia && is_mes && is_anio && (anio > 1000)) {
			var edad = hoy.getFullYear() - anio;
			if (mes > (hoy.getMonth() + 1)) {
				edad--;
			}
			if (mes == (hoy.getMonth() + 1) && dia > hoy.getDay()) {
				edad--;
			}

			if (edad > 17) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

  $('.radio-pais').on("click", function () {
    cambio_residencia()
  });

  function cambio_residencia() {
    var valor = $("#residencia_paciente").val();
    if (valor == 0) {
      document.getElementById("pais_div").style = "display:block";
      document.getElementById("departamento_div").style = "display:none";
      document.getElementById("municipio_div").style = "display:none";
    } else {
      document.getElementById("pais_div").style = "display:none";
      document.getElementById("departamento_div").style = "display:block";
      document.getElementById("municipio_div").style = "display:block";
    }
  }

  $("#filtro_h").on('change', function () {
    var tipo = $("#filtro_h").val();
    var id = $("#id-p").val();

    $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/paciente/servicio_medico',
      data: {
        id: id,
        tipo: tipo
      },
      success: function (r) {
        var tabla = $("#body-table");
        tabla.empty();
        ingreso_tabla.clear();

        for (var i = 0; i < r.count; i++) {
          var fecha = moment(r.r[i].fecha_ingreso);
          var tipo_txt;
          html = '<tr>' +
            '<td>' +
            (i + 1) +
            '</td>' +
            '<td>' +
            fecha.format('DD [de] MMMM [de] YYYY') +
            '</td>' +
            '<td>';
          if (r.r[i].tipo == 0) {
            html += '<span class="badge border border-success text-success col-8">Ingreso</span>';
            tipo_txt = '<span class="badge border border-success text-success col-8">Ingreso</span>';
          } else if (r.r[i].tipo == 1) {
            html += '<span class="badge border border-purple text-purple col-8">Medio ingreso</span>';
            tipo_txt = '<span class="badge border border-purple text-purple col-8">Medio ingreso</span>';
          } else if (r.r[i].tipo == 2) {
            html += '<span class="badge border border-primary text-primary col-8">Observación</span>';
            tipo_txt = '<span class="badge border border-primary text-primary col-8">Observación</span>';
          } else if (r.r[i].tipo == 3) {
            html += '<span class="badge border border-pink text-pink col-8">Consulta</span>';
            tipo_txt = '<span class="badge border border-pink text-pink col-8">Consulta</span>';
          } else {
            html += '<span class="badge border border-info text-info col-8">Curación</span>';
            tipo_txt = '<span class="badge border border-info text-info col-8">Curación</span>';
          }
          html += '</td>' +
            '<td>' +
            '<center>' +
            '<button type="button" class="btn btn-info btn-sm datos_ingreso" data-value="' + r.r[i].id + '" data-toggle="modal" data-target="#ver_ingreso_pac" title="Ver"><i class="fas fa-info-circle"></i></button>' +
            '</center>' +
            '</td>' +
            '</tr>';
          var bto = '<center>' +
            '<button type="button" class="btn btn-info btn-sm datos_ingreso" data-value="' + r.r[i].id + '" data-toggle="modal" data-target="#ver_ingreso_pac" title="Ver"><i class="fas fa-info-circle" ></i></button>' +
            '</center>';
          tabla.append(html);
          ingreso_tabla.row.add([
            (i + 1),
            fecha.format('DD [de] MMMM [del] YYYY'),
            tipo_txt,
            bto
          ]);
        }
        ingreso_tabla.draw();
      }
    });
  });

  $("#ingreso-table").on('click', '.datos_ingreso', function (e) {
    e.preventDefault();
    var id = $(this).data('value');

    $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/paciente/servicio_paciente',
      data: {
        id: id
      },
      success: function (r) {
        var fecha_ingreso = moment(r.ingreso.fecha_ingreso);
        if (r.ingreso.fecha_alta != null) {
          var fecha_alta = moment(r.ingreso.fecha_alta);
        }

        //Información
        var html;
        $("#fecha_ingreso_t").text(fecha_ingreso.format('DD [de] MMM [del] YYYY'));
        if (r.ingreso.fecha_alta != null) {
          $("#fecha_alta_t").empty();
          $("#fecha_alta_t").text(fecha_alta.format('DD [de] MMM [del] YYYY'));
        } else {
          $("#fecha_alta_t").empty();
          html = '<span class="badge border border-danger text-danger col-8">Hospitalizado</span>';
          $("#fecha_alta_t").append(html);
        }
        $("#dias_t").text(r.dias);
        $("#tipo_t").empty();

        if (r.ingreso.tipo == 0) {
          html = '<span class="badge border border-success text-success col-8">Ingreso</span>';
        } else if (r.ingreso.tipo == 1) {
          html = '<span class="badge border border-purple text-purple col-8">Medio ingreso</span>';
        } else if (r.ingreso.tipo == 2) {
          html = '<span class="badge border border-primary text-primary col-8">Observación</span>';
        } else if (r.ingreso.tipo == 3) {
          html = '<span class="badge border border-pink text-pink col-8">Consulta</span>';
        } else {
          html = '<span class="badge border border-info text-info col-8">Curación</span>';
        }
        $("#tipo_t").append(html);
        html = '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(r.total);
        $("#costo_t").text(html);

        //Consultas
        $("#c-body-table").empty();
        consulta_tabla.clear();
        $(r.consultas).each(function (i, val) {
          var fecha_consulta = moment(val.created_at);
          html = '<tr>' +
            '<td>' +
            (i + 1) +
            '</td>' +
            '<td>' +
            fecha_consulta.format('DD [de] MMM [del] YYYY') +
            '</td>' +
            '<td>' +
            r.medicos[i] +
            '</td>' +
            '<td>' +
            val.motivo +
            '</td>' +
            '<td>' +
            val.historia +
            '</td>' +
            '<td>' +
            val.examen_fisico +
            '</td>' +
            '<td>' +
            val.diagnostico +
            '</td>' +
            '</tr>';

          $("#c-body-table").append(html);
          consulta_tabla.row.add([
            (i + 1),
            fecha_consulta.format('DD [de] MMM [del] YYYY'),
            r.medicos[i],
            val.motivo,
            val.historia,
            val.examen_fisico,
            val.diagnostico
          ]);
        });

        consulta_tabla.draw();
      }
    });
	});

  $("#solicitud-table").on("click", "#ver_examen_f", function (e) {
		e.preventDefault();
		
    var solicitud = $(this).data('value').solicitud_id;
    var examen = $(this).data('value').examen_id;
    var estado = $(this).data('value').estado;

		ver_examen_completo(solicitud, examen, estado, 1);
    
  });

  $("#solicitud-table").on("click", "#ver_evaluacion_f", function (e) {
    e.preventDefault();

    var solicitud = $(this).data('value').solicitud_id;
    var tipo = $(this).data('value').tipo;
    var estado = $(this).data('value').estado;

		ver_evaluacion_completa(solicitud, tipo, estado);
  });

  $("#filtro_e").on('change', function () {
    var tipo = $("#filtro_e").val();
    var id = $("#id-p").val();

    $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/paciente/filtro_evaluacion',
      data: {
        id: id,
        tipo: tipo
      },
      success: function (r) {
        solicitud_tabla.clear();
        cuerpo = $("#sol-body-table");
        cuerpo.empty().append(r.html);

        $(r.fila).each(function (k, v) {
          solicitud_tabla.row.add([
            v[0],
            v[1],
            v[2],
            v[3],
						v[4],
						v[5]
          ]);
        });

        solicitud_tabla.draw();
      }
    });
  });
});

function ver_examen_completo(solicitud, examen, estado, ruta = 0) {
	if (ruta == 0) {
		$("#ver_laboratorio").modal('hide');
	}
	$.ajax({
		type: 'get',
		url: $('#guardarruta').val() + '/paciente/datos_ev',
		data: {
			id: solicitud
		},
		success: function (r) {
			var fecha = moment(r.solicitud.created_at);

			$("#fecha_ev").text(fecha.format('DD [de] MMMM [del] YYYY'));
			$("#ev_").text(r.examen);
			$("#tipo_ev").empty().append(r.area);
		}
	});

	if (estado < 2) {
		$("#cargando_ex_m").show();
		$("#contenido_evaluacion").hide();
	} else {
		$("#cargando_ex_m").hide();
		$("#contenido_evaluacion").show();

		var cuerpo = $("#contenido_evaluacion");

		$.ajax({
			type: 'get',
			url: $('#guardarruta').val() + '/paciente/ver_examen',
			data: {
				solicitud: solicitud,
				examen: examen
			},
			success: function (r) {
				cuerpo.empty().append(r);
			}
		});
	}
}

function ver_evaluacion_completa(solicitud, tipo, estado, ruta = -1) {
	if (ruta == 0) {
		$("#ver_rayosx").modal('hide');
	} else if(ruta == 1){
		$("#ver_ultra").modal('hide');
	}else if(ruta == 2){
		$("#ver_tac").modal('hide');
	}

	if (tipo == 0) {
		$("#titulo-mo").text('Evaluación de Rayos X');
	} else if (tipo == 1) {
		$("#titulo-mo").text('Evaluación de Ultrasonografía');
	} else if (tipo == 2) {
		$("#titulo-mo").text('Evaluación de TAC');
	}


	$.ajax({
		type: 'get',
		url: $('#guardarruta').val() + '/paciente/ver_evaluacion',
		data: {
			solicitud: solicitud
		},
		success: function (r) {
			var fecha = moment(r.solicitud.created_at);

			$("#fecha_ev_2").text(fecha.format('DD [de] MMMM [del] YYYY'));
			$("#ev_2").text(r.nombre);

			if (estado < 2) {
				$("#cargando_ex_m_2").show();
				$("#contenido_evaluacion_2").hide();
			} else {
				$("#cargando_ex_m_2").hide();
				$("#contenido_evaluacion_2").show();

				$("#contenido_evaluacion_2").empty().append(r.html);
			}
		}
	});
}