function eliminar_ingreso(id) {
  return swal({
    title: 'Eliminar registro',
    text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Eliminar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      var dominio = window.location.host;
      $('#formulario').attr('action', $('#guardarruta').val() + '/desactivateIngreso/' + id);
      localStorage.setItem('msg', 'yes');
      $('#formulario').submit();
    }
  });
}

function confirmar_ingreso(id) {
  return swal({
    title: 'Confirmar ingreso',
    text: '¡El paciente estará ingresado!',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Confirmar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      var dominio = window.location.host;
      $('#formulario').attr('action', $('#guardarruta').val() + '/activateIngreso/' + id);
      localStorage.setItem('msg', 'yes');
      $('#formulario').submit();
    }
  });
}

$("#btn_v_p").on('click', function (e) {
  e.preventDefault();
  medicamento_fecha();
});
$("#fecha_producto").on('change', function () {
  medicamento_fecha();
});
$("#fecha_servicio").on('change', function () {
  servicio_fecha();
});
$("#btn_v_s").on('click', function (e) {
  e.preventDefault();
  servicio_fecha();
});
$("#fecha_examen").on('change', function () {
  laboratorio_fecha();
});
$("#btn_v_l").on('click', function (e) {
  e.preventDefault();
  laboratorio_fecha();
  laboratorio_pendientes_ver();
});
$("#fecha_rayo").on("change", function () {
  rayos_fecha();
});
$("#btn_v_r").on('click', function (e) {
  e.preventDefault();
  rayos_fecha();
});
$("#fecha_ultra").on("change", function () {
  ultra_fecha();
});
$("#btn_v_u").on('click', function (e) {
  e.preventDefault();
  ultra_fecha();
});
$("#fecha_tac").on("change", function () {
  tac_fecha();
});
$("#btn_v_t").on('click', function (e) {
  e.preventDefault();
  tac_fecha();
});
$("#fecha_finanza").on("change", function () {
  var id = $("#id").val();
  var fecha = $("#fecha_finanza").val();
  resumen(id, fecha);
});
$("#btn_v_f").on('click', function (e) {
  e.preventDefault();
  var id = $("#id").val();
  var fecha = $("#fecha_finanza").val();
  resumen(id, fecha);
});
$("#fecha_signo").on("change", function () {
  signos_fecha();
});

