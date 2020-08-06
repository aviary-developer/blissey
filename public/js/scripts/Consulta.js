$(document).on("ready", function () {
  $("#guardar_consulta").on("click", async function (e) {
    if($("#estaEditandoReceta").val()==1){
      editarConsulta(e);
    }else{ 
    e.preventDefault();
    /**Guardar el texto del editor en un text area */
    var contenedor = $('#texto-receta');
    var textoHTML = $('#editor-one').html();
    contenedor.val(textoHTML);
    /**Variables del tratamiento o receta */
    var nombre_producto_prov = $("input[name = 'medicamento[]']").serializeArray();
    var cant_dosis_prov = $("input[name='cant_dosis[]']").serializeArray();
    var forma_dosis_prov = $("input[name='forma_dosis[]']").serializeArray();
    var cant_frec_prov = $("input[name='cant_frec[]']").serializeArray();
    var forma_frec_prov = $("input[name='forma_frec[]']").serializeArray();
    var cant_duracion_prov = $("input[name='cant_duracion[]']").serializeArray();
    var forma_duracion_prov = $("input[name='forma_duracion[]']").serializeArray();
    var observacion_prov = $("input[name='observacion[]']").serializeArray();
    var examen_prov = $("input[name = 'examen[]']").serializeArray();
    var tac_prov = $("input[name = 'tac_v[]']").serializeArray();
    var ultra_prov = $("input[name = 'ultra_v[]']").serializeArray();
    var rayo_prov = $("input[name = 'rayo_v[]']").serializeArray();

    var nombre_producto = [];
    var cant_dosis = [];
    var forma_dosis = [];
    var cant_frec = [];
    var forma_frec = [];
    var cant_duracion = [];
    var forma_duracion = [];
    var observacion = [];
    var examen = [];
    var tac = [];
    var ultra = [];
		var rayo = [];
		
		//MAR20.20 Guardar el nombre de la receta
		var nombre_receta = $("#nombre_receta").val();

    $(nombre_producto_prov).each(function (key, value) {
      nombre_producto.push(value.value);
      cant_dosis.push(cant_dosis_prov[key].value);
      forma_dosis.push(forma_dosis_prov[key].value);
      cant_frec.push(cant_frec_prov[key].value);
      forma_frec.push(forma_frec_prov[key].value);
      cant_duracion.push(cant_duracion_prov[key].value);
      forma_duracion.push(forma_duracion_prov[key].value);
      observacion.push(observacion_prov[key].value);
    });

    $(examen_prov).each(function (key, value) {
      examen.push(value.value);
    });

    $(tac_prov).each(function (key, value) {
      tac.push(value.value);
    });

    $(ultra_prov).each(function (key, value) {
      ultra.push(value.value);
    });

    $(rayo_prov).each(function (key, value) {
      rayo.push(value.value);
    });

		var guardar = false;
		if (nombre_receta == "") {
			await swal({
				title: 'Guardar Receta Sin Nombre',
				text: '¿Está seguro que desea guardar la receta sin nombre? ¡Ya no será posible asignarle un nombre después!',
				type: 'question',
				showCancelButton: true,
				confirmButtonText: 'Si, ¡Guardar!',
				cancelButtonText: 'No, ¡Cancelar!',
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-light',
				buttonsStyling: false
			}).then((result) => {
				if (result.value) {
					guardar = true;
				}
			});
		} else {
			guardar = true;
		}
		console.log(guardar);
		if (guardar) {
			await $.ajax({
				type: "post",
				url: $('#guardarruta').val() + "/consulta",
				data: {
					motivo: $("#motivo").val(),
					historia: $("#historia").val(),
					examen_fisico: $("#ex_fisico").val(),
					diagnostico: $("#diagnostico").val(),
					f_ingreso: $("#id").val(),
					nombre_producto: nombre_producto,
					cant_dosis: cant_dosis,
					forma_dosis: forma_dosis,
					cant_frec: cant_frec,
					forma_frec: forma_frec,
					cant_duracion: cant_duracion,
					forma_duracion: forma_duracion,
					observacion: observacion,
					f_examen: examen,
					f_tac: tac,
					f_ultrasonografia: ultra,
					f_rayox: rayo,
					texto: contenedor.val(),
					nombre_receta: nombre_receta
				},
				success: function (r) {
					if (r != 0) {
						swal("¡Hecho!", "Accion realizada satisfactoriamente", "success");
						window.open($('#guardarruta').val() + "/recetas/" + r, '_blank');
						location.reload();
					} else {
						swal("¡Error!", "Algo salio mal", "error");
					}
				}
			});
		}
}
});

 async function editarConsulta (e) {
    e.preventDefault();
    /**Guardar el texto del editor en un text area */
    var contenedor = $('#texto-receta');
    var textoHTML = $('#editor-one').html();
    contenedor.val(textoHTML);
    /**Variables del tratamiento o receta */
    var nombre_producto_prov = $("input[name = 'medicamento[]']").serializeArray();
    var cant_dosis_prov = $("input[name='cant_dosis[]']").serializeArray();
    var forma_dosis_prov = $("input[name='forma_dosis[]']").serializeArray();
    var cant_frec_prov = $("input[name='cant_frec[]']").serializeArray();
    var forma_frec_prov = $("input[name='forma_frec[]']").serializeArray();
    var cant_duracion_prov = $("input[name='cant_duracion[]']").serializeArray();
    var forma_duracion_prov = $("input[name='forma_duracion[]']").serializeArray();
    var observacion_prov = $("input[name='observacion[]']").serializeArray();
    var examen_prov = $("input[name = 'examen[]']").serializeArray();
    var tac_prov = $("input[name = 'tac_v[]']").serializeArray();
    var ultra_prov = $("input[name = 'ultra_v[]']").serializeArray();
    var rayo_prov = $("input[name = 'rayo_v[]']").serializeArray();

    var nombre_productoE = [];
    var cant_dosisE = [];
    var forma_dosisE = [];
    var cant_frecE = [];
    var forma_frecE = [];
    var cant_duracionE = [];
    var forma_duracionE = [];
    var observacionE = [];
    var examenE = [];
    var tacE = [];
    var ultraE = [];
		var rayoE = [];
		
		//MAR20.20 Guardar el nombre de la receta
		var nombre_receta = $("#nombre_receta").val();

    $(nombre_producto_prov).each(function (key, value) {
      nombre_productoE.push(value.value);
      cant_dosisE.push(cant_dosis_prov[key].value);
      forma_dosisE.push(forma_dosis_prov[key].value);
      cant_frecE.push(cant_frec_prov[key].value);
      forma_frecE.push(forma_frec_prov[key].value);
      cant_duracionE.push(cant_duracion_prov[key].value);
      forma_duracionE.push(forma_duracion_prov[key].value);
      observacionE.push(observacion_prov[key].value);
    });

    $(examen_prov).each(function (key, value) {
      examenE.push(value.value);
    });

    $(tac_prov).each(function (key, value) {
      tacE.push(value.value);
    });

    $(ultra_prov).each(function (key, value) {
      ultraE.push(value.value);
    });

    $(rayo_prov).each(function (key, value) {
      rayoE.push(value.value);
    });

		var guardar = false;
		if (nombre_receta == "") {
			await swal({
				title: 'Guardar Receta Sin Nombre',
				text: '¿Está seguro que desea guardar la receta sin nombre? ¡Ya no será posible asignarle un nombre después!',
				type: 'question',
				showCancelButton: true,
				confirmButtonText: 'Si, ¡Guardar!',
				cancelButtonText: 'No, ¡Cancelar!',
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-light',
				buttonsStyling: false
			}).then((result) => {
				if (result.value) {
					guardar = true;
				}
			});
		} else {
			guardar = true;
		}
		console.log(guardar);
		if (guardar) {
			await $.ajax({
				type: "post",
				url: $('#guardarruta').val() + "/consultaEditar",
				data: {
					motivo: $("#motivoEditar").val(),
					historia: $("#historiaEditar").val(),
					examen_fisico: $("#ex_fisicoEditar").val(),
					diagnostico: $("#diagnosticoEditar").val(),
					f_ingreso: $("#idConsultaEditar").val(),
					nombre_producto: nombre_productoE,
					cant_dosis: cant_dosisE,
					forma_dosis: forma_dosisE,
					cant_frec: cant_frecE,
					forma_frec: forma_frecE,
					cant_duracion: cant_duracionE,
					forma_duracion: forma_duracionE,
					observacion: observacionE,
					f_examen: examenE,
					f_tac: tacE,
					f_ultrasonografia: ultraE,
					f_rayox: rayoE,
					texto: contenedor.val(),
					nombre_receta: nombre_receta
				},
				success: function (r) {
					if (r != 0) {
						swal("¡Hecho!", "Accion realizada satisfactoriamente", "success");
						window.open($('#guardarruta').val() + "/recetas/" + r, '_blank');
						location.reload();
					} else {
						swal("¡Error!", "Algo salio mal", "error");
					}
				}
			});
		}
  }


  $("#btn_lista").on("click", function (e) {
    lista();
  });

  $("#btn_listar").on("click", function (e) {
    lista();
  });

  $("#btn_info").on("click", function (e) {
    $("#informacion__").show();
    $("#consultas__").hide();
    $("#ver_consulta__").hide();
    $("#signos__").hide();
    $("#ver_signo__").hide();
    $("#examenes__").hide();
  });

  $("#btn_signos").on("click", function (e) {
    lista_signos();
  });

  $("#btn_sign").on("click", function (e) {
    lista_signos();
  });

  $("#btn_examen").on('click', function (e) {
    lista_examen();
  });

  function lista_signos() {
    $("#informacion__").hide();
    $("#consultas__").hide();
    $("#ver_consulta__").hide();
    $("#signos__").show();
    $("#ver_signo__").hide();
    $("#examenes__").hide();
  }

  function lista() {
    $("#informacion__").hide();
    $("#consultas__").show();
    $("#ver_consulta__").hide();
    $("#signos__").hide();
    $("#ver_signo__").hide();
    $("#examenes__").hide();
  }

  function lista_examen() {
    $("#informacion__").hide();
    $("#consultas__").hide();
    $("#ver_consulta__").hide();
    $("#signos__").hide();
    $("#ver_signo__").hide();
    $("#examenes__").show();
  }

  $("#ver_crear_receta").click(function (e) {
    e.preventDefault();
    var is_valid = true;

/*     var valido = new Validated('motivo');
    valido.required();
    is_valid = valido.value(is_valid);

    var valido = new Validated('historia');
    valido.required();
    is_valid = valido.value(is_valid); */

    var valido = new Validated('ex_fisico');
    valido.required();
    is_valid = valido.value(is_valid);

 /*    var valido = new Validated('diagnostico');
    valido.required();
    is_valid = valido.value(is_valid); */

    if (is_valid) {
			$("#receta").modal('show');
			$("#buscar_receta_div").show();
			$("#nueva_receta_div").hide();
    }
  });

});

$('#modal_consulta').on('shown.bs.modal', function () {
  $(document).off('focusin.modal');
});

function consulta_load(id) {
  $("#informacion__").hide();
  $("#consultas__").hide();
  $("#ver_consulta__").show();
  $("#signos__").hide();
  $("#ver_signo__").hide();
  $("#examenes___").hide();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/consultar',
    data: {
      id: id
    },
    success: function (r) {
      var padre = $("#consulta_body");
      padre.empty();
      var html_ = '<div class="row bg-blue" style="margin: 5px;"><center><h4><i class="fa fa-calendar"></i> ' + r.fecha + '</h4></center></div>';
      padre.append(html_);
      html_ = '<div class="row blue"><center><span>' + r.medico + '</span></center></div>';
      padre.append(html_);
      html_ = '<div id="bdy" style="overflow-y: scroll; overflow-x:hidden; height: 230px; width:97%"></div>';
      padre.append(html_);
      var panel = $("#bdy");
      html_ = '<br><div class="row bg-gray" style="margin: 5px"><center><span class="black"><b>Consulta por</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.motivo + '</p></div>';
      panel.append(html_);
      html_ = '<div class="row bg-gray black" style="margin: 5px"><center><span class="black"><b>Historia clínica</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.historia + '</p></div>';
      panel.append(html_);
      html_ = '<div class="row bg-gray black" style="margin: 5px"><center><span class="black"><b>Examen físico</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.examen_fisico + '</p></div>';
      panel.append(html_);
      html_ = '<div class="row bg-gray black" style="margin: 5px"><center><span class="black"><b>Diagnostico</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.diagnostico + '</p></div>';
      panel.append(html_);
    }
  });
}

