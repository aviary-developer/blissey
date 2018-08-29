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
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    var dominio = window.location.host;
    $('#formulario').attr('action', 'http://' + dominio + '/blissey/public/desactivateIngreso/' + id);
    $('#formulario').submit();
    swal({
      type: 'success',
      title: '¡Ingresado!',
      text: 'Acción realizada satisfactoriamente',
      showConfirmButton: false
    });
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal(
        'Cancelado',
        'El registro se mantiene',
        'info'
      )
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
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    var dominio = window.location.host;
    $('#formulario').attr('action', 'http://' + dominio + '/blissey/public/activateIngreso/' + id);
    $('#formulario').submit();
    swal({
      type: 'success',
      title: '¡Ingresado!',
      text: 'Acción realizada satisfactoriamente',
      showConfirmButton: false
    });
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal({
        type: 'info',
        title: 'Cancelado',
        text: 'El registro se mantiene'
      });
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
  resumen(id,fecha);
});
$("#btn_v_f").on('click', function (e) {
  e.preventDefault();
  var id = $("#id").val();
  var fecha = $("#fecha_finanza").val();
  resumen(id,fecha);
});
$("#fecha_signo").on("change", function () {
  signos_fecha();
});

function medicamento_fecha() {
  var fecha = $("#fecha_producto").val();
  var id = $("#id").val();
  
  $.ajax({
    type: 'get',
    url: '/blissey/public/lista_producto',
    data: {
      id: id,
      fecha: fecha
    },
    success: function (r) {
      var panel = $("#mensaje_v_p");
      fecha_title = $("#date_");
      fecha_title.text(r.fecha_f);
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_v_p">' +
          '<thead>' +
          '<th>Hora</th>'+
          '<th>Detalle</th>' +
          '<th style="width: 40px">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_p");
        $(r.productos).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>'+ value.hora +'</td>'+
            '<td>' +
            value.cantidad + " " + value.division + ' <b class="big-text">' + value.nombre + '</b>'+
            '</td>';
          if (value.estado == 1) {
            html += '<td><button type="button" id = "'+ value.id +'" class="btn btn-danger btn-xs" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-remove"></i></button></td>';
          } else {
            html += '<td><button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-ban"></i></button></td>';
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningun medicamento al paciente en esta fecha</span></center>';
        panel.append(html);
      }
    }
  });
}