function medicamento_fecha() {
  var fecha = $("#fecha_producto").val();
  var id = $("#id").val();
  var tipo_usuario = $("#tipo_usuario").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/lista_producto',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
			console.log(r);
      var panel = $("#mensaje_v_p");
      fecha_title = $("#date_");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-hover table-striped table-sm" id="tabla_v_p">' +
          '<thead>' +
          '<th>Hora</th>' +
					'<th>Detalle</th>' +
					'<th>Precio U</th>' +
					'<th>Total</th>'+
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_p");
        $(r.productos).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            value.cantidad + " " + value.division + ' <b class="">' + value.nombre + '</b>' +
						'</td>';
					html += '<td>' + "$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) + '</td>';
					html += '<td>' + "$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(value.total) + '</td>';
					html += '<td><center><div class="btn-group">';
					html += edit_button(value.id, value.cantidad, value.precio);
					if (!value.estado) {
						html += '<button type="button" id = "' + value.id + '" class="btn btn-success btn-sm" onclick="accion24(2,' + value.id + ',this)"><i class="fa fa-check"></i></button>';
					}
					html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-times"></i></button></div></center></td>';
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningún medicamento al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function servicio_fecha() {
  var fecha = $("#fecha_servicio").val();
  var id = $("#id").val();
  var tipo_usuario = $("#tipo_usuario").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/lista_servicio',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_v_s");
      fecha_title = $("#date_s");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-hover table-sm table-striped" id="tabla_v_s">' +
          '<thead>' +
          '<th>Hora</th>' +
					'<th>Detalle</th>' +
					'<th>Precio U</th>' +
					'<th>Total</th>' +
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_s");
        $(r.servicios).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            value.cantidad + " " + ' <b class="">' + value.nombre + '</b>' +
            '</td>';
					html += '<td>' + "$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) + '</td>';
					html += '<td>' + "$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(value.total) + '</td>';
					html += '<td><center><div class="btn-group">';
					html += edit_button(value.id, value.cantidad, value.precio);
					html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-times"></i></button></div></center></td>';
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningún servicio al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function rayos_fecha() {
  var fecha = $("#fecha_rayo").val();
  var id = $("#id").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_rayos',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_v_r");
      fecha_title = $("#date_r");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-striped table-hover table-sm" id="tabla_v_r">' +
          '<thead>' +
          '<th style="width: 150px">Hora</th>' +
          '<th>Detalle</th>' +
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_r");
        $(r.rayox).each(function (key, value) {
					html = '<tr id="r' + value.id + '">' +
						'<td>' + value.hora + '</td>' +
						'<td>' +
						' <b class="">' + value.nombre + '</b>';
					if (value.actual) {
						html += '<span class="badge badge-warning float-right" title="Actual">A</span>';
					}
					html += '</td>';
          if (value.estado == 0) {
            html += '<td><span class="badge font-sm mb-1 badge-secondary col-sm-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span></td>';
          } else if (value.estado == 1) {
						html += '<td><center><div class="btn-group"><button type="button" class="btn btn-primary btn-sm disabled" title="Evaluando"><i class="fas fa-cog"></i></button>';
						html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(4,' + value.id + ',this)"><i class="fa fa-times"></i></button></div></center></td>';
					} else {
						if ($("#tipo_usuario").val() == "Médico") {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" data-toggle="modal" data-target="#ver_ev_pac" onclick="ver_evaluacion_completa(' + value.id + ',' + value.f_ultrasonografia + ',' + value.estado + ',0)"><i class="fas fa-eye"></i></button></center></td>';
						} else {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" disabled><i class="fas fa-check"></i></button></center></td>';
						}
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningún examen de rayos X al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function laboratorio_fecha() {
  var fecha = $("#fecha_examen").val();
  var id = $("#id").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_laboratorio',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_v_l");
      fecha_title = $("#date_l");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-striped table-hover table-sm" id="tabla_v_l">' +
          '<thead>' +
          '<th>Hora</th>' +
          '<th>Detalle</th>' +
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_l");
        $(r.laboratorio).each(function (key, value) {
					html = '<tr id="r' + value.id + '">' +
						'<td>' + value.hora + '</td>' +
						'<td>' +
						value.muestra + " " + ' <b class="">' + value.nombre + '</b>';
					if (value.actual) {
						html += '<span class="badge badge-warning float-right" title="Actual">A</span>';
					}
          html += '</td>';
					if (value.estado == 0) {
						html += '<td><center><button type="button" class="btn btn-sm disabled" title="Pendiente"><i class="fas fa-spinner"></i></button></center></td>';
          } else if (value.estado == 1) {
						html += '<td><center><div class="btn-group"><button type="button" class="btn btn-primary btn-sm disabled" title="Evaluando"><i class="fas fa-cog"></i></button>';
						html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(4,' + value.id + ',this)"><i class="fa fa-times"></i></button></div></center></td>';
          } else {
						if ($("#tipo_usuario").val() == "Médico") {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" data-toggle="modal" data-target="#ver_examen_pac" onclick="ver_examen_completo(' + value.id + ',' + value.f_examen + ',' + value.estado + ')"><i class="fas fa-eye"></i></button></center></td>';
						} else {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" disabled><i class="fas fa-check"></i></button></center></td>';
						}
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningún examen al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}
function ultra_fecha() {
  var fecha = $("#fecha_ultra").val();
  var id = $("#id").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_ultra',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_v_u");
      fecha_title = $("#date_u");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-striped table-hover table-sm" id="tabla_v_u">' +
          '<thead>' +
          '<th style="width: 150px">Hora</th>' +
          '<th>Detalle</th>' +
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_u");
        $(r.ultra).each(function (key, value) {
					html = '<tr id="r' + value.id + '">' +
						'<td>' + value.hora + '</td>' +
						'<td>' +
						' <b class="">' + value.nombre + '</b>';
					if (value.actual) {
						html += '<span class="badge badge-warning float-right" title="Actual">A</span>';
					}
					html += '</td>';
          if (value.estado == 0) {
						html += '<td><span class="badge font-sm mb-1 badge-secondary col-sm-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span>';
						html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-times"></i></button></td>';
          } else if (value.estado == 1) {
						html += '<td><center><div class="btn-group"><button type="button" class="btn btn-primary btn-sm disabled" title="Evaluando"><i class="fas fa-cog"></i></button>';
						html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(4,' + value.id + ',this)"><i class="fa fa-times"></i></button></div></center></td>';
					} else {
						if ($("#tipo_usuario").val() == "Médico") {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" data-toggle="modal" data-target="#ver_ev_pac" onclick="ver_evaluacion_completa(' + value.id + ',' + value.f_ultrasonografia + ',' + value.estado + ',1)"><i class="fas fa-eye"></i></button></center></td>';
						} else {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" disabled><i class="fas fa-check"></i></button></center></td>';
						}
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ninguna ultrasonografía al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function tac_fecha() {
  var fecha = $("#fecha_tac").val();
  var id = $("#id").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_tac',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_v_t");
      fecha_title = $("#date_t");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-striped table-hover table-sm" id="tabla_v_t">' +
          '<thead>' +
          '<th style="width: 150px">Hora</th>' +
          '<th>Detalle</th>' +
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_t");
        $(r.tac).each(function (key, value) {
					html = '<tr id="r' + value.id + '">' +
						'<td>' + value.hora + '</td>' +
						'<td>' +
						' <b class="">' + value.nombre + '</b>';
					if (value.actual) {
						html += '<span class="badge badge-warning float-right" title="Actual">A</span>';
					}
					html += '</td>';
          if (value.estado == 0) {
            html += '<td><span class="badge font-sm mb-1 badge-secondary col-sm-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span></td>';
          } else if (value.estado == 1) {
						html += '<td><center><div class="btn-group"><button type="button" class="btn btn-primary btn-sm disabled" title="Evaluando"><i class="fas fa-cog"></i></button>';
						html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(4,' + value.id + ',this)"><i class="fa fa-times"></i></button></div></center></td>';
          } else {
						if ($("#tipo_usuario").val() == "Médico") {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" data-toggle="modal" data-target="#ver_ev_pac" onclick="ver_evaluacion_completa(' + value.id + ',' + value.f_tac + ',' + value.estado + ',2)"><i class="fas fa-eye"></i></button></center></td>';
						} else {
							html += '<td><center><button type="button" class="btn btn-success btn-sm" title="Listo" disabled><i class="fas fa-check"></i></button></center></td>';
						}
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningún tac al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function signos_fecha() {
  var fecha = $("#fecha_signo").val();
  var id = $("#id").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_signos',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_sv");
      fecha_title = $("#date_sv");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="w-100">' +
          '<table class="table table-striped table-sm table-hover" id="tabla_sv">' +
          '<thead>' +
          '<th class="w-75">Hora</th>' +
          '<th class="w-25">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_sv");
        $(r.signos).each(function (key, value) {
          html = '<tr>' +
            '<td>' +
            value.hora +
            '</td>';
          html += '<td><center><button type="button" id = "' + value.id + '" class="btn btn-primary btn-sm" onclick="carga_signos(' + value.id + ')"><i class="fa fa-eye"></i></button></center></td>';
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ninguna evaluación de signos vitales al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function laboratorio_pendientes_ver() {
  var fecha = $("#fecha_examen").val();
  var id = $("#id").val();

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_laboratorio',
    data: {
      id: id,
      fecha: fecha,
      pendiente: true
    },
    success: function (r) {
      var panel = $("#mensaje_l");

      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-sm-12">' +
          '<table class="table table-striped table-hover table-sm" id="tabla_l">' +
          '<thead>' +
          '<th style="width: 100px;">Fecha</th>' +
          '<th>Detalle</th>' +
          '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_l");
        $(r.laboratorio).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            value.muestra + " " + ' <b class="">' + value.nombre + '</b>' +
            '</td>';
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No hay examenes pendiente de evaluación de este paciente</span></center>';
        panel.append(html);
      }
    }
  });
}

$("#guardar_cambio_habitacion").on("click", function (e) {
  e.preventDefault();
  cama = $("#f_cama").val();
  id = $("#id").val();
  console.log(cama);
  if (cama != null) {
    $.ajax({
      url: $('#guardarruta').val() + "/cambio_ingreso",
      type: "post",
      data: {
        f_cama: cama,
        ingreso: id,
      },
      success: function (r) {
        if (r == 1) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        } else {
          swal('¡Error!', 'Algo salio mal', 'error');
        }
      }
    });
  } else {
    swal({
      title: '¡Error!',
      text: 'Es necesario que haya al menos una habitación disponible',
      type: 'error',
      toast: true,
      timer: 4000,
      showConfirmButton: false
    });
  }
});

$("#cambio_hospitalizacion_").on("click", function (e) {
  activo = $("#activo").val();
  if (activo == 0) {
    cama = $("#f_cama_i").val();
  } else if (activo == 1) {
    cama = $("#f_cama_m").val();
  } else {
    cama = $("#f_cama_o").val();
  }
  id = $("#id").val();
  if (cama != null) {
    $.ajax({
      url: $('#guardarruta').val() + "/cambio_ingreso",
      type: "post",
      data: {
        tipo: activo,
        f_cama: cama,
        ingreso: id,
      },
      success: function (r) {
        if (r == 1) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        } else {
          swal('¡Error!', 'Algo salio mal', 'error');
        }
      }
    });
  } else {
    swal({
      title: '¡Error!',
      text: 'Es necesario que haya al menos una habitación disponible',
      type: 'error',
      toast: true,
      timer: 4000,
      showConfirmButton: false
    });
  }
});

function ultra_rayos(tipo) {
  var rayo = $("#f_rayo").val();
  var ultra = $("#f_ultra").val();
  var tac = $("#f_tac").val();
  var paciente = $("#id_p").val();
  var transaccion_id = $("#id_t").val();
  var id = $("#id").val();
  if (tipo == 1) {
    $.ajax({
      url: $('#guardarruta').val() + "/solicitudex",
      type: "POST",
      data: {
        f_paciente: paciente,
        ultrasonografia: ultra,
        f_ingreso: id,
        transaccion: transaccion_id,
        tipo: "ultras"
      },
      success: function (respuesta) {
        if (respuesta) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        }
      }
    });
  } else if (tipo == 2) {
    $.ajax({
      url: $('#guardarruta').val() + "/solicitudex",
      type: "POST",
      data: {
        f_paciente: paciente,
        rayox: rayo,
        f_ingreso: id,
        transaccion: transaccion_id,
        tipo: "rayosx"
      },
      success: function (respuesta) {
        if (respuesta) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        }
      }
    });
  } else {
    $.ajax({
      url: $('#guardarruta').val() + "/solicitudex",
      type: "POST",
      data: {
        f_paciente: paciente,
        tac: tac,
        f_ingreso: id,
        transaccion: transaccion_id,
        tipo: "tac"
      },
      success: function (respuesta) {
        if (respuesta) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        }
      }
    });
  }
}

function carga_signos(id) {
  $.ajax({
    type: "get",
    url: $('#guardarruta').val() + "/ver_signos",
    data: {
      id: id
    },
    success: function (r) {
      var super_ = $("#mensaje_v_sv");
      super_.empty();
      $("#date_sv_2").text(r.fecha);
      var html_ = '<div class="col-sm-6" id="izq"></div><div class="col-sm-6" id="der">';
      super_.append(html_);
      var panel = $("#izq");
      //Temperatura
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Temperatura: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.temperatura == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else if (r.signos.temperatura > 37) {
        html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">' + r.signos.temperatura + ' °C</span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">' + r.signos.temperatura + ' °C</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Peso
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Peso: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.peso == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-white col-sm-12">' + r.signos.peso + ' ' + ((r.signos.medida) ? 'Kg' : 'lb') + '</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Presion arterial
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Presión Arterial: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.sistole == null || r.signos.diastole == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
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
        html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      } else if (r.edad < 16) {
        html_ += '<span class="badge font-sm mb-1 badge-white col-sm-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Pulso
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Pulso: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.pulso == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else if (r.signos.pulso > 59 && r.signos.pulso < 121) {
        html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">' + r.signos.pulso + '  lpm</span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">' + r.signos.pulso + '  lpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Glucosa
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Glucosa: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.glucosa == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else if (r.signos.glucosa >= 70 && r.signos.glucosa <= 110) {
        html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">' + r.signos.glucosa + '  mg / dl </span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">' + r.signos.glucosa + '  mg / dl</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      var panel = $("#der");
      //Altura
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Altura: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.altura == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-white col-sm-12">' + r.signos.altura + '  cm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia cardiaca
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Frecuencia Cardiaca: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.frecuencia_cardiaca == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else if (r.signos.frecuencia_cardiaca >= 60 && r.signos.frecuencia_cardiaca <= 101) {
        html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">' + r.signos.frecuencia_cardiaca + '  lpm </span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">' + r.signos.frecuencia_cardiaca + ' lpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia Respiratoria
      html_ = '<div class="row">' +
        '<div class="col-sm-6">Frecuencia Respiratoria: </div>' +
        '<div class="col-sm-6">';
      if (r.signos.frecuencia_respiratoria == null) {
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
      } else if (r.signos.frecuencia_respiratoria >= 12 && r.signos.frecuencia_respiratoria <= 20) {
        html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">' + r.signos.frecuencia_respiratoria + '  rpm </span>';
      } else {
        html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">' + r.signos.frecuencia_respiratoria + ' rpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Indice de masa corporal
      if (r.signos.altura != null && r.signos.peso != null) {
        var peso = parseFloat(r.signos.peso);
        peso *= (r.signos.medida) ? 1 : 0.453592;
        var altura = parseFloat(r.signos.altura);
        altura = altura / 100;
        var imc = (peso / (altura * altura));
        html_ = '<div class="row">' +
          '<div class="col-sm-6">Índice de Masa Corporal: </div>' +
          '<div class="col-sm-6">';
        if (imc < 18.5) {
          html_ += '<span class="badge font-sm mb-1 badge-warning col-sm-12">Bajo peso</span>';
        } else if (imc >= 18.5 && imc < 25) {
          html_ += '<span class="badge font-sm mb-1 badge-success col-sm-12">Peso normal</span>';
        } else if (imc >= 25 && imc < 30) {
          html_ += '<span class="badge font-sm mb-1 badge-warning col-sm-12">Sobrepeso</span>';
        } else if (imc >= 30 && imc < 35) {
          html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">Obesidad I</span>';
        } else if (imc >= 35 && imc < 40) {
          html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">Obesidad II</span>';
        } else if (imc >= 40 && imc < 50) {
          html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">Obesidad III</span>';
        } else {
          html_ += '<span class="badge font-sm mb-1 badge-danger col-sm-12">Obesidad IV</span>';
        }
        html_ += '</div>' +
          '</div>';
        panel.append(html_);
      } else {
        html_ = '<div class="row">' +
          '<div class="col-sm-6">Índice de Masa Corporal: </div>' +
          '<div class="col-sm-6">';
        html_ += '<span class="badge font-sm mb-1 badge-secondary col-sm-12">Vacio</span>';
        html_ += '</div>' +
          '</div>';
        panel.append(html_);
      }
    }
  });
}
/**Evento para mostrar los datos del médico */
function ver_medico(servicio) {
  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/ingreso/lista_medico',
    data: {
      i_id: $("#id").val(),
      id: servicio
    },
    success: function (r) {
      $("#img-foto").attr('src', r.foto);
      $("#nombre").text(r.nombre);
      $("#especial").text((r.especialidad == "Ninguna") ? r.especialidad : r.especialidad.nombre);

      var panel = $("#mensaje_v_m");

      panel.empty();
      html = '<div class="col-sm-12">' +
        '<table class="table table-striped table-hover table-sm" id="tabla_v_m">' +
        '<thead>' +
        '<th>Fecha</th>' +
				'<th>Hora</th>' +
				'<th>Precio</th>' +
        '<th class="w-25">Acción</th>'
      '</thead>' +
        '</table>' +
        '</div>';
      panel.append(html);
      tabla = $("#tabla_v_m");
      $(r.consultas).each(function (key, value) {
        html = '<tr id="r' + value.id + '">' +
					'<td>' + value.fecha + '</td>' +
					'<td>' + value.hora + '</td>'+
					'<td>' + "$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) + '</td>';
        if (value.estado == 1) {
					html += '<td><center><div class="btn-group">';
					html += '<button type="button" id = "' + value.id + '" class="btn btn-primary btn-sm" onclick="accion24(5,' + value.id + ','+value.precio+')"><i class="fa fa-edit"></i></button>';
					html += '<button type="button" id = "' + value.id + '" class="btn btn-danger btn-sm" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-times"></i></button>';
					html += '</div></center></td>';
        } else {
					html += '<td><center><div class="btn-group">';
					html += '<button type="button" id = "' + value.id + '" class="btn btn-primary btn-sm" onclick="accion24(5,' + value.id + ','+value.precio+')"><i class="fa fa-edit"></i></button>';
					html+='<button type="button" class="btn btn-light btn-sm" disabled><i class="fa fa-ban"></i></button>';
					html += '</div></center></td>';
        }
        html += '</tr>';
        tabla.append(html);
      });
    }
  });
}

/**MAR9 . Función para realizar la edición de precio desde hospitalización */
function edit_button(id, cantidad, precio) {
	let html = '<div class="btn-group">';
	html += '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
	html += '<i class="fas fa-edit"></i>';
	html += '</button>';
	html += '<div class="dropdown-menu">';
	html += '<a class="dropdown-item" href="#" onclick="accion24(1,' + id + ',' + cantidad + ')">Cantidad</a>';
	html += '<a class="dropdown-item" href="#" onclick="accion24(6,' + id + ',' + precio + ')">Precio Unitario</a>';
	html += '</div>';
	html += '</div>';

	return html;
}

/**ABR3.20 Función para que enfermería pueda leer las recetas */
$("#ver_receta_e").click(function (e) { 
	ver_receta_(this);
});

/**ABR22.20 Cambio de estado del iva */
$("#cambiar_estado_iva").click(function (e) {
	$.ajax({
		type: 'post',
		url: $('#guardarruta').val() + '/ingreso/estado_iva',
		data: {
			i_id: $("#id").val()
		},
		success: function (r) {
			if (r == 1) {
				localStorage.setItem('msg', 'yes');
				location.reload();
			}
		}
	});
 });