function signos_load(id) {
  $("#informacion__").hide();
  $("#consultas__").hide();
  $("#ver_consulta__").hide();
  $("#signos__").hide();
  $("#ver_signo__").show();
  $("#examenes___").hide();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ver_signos',
    data: {
      id: id
    },
    success: function (r) {
      var padre = $("#signo_body");
      padre.empty();
      var html_ = '<div class="row bg-blue" style="margin: 5px;"><center><h4><i class="fa fa-calendar"></i> ' + r.fecha + '</h4></center></div>';
      padre.append(html_);
      html_ = '<div id="sbdy" style="overflow-y: scroll; overflow-x:hidden; height: 230px; width:97%"></div>';
      padre.append(html_);
      var panel = $("#sbdy");
      //Temperatura
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Temperatura: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.temperatura == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.temperatura > 37) {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.temperatura + ' °C</span>';
      } else {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.temperatura + ' °C</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Peso
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Peso: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.peso == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.peso + ' ' + ((r.signos.medida) ? 'Kg' : 'lb') + '</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Presion arterial
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Presión Arterial: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.sistole == null || r.signos.diastole == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if ((r.sexo &&
        (((r.edad >= 16 && r.edad <= 18) && (r.signos.sistole >= 105 && r.signos.sistole <= 135) && (r.signos.diastole >= 60 && r.signos.diastole <= 86)) ||
          ((r.edad >= 19 && r.edad <= 24) && (r.signos.sistole >= 105 && r.signos.sistole <= 139) && (r.signos.diastole >= 62 && r.signos.diastole <= 88)) ||
          ((r.edad >= 25 && r.edad <= 29) && (r.signos.sistole >= 108 && r.signos.sistole <= 139) && (r.signos.diastole >= 65 && r.signos.diastole <= 89)) ||
          ((r.edad >= 30 && r.edad <= 39) && (r.signos.sistole >= 110 && r.signos.sistole <= 145) && (r.signos.diastole >= 68 && r.signos.diastole <= 92)) ||
          ((r.edad >= 40 && r.edad <= 49) && (r.signos.sistole >= 110 && r.signos.sistole <= 150) && (r.signos.diastole >= 70 && r.signos.diastole <= 96)) ||
          ((r.edad >= 50 && r.edad <= 59) && (r.signos.sistole >= 115 && r.signos.sistole <= 155) && (r.signos.diastole >= 70 && r.signos.diastole <= 98)) ||
          ((r.edad >= 60) && (r.signos.sistole >= 115 && r.signos.sistole <= 160) && (r.signos.diastole >= 70 && r.signos.diastole <= 100)))) ||
        (!r.sexo &&
          (((r.edad >= 16 && r.edad <= 18) && (r.signos.sistole >= 100 && r.signos.sistole <= 130) && (r.signos.diastole >= 60 && r.signos.diastole <= 85)) ||
            ((r.edad >= 19 && r.edad <= 24) && (r.signos.sistole >= 100 && r.signos.sistole <= 130) && (r.signos.diastole >= 60 && r.signos.diastole <= 85)) ||
            ((r.edad >= 25 && r.edad <= 29) && (r.signos.sistole >= 102 && r.signos.sistole <= 135) && (r.signos.diastole >= 60 && r.signos.diastole <= 86)) ||
            ((r.edad >= 30 && r.edad <= 39) && (r.signos.sistole >= 105 && r.signos.sistole <= 139) && (r.signos.diastole >= 65 && r.signos.diastole <= 89)) ||
            ((r.edad >= 40 && r.edad <= 49) && (r.signos.sistole >= 105 && r.signos.sistole <= 150) && (r.signos.diastole >= 65 && r.signos.diastole <= 96)) ||
            ((r.edad >= 50 && r.edad <= 59) && (r.signos.sistole >= 110 && r.signos.sistole <= 155) && (r.signos.diastole >= 70 && r.signos.diastole <= 98)) ||
            ((r.edad >= 60) && (r.signos.sistole >= 115 && r.signos.sistole <= 160) && (r.signos.diastole >= 70 && r.signos.diastole <= 100))))
      ) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      } else if (r.edad < 16) {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Pulso
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Pulso: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.pulso == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.pulso > 59 && r.signos.pulso < 121) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.pulso + '  lpm</span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.pulso + '  lpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Glucosa
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Glucosa: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.glucosa == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.glucosa >= 70 && r.signos.glucosa <= 110) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.glucosa + '  mg / dl </span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.glucosa + '  mg / dl</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Altura
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Altura: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.altura == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.altura + '  cm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia cardiaca
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Frecuencia Cardiaca: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.frecuencia_cardiaca == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.frecuencia_cardiaca >= 60 && r.signos.frecuencia_cardiaca <= 101) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.frecuencia_cardiaca + '  lpm </span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.frecuencia_cardiaca + ' lpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia Respiratoria
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Frecuencia Respiratoria: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.frecuencia_respiratoria == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.frecuencia_respiratoria >= 12 && r.signos.frecuencia_respiratoria <= 20) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.frecuencia_respiratoria + '  rpm </span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.frecuencia_respiratoria + ' rpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Indice de masa corporal
      if (r.signos.altura != null && r.signos.peso != null) {
        var peso = parseFloat(r.signos.peso);
        peso *= (r.signos.medida) ? 1 : 0.453592;
      }
    }
  });
}