function servicio_fecha() {
  var fecha = $("#fecha_servicio").val();
  var id = $("#id").val();
  
  $.ajax({
    type: 'get',
    url: '/blissey/public/lista_servicio',
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
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_v_s">' +
          '<thead>' +
          '<th>Hora</th>' +
          '<th>Detalle</th>' +
          '<th style="width: 40px">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_s");
        $(r.servicios).each(function (key, value) {
          html = '<tr id="r' + value.id +'">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            value.cantidad + " " + ' <b class="big-text">' + value.nombre + '</b>' +
            '</td>';
          if (value.estado == 1) {
            html += '<td><button type="button" id = "' + value.id + '" class="btn btn-danger btn-xs" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-remove"></i></button></td>';
          } else {
            html += '<td><button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-ban"></i></button></td>';
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningun servicio al paciente en esta fecha</span></center>';
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
    url: '/blissey/public/ingreso/lista_rayos',
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
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_v_r">' +
          '<thead>' +
          '<th style="width: 150px">Hora</th>' +
          '<th>Detalle</th>' +
          '<th style="width: 40px">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_r");
        $(r.rayox).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            ' <b class="big-text">' + value.nombre + '</b>' +
            '</td>';
          if (value.estado == 0) {
            html += '<td><span class="label label-lg label-default col-xs-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span></td>';
          } else if(value.estado == 1) {
            html += '<td><span class="label label-lg label-primary col-xs-10" data-toggle="tooltip" data-placement="top" title="Evaluando"><i class="fa fa-cog"></i></span></td>';
          } else {
            html += '<td><span class="label label-lg label-success col-xs-10" data-toggle="tooltip" data-placement="top" title="Listo"><i class="fa fa-check"></i></span></td>';
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningun examen de rayos X al paciente en esta fecha</span></center>';
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
    url: '/blissey/public/ingreso/lista_laboratorio',
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
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_v_l">' +
          '<thead>' +
          '<th>Hora</th>' +
          '<th>Detalle</th>' +
          '<th style="width: 40px">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_l");
        $(r.laboratorio).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            value.muestra + " " + ' <b class="big-text">' + value.nombre + '</b>' +
            '</td>';
          if (value.estado == 0) {
            html += '<td><span class="label label-lg label-default col-xs-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span></td>';
          } else if (value.estado == 1) {
            html += '<td><span class="label label-lg label-primary col-xs-10" data-toggle="tooltip" data-placement="top" title="Evaluando"><i class="fa fa-cog"></i></span></td>';
          } else {
            html += '<td><span class="label label-lg label-success col-xs-10" data-toggle="tooltip" data-placement="top" title="Listo"><i class="fa fa-check"></i></span></td>';
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningun examen al paciente en esta fecha</span></center>';
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
    url: '/blissey/public/ingreso/lista_ultra',
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
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_v_u">' +
          '<thead>' +
          '<th style="width: 150px">Hora</th>' +
          '<th>Detalle</th>' +
          '<th style="width: 40px">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_u");
        $(r.ultra).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            ' <b class="big-text">' + value.nombre + '</b>' +
            '</td>';
          if (value.estado == 0) {
            html += '<td><span class="label label-lg label-default col-xs-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span></td>';
          } else if (value.estado == 1) {
            html += '<td><span class="label label-lg label-primary col-xs-10" data-toggle="tooltip" data-placement="top" title="Evaluando"><i class="fa fa-cog"></i></span></td>';
          } else {
            html += '<td><span class="label label-lg label-success col-xs-10" data-toggle="tooltip" data-placement="top" title="Listo"><i class="fa fa-check"></i></span></td>';
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
    url: '/blissey/public/ingreso/lista_tac',
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
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_v_t">' +
          '<thead>' +
          '<th style="width: 150px">Hora</th>' +
          '<th>Detalle</th>' +
          '<th style="width: 40px">Acción</th>'
        '</thead>' +
          '</table>' +
          '</div>';
        panel.append(html);
        tabla = $("#tabla_v_t");
        $(r.tac).each(function (key, value) {
          html = '<tr id="r' + value.id + '">' +
            '<td>' + value.hora + '</td>' +
            '<td>' +
            ' <b class="big-text">' + value.nombre + '</b>' +
            '</td>';
          if (value.estado == 0) {
            html += '<td><span class="label label-lg label-default col-xs-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span></td>';
          } else if (value.estado == 1) {
            html += '<td><span class="label label-lg label-primary col-xs-10" data-toggle="tooltip" data-placement="top" title="Evaluando"><i class="fa fa-cog"></i></span></td>';
          } else {
            html += '<td><span class="label label-lg label-success col-xs-10" data-toggle="tooltip" data-placement="top" title="Listo"><i class="fa fa-check"></i></span></td>';
          }
          html += '</tr>';
          tabla.append(html);
        });
      } else {
        panel.empty();
        html = '<center style="margin-top: 30px"><i class="fa fa-info-circle gray" style="font-size: 800%"></i></center><center style="margin-top: 40px"><h5 class="gray big-text">Información<h5></center><center><span>No se ha registrado ningun tac al paciente en esta fecha</span></center>';
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
    url: '/blissey/public/ingreso/lista_signos',
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
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_sv">' +
          '<thead>' +
          '<th>Hora</th>' +
          '<th style="width: 40px">Acción</th>'
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
          html += '<td><button type="button" id = "' + value.id + '" class="btn btn-primary btn-xs" onclick="carga_signos(' + value.id + ')"><i class="fa fa-eye"></i></button></td>';
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
    url: '/blissey/public/ingreso/lista_laboratorio',
    data: {
      id: id,
      fecha: fecha,
      pendiente: true
    },
    success: function (r) {
      var panel = $("#mensaje_l");
      
      if (r.indice > 0) {
        panel.empty();
        html = '<div class="col-xs-12">' +
          '<table class="table" id="tabla_l">' +
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
            value.muestra + " " + ' <b class="big-text">' + value.nombre + '</b>' +
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
  habitacion = $("#f_habitacion").val();
  id = $("#id").val();
  token = $("#token").val();
  if (habitacion != 0) {
    $.ajax({
      url: "/blissey/public/cambio_ingreso",
      type: "post",
      headers: { 'X-CSRF-TOKEN': token },
      data: {
        f_habitacion: habitacion,
        ingreso: id,
      },
      success: function (r) {
        if (r == 1) {
          swal({
            type: 'success',
            title: '¡Hecho!',
            text: 'Cambio exitoso',
            showConfirmButton: false
          });
          location.reload();
        } else {
          swal('¡Error!', 'Algo salio mal', 'error');
        }
      }
    });
  } else {
    swal('¡Error!', 'Es necesario que haya al menos una habitación disponible', 'error');
  }
});

function cambio_tipo_activo(tipo) {
  $("#activo").val(tipo);
}

$("#cambio_hospitalizacion_").on("click", function (e) { 
  activo = $("#activo").val();
  if (activo == 0) {
    habitacion = $("#f_habitacion_i").val();
  } else if (activo == 1) {
    habitacion = $("#f_habitacion_m").val();
  } else {
    habitacion = $("#f_habitacion_o").val();
  }
  id = $("#id").val();
  token = $("#token").val();
  if (habitacion != 0) {
    $.ajax({
      url: "/blissey/public/cambio_ingreso",
      type: "post",
      headers: { 'X-CSRF-TOKEN': token },
      data: {
        tipo: activo,
        f_habitacion: habitacion,
        ingreso: id,
      },
      success: function (r) {
        if (r == 1) {
          swal({
            type: 'success',
            title: '¡Hecho!',
            text: 'Cambio exitoso',
            showConfirmButton: false
          });
          location.reload();
        } else {
          swal('¡Error!', 'Algo salio mal', 'error');
        }
      }
    });
  } else {
    swal('¡Error!', 'Es necesario que haya al menos una habitación disponible', 'error');
  }
});

function ultra_rayos(tipo) {
  var rayo = $("#f_rayo").val();
  var ultra = $("#f_ultra").val();
  var tac = $("#f_tac").val();
  var token = $("#token").val();
  var paciente = $("#id_p").val();
  var transaccion_id = $("#id_t").val();
  var id = $("#id").val();
  if (tipo == 1) {
    $.ajax({
      url: "/blissey/public/solicitudex",
      headers: { 'X-CSRF-TOKEN': token },
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
          swal({
            title: "¡Hecho!",
            text: "Solicitud enviada satisfactoriamente",
            type: "success",
            showConfirmButton: false,
          });
          location.reload();
        }
      }
    });
  } else if(tipo == 2) {
    $.ajax({
      url: "/blissey/public/solicitudex",
      headers: { 'X-CSRF-TOKEN': token },
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
          swal({
            title: "¡Hecho!",
            text: "Solicitud enviada satisfactoriamente",
            type: "success",
            showConfirmButton: false,
          });
          location.reload();
        }
      }
    });
  } else {
    $.ajax({
      url: "/blissey/public/solicitudex",
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
          swal({
            title: "¡Hecho!",
            text: "Solicitud enviada satisfactoriamente",
            type: "success",
            showConfirmButton: false,
          });
          location.reload();
        }
      }
    });
  }
}

function carga_signos(id) {
  $.ajax({
    type: "get",
    url: "/blissey/public/ver_signos",
    data: {
      id: id
    },
    success: function (r) {
      var super_ = $("#mensaje_v_sv");
      super_.empty();
      $("#date_sv_2").text(r.fecha);
      var html_ = '<div class="col-xs-6" id="izq"></div><div class="col-xs-6" id="der">';
      super_.append(html_);
      var panel = $("#izq");
      //Temperatura
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Temperatura: </div>' +
        '<div class="col-xs-5">';
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
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Peso: </div>' +
        '<div class="col-xs-5">';
      if (r.signos.peso == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.peso + ' ' + ((r.signos.medida) ? 'Kg' : 'lb') + '</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Presion arterial
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Presión Arterial: </div>' +
        '<div class="col-xs-5">';
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
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Pulso: </div>' +
        '<div class="col-xs-5">';
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
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Glucosa: </div>' +
        '<div class="col-xs-5">';
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
      var panel = $("#der");
      //Altura
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Altura: </div>' +
        '<div class="col-xs-5">';
      if (r.signos.altura == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.altura + '  cm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia cardiaca
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Frecuencia Cardiaca: </div>' +
        '<div class="col-xs-5">';
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
      html_ = '<div class="row">' +
        '<div class="col-xs-7">Frecuencia Respiratoria: </div>' +
        '<div class="col-xs-5">';
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
        var altura = parseFloat(r.signos.altura);
        altura = altura / 100;
        var imc = (peso / (altura * altura));
        html_ = '<div class="row">' +
          '<div class="col-xs-7">Índice de Masa Corporal: </div>' +
          '<div class="col-xs-5">';
        if (imc < 18.5) {
          html_ += '<span class="label label-lg label-warning col-xs-12">Bajo peso</span>';
        } else if (imc >= 18.5 && imc < 25) {
          html_ += '<span class="label label-lg label-success col-xs-12">Peso normal</span>';
        } else if (imc >= 25 && imc < 30) {
          html_ += '<span class="label label-lg label-warning col-xs-12">Sobrepeso</span>';
        } else if (imc >= 30 && imc < 35) {
          html_ += '<span class="label label-lg label-danger col-xs-12">Obesidad I</span>';
        } else if (imc >= 35 && imc < 40) {
          html_ += '<span class="label label-lg label-danger col-xs-12">Obesidad II</span>';
        } else if (imc >= 40 && imc < 50) {
          html_ += '<span class="label label-lg label-danger col-xs-12">Obesidad III</span>';
        } else {
          html_ += '<span class="label label-lg label-danger col-xs-12">Obesidad IV</span>';
        }
        html_ += '</div>' +
          '</div>';
        panel.append(html_);
      } else {
        html_ = '<div class="row">' +
          '<div class="col-xs-7">Índice de Masa Corporal: </div>' +
          '<div class="col-xs-5">';
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
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
    url: '/blissey/public/ingreso/lista_medico',
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
      html = '<div class="col-xs-12">' +
        '<table class="table" id="tabla_v_m">' +
        '<thead>' +
        '<th>Fecha</th>' +
        '<th>Hora</th>' +
        '<th style="width: 40px">Acción</th>'
      '</thead>' +
        '</table>' +
        '</div>';
      panel.append(html);
      tabla = $("#tabla_v_m");
      $(r.consultas).each(function (key, value) {
        html = '<tr id="r' + value.id + '">' +
          '<td>' + value.fecha + '</td>' +
          '<td>' + value.hora + '</td>';
        if (value.estado == 1) {
          html += '<td><button type="button" id = "' + value.id + '" class="btn btn-danger btn-xs" onclick="accion24(3,' + value.id + ',this)"><i class="fa fa-remove"></i></button></td>';
        } else {
          html += '<td><button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-ban"></i></button></td>';
        }
        html += '</tr>';
        tabla.append(html);
      });
    }
  });
}