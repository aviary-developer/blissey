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
  } else {
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
  }
}