$(document).on('ready', function () {
  var ubicacion = window.location.pathname;

  if (ubicacion.indexOf("/blissey/public/ingresos/create") > -1) {
    cargar_municipio();
  }

  function cargar_municipio() {
    var v_departamento = $("#departamento_select").val();
    var municipio_select = $("#municipio_select");
    var editado = $("#municipio_edit").val();

    $.ajax({
      type: "GET",
      url: "/blissey/public/municipios/" + v_departamento,
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

  $("#busqueda").keyup(function () {
    var valor = $("#busqueda").val();
    var v_tipo = $("#seleccion").val();
    if (valor.length > 0) {
      var tabla = $("#tablaPaciente");
      $.ajax({
        url: "/blissey/public/buscarPersonas",
        type: "GET",
        data: {
          nombre: valor,
          tipo: v_tipo
        },
        success: function (res) {
          tabla.empty();
          head =
            "<thead>" +
            "<th>Nombre</th>" +
            "<th style='width : 80px'>Acción</th>" +
            "</thead>";
          tabla.append(head);
          $(res).each(function (key, value) {
            html =
              "<tr>" +
              "<td>" +
              value.apellido + ', ' + value.nombre +
              "</td>" +
              "<td>" +
              "<input type='hidden' name='nombre_paciente[]' value ='" + value.apellido + ', ' + value.nombre + "'>" +
              "<input type='hidden' name='id_paciente[]' value ='" + value.id + "'>" +
              "<button type='button' class='btn btn-xs btn-primary' id='agregar_paciente' data-dismiss='modal'>" +
              "<i class='fa fa-check'></i>" +
              "</button>" +
              "</td>" +
              "</tr>";
            tabla.append(html);
          });
        }
      });
    }
  });

  $('#tablaPaciente').on('click', '#agregar_paciente', function (e) {
    e.preventDefault();
    var nombre = $(this).parents('tr').find('input:eq(0)').val();
    var id = $(this).parents('tr').find('input:eq(1)').val();
    var opcion = $("#seleccion").val();
    var tabla = $("#tablaPaciente");
    if (opcion == "paciente" || opcion == "solicitud") {
      var input_nombre = $("#n_paciente");
      var input_id = $("#f_paciente");
    } else {
      var input_nombre = $("#n_responsable");
      var input_id = $("#f_responsable");
    }
    input_nombre.val(nombre);
    input_id.val(id);

    $("#busqueda").val("");
    tabla.empty();
    head =
      "<thead>" +
      "<th>Nombre</th>" +
      "<th style='width : 80px'>Acción</th>" +
      "</thead>";
    tabla.append(head);

    $("#modal").modal('hide');
  });

  $("#guardarPaciente").on('click', function (e) {
    e.preventDefault();

    var v_nombre = $("#nombre_paciente").val();
    var v_apellido = $("#apellido_paciente").val();
    var v_sexo = $("#sexo").val();
    var v_fecha = $("#fecha_paciente").val();
    var v_dui = $("#dui_paciente").val();
    var v_telefono = $("#telefono_paciente").val();
    var v_pais = $("#pais_paciente").val();
    var v_departamento = $("#departamento_select").val();
    var v_municipio = $("#municipio_select").val();
    var v_direccion = $("#direccion_paciente").val();
    var token = $("#tokenPaciente").val();

    if (v_nombre == "" || v_apellido == "") {
      swal('¡Error!', 'El nombre y apellido son obligatorios, intentelo de nuevo', 'error');
    } else {
      var opcion = $("#seleccion").val();
      if (opcion == "paciente") {
        var input_nombre = $("#n_paciente");
        var input_id = $("#f_paciente");
      } else {
        var input_nombre = $("#n_responsable");
        var input_id = $("#f_responsable");
      }
  
      $.ajax({
        type: "POST",
        url: "/blissey/public/guardar_paciente",
        headers: { 'X-CSRF-TOKEN': token },
        data: {
          nombre: v_nombre,
          apellido: v_apellido,
          sexo: v_sexo,
          fechaNacimiento: v_fecha,
          dui: v_dui,
          telefono: v_telefono,
          pais: v_pais,
          departamento: v_departamento,
          municipio: v_municipio,
          direccion: v_direccion
        },
        success: function (respuesta) {
          if (respuesta != false) {
            input_id.val(respuesta.id);
            input_nombre.val(respuesta.apellido + ", " + respuesta.nombre);
            return swal('¡Hecho!', 'Persona guardada', 'success');
          } else {
            return swal('¡Algo salio mal!', 'No se almaceno la información', 'error');
          }
        },
        error: function () {
          swal('¡Aviso!', 'El registro no fue agregado, intentelo de nuevo', 'warning');
        }
  
      });

      $("#nombre_paciente").val("");
      $("#apellido_paciente").val("");
      $("#dui_paciente").val("");
      $("#telefono_paciente").val("");
      $("#pais_paciente").val("");
      $("#departamento_select").val("San Vicente");
      cargar_municipio();
      $("#direccion_paciente").val("");
      $("#modal_persona").modal("hide");
    }


  });

  $("#c_responsable").on('click', function () {
    if (this.checked == true) {
      document.getElementById("responsable_div").style = "display: block";
    } else {
      document.getElementById("responsable_div").style = "display: none";
    }
  });

  $("#guardarMedicoModal").on("click", function (e) {
    e.preventDefault();
    var token = $("#tokenTransaccion").val();
    var transaccion_id = $("#transaccion").val();
    var medicos = $("input[name='medicos[]']").serializeArray();
    var union = [];
    $(medicos).each(function (key, value) {
      union.push(value.value);
    });
    if (union.length > 0) {
      $.ajax({
        url: "/blissey/public/servicio_medicos",
        headers: { 'X-CSRF-TOKEN': token },
        type: "POST",
        data: {
          f_transaccion: transaccion_id,
          f_medico: union
        },
        success: function (res) {
          if (res) {
            swal("¡Hecho!", "Acción realizada satisfactoriamente", "success");
            location.reload();
          } else {
            swal("¡Error!","Algo salio mal", "error");      
          }
        }
      });
    } else {
      swal("¡Error!", "Se debe seleccionar al menos un médico","error");
    }
  });

  $("#guardarSolicitudModal").on("click", function (e) {
    e.preventDefault();
    var token = $("#tokenSolicitudModal").val();
    var examen = $("input[name='examen[]']").serializeArray();
    var paciente = $("#f_paciente").val();
    var transaccion_id = $("#transaccion").val();
    var id = $("#id").val();
    var concat = [];
    $(examen).each(function (key, value) {
      concat.push(value.value);
    });
    if (concat.length > 0) {
      $.ajax({
        url: "/blissey/public/solicitudex",
        headers: { 'X-CSRF-TOKEN': token },
        type: "POST",
        data: {
          f_paciente: paciente,
          examen: concat,
          f_ingreso: id,
          transaccion: transaccion_id,
        },
        success: function (respuesta) {
          if (respuesta) {
            swal("¡Hecho!", "Solicitud enviada satisfactoriamente", "success");
            location.reload();
          }
        }
      });
    } else {
      swal("¡Error!", "Se debe seleccionar al menos un examen", "error");
    }
  });

  $("#resultadoVenta_").keyup(function () {
    var valor = $("#resultadoVenta_").val();
    if (radio == '1') {
      var ruta = "/blissey/public/buscarProductoVenta/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th>Existencias</th>" +
          "<th>Precio</th>" +
          "<th style='width : 80px'>Acción</th>" +
          "</thead>";
        tabla.append(cab);
        $(res).each(function (key, value) {
          $(value.division_producto).each(function (key2, value2) {
            if (parseFloat(value2.inventario) > 0) {
              if (value2.contenido != null) {
                var aux = value2.unidad.nombre;
              } else {
                var aux = value.presentacion.nombre;
              }
              html = "<tr>" +
                "<td id='cu" + value2.id + "'>" + value.nombre + "</td>" +
                "<td id='cd" + value2.id + "'>" + " " + value2.division.nombre + " " + value2.cantidad + " " + aux + "</td>" +
                "<td id='ct" + value2.id + "'>" + value2.inventario + "</td>" +
                "<td>$ <label id='cc" + value2.id + "'>" + parseFloat(value2.precio).toFixed(2) + "</label></td>" +
                "<td>" +
                "<button type='button' class='btn btn-xs btn-primary' onclick='registrarventa_(" + value2.id + ");'>" +
                "<i class='fa fa-check'></i>" +
                "</button>" +
                "</td>" +
                "</tr>";
              tabla.append(html);
            }
          });
        });
      });
    }
    if (radio == '2') {
      var ruta = "/blissey/public/buscarComponenteVenta/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th>Existencias</th>" +
          "<th>Precio</th>" +
          "<th>Componente</th>" +
          "<th style='width : 80px'>Acción</th>" +
          "</thead>";
        tabla.append(cab);
        $(res).each(function (key, value) {
          $(value.componente_producto).each(function (key2, value2) {
            $(value2.producto.division_producto).each(function (key3, value3) {
              if (parseFloat(value3.inventario) > 0) {
                if (value3.contenido != null) {
                  var aux = value3.unidad.nombre;
                } else {
                  var aux = value2.producto.presentacion.nombre;
                }
                html = "<tr>" +
                  "<td id='cu" + value3.id + "'>" + value2.producto.nombre + "</td>" +
                  "<td id='cd" + value3.id + "'>" + " " + value3.division.nombre + " " + value3.cantidad + " " + aux + "</td>" +
                  "<td id='ct" + value3.id + "'>" + value3.inventario + "</td>" +
                  "<td>$ <label id='cc" + value3.id + "'>" + parseFloat(value3.precio).toFixed(2) + "</label></td>" +
                  "<td>" + value.nombre + "</td>" +
                  "<td>" +
                  "<button type='button' class='btn btn-xs btn-primary' onclick='registrarventa_(" + value3.id + ");'>" +
                  "<i class='fa fa-check'></i>" +
                  "</button>" +
                  "</td>" +
                  "</tr>";
                tabla.append(html);
              }
            });
          });
        });
      });
    }
    if (radio == '3') {
      var ruta = "/blissey/public/buscarServicios/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th style='width : 80px'>Acción</th>" +
          "</thead>";
        tabla.append(cab);
        $(res).each(function (key, value) {
          html = "<tr>" +
            "<td id='cu" + value.id + "'>" + value.nombre + "</td>" +
            "<td>$ <label id='cd" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
            "<td>" +
            "<button type='button' class='btn btn-xs btn-primary' onclick='registrarventa_(" + value.id + ");'>" +
            "<i class='fa fa-check'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          tabla.append(html);
        });
      });
    }
  });

  $("#dar_alta").on("click", function (e) {
    e.preventDefault();
    var token = $("#tokenTransaccion").val();
    var transaccion_id = $("#transaccion").val();
    var deuda = $("#deuda_para_alta").val();
    var id = $("#id").val();
    swal({
      title: "¡Advertencia!",
      text: "Al dar de alta el paciente debe haber cancelado $" + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(deuda),
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      type: "warning"
    }).then(function(){
      $.ajax({
        url: "/blissey/public/abonar",
        type: "POST",
        headers: { 'X-CSRF-TOKEN': token },
        data: {
          transaccion: transaccion_id,
          abono: deuda,
          ingreso: id,
        },
        success: function (r) {
          console.log(r);
          if (r == 1) {
            swal("¡Hecho!", "Acción realizada exitosamente", 'success');
            location.reload();
          } else {
            swal("¡Algo salio mal!", 'No se guardo', 'error');
          }
        }
      });
    }).catch(swal.noop);
   });

  //Ver si existen los honorarios
  $("#guardar_ingreso").on("click", function (e) {
    $("#ingreso_form").submit();
  });
});

$("#nuevo_abono").on('click', function (e) {
  e.preventDefault();
  var token = $("#tokenTransaccion").val();
  var transaccion_id = $("#transaccion").val();
  var html_ = '<p>Ingrese la cantidad en dólares que desea abonar</p><input type="number" class="swal2-input" step="0.01" id="monto" min="0.00" placeholder="Monto a abonar">';

  swal({
    title: 'Nuevo abono',
    type: 'info',
    html: html_,
    showCancelButton: true,
    confirmButtonText: '¡Guardar!',
    cancelButtonText: 'Cancelar',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-default'
  }).then(function(){
    $.ajax({
      url: "/blissey/public/abonar",
      type: "POST",
      headers: { 'X-CSRF-TOKEN': token },
      data: {
        transaccion: transaccion_id,
        abono: $("#monto").val(),
      },
      success: function (r) {
        if (r == 1) {
          swal("¡Hecho!", "Acción realizada exitosamente", 'success');
          location.reload();
        } else {
          swal("¡Algo salio mal!", 'No se guardo', 'error');
        }
      }
    });
  }).catch(swal.noop);
});
//Agregar a la nueva tabla
function registrarventa_(id) {
  var transaccion_count_p = $("#transaccion_count_p").val();
  var transaccion_count_s = $("#transaccion_count_s").val();
  var cantidad = parseFloat($('#cantidad_resultado').val());
  var existencia = parseFloat($('#ct' + id).text());
  var token = $("#tokenTransaccion").val();
  var transaccion_id = $("#transaccion").val();
  var tipo_usuario = $("#tipo_usuario").val();
  c1 = $('#cu' + id).text();
  c2 = $('#cd' + id).text();
  var fecha = new Date();
  if (radio != 3) {
    if (cantidad > existencia) {
      new PNotify({
        title: 'Error!',
        text: "La cantidad solicitada supera las existencias",
        type: 'error',
        styling: 'bootstrap3'
      });
    } else {
      c4 = parseFloat($('#cc' + id).text()).toFixed(2);
      
      $.ajax({
        url: "/blissey/public/tratamiento",
        headers: { 'X-CSRF-TOKEN': token },
        type: "POST",
        data: {
          transaccion: transaccion_id,
          tipo_detalle: 1,
          f_producto: id,
          cantidad: cantidad,
          precio: c4
        },
        success: function (res) {
          console.log(res);
          if (res == 1) {
            if (transaccion_count_p == 0) {
              $("#mensaje_provisional").empty();

              html_2 = '<div class="col-xs-12">' +
                '<table class="table" id="tablaDetalle">' +
                '<thead>' +
                '<th style="width: 120px">Fecha</th>' +
                '<th style="width: 110px">Cantidad</th>' +
                '<th colspan="2">Detalle</th>' +
                '<th style="width: 120px">Opciones</th>'
                '</thead>' +
                '</table>' +
                '</div>';

              $("#mensaje_provisional").append(html_2);
            }

            tabla = $('#tablaDetalle');
            html = "<tr>" +
              "<td>" + fecha.getDate() + " / " + (fecha.getMonth() + 1) + " / " + fecha.getFullYear() + "</td>" +
              "<td>" + cantidad + " " + c2 + "</td>" +
              "<td>" + c1 + "</td>";
            if (tipo_usuario == "Enfermería") {
              html += "<td><span class='label label-lg label-warning col-xs-12'>Pendiente</span></td>";
            } else {
              html += "<td><button type='button' class='btn btn-sm btn-primary'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger'><i class='fa fa-remove'></i></button></td>";
            }
              html += "</tr>";

            tabla.append(html);
            
            new PNotify({
              title: '¡Hecho!',
              text: "Medicamento almacenado",
              type: 'info',
              styling: 'bootstrap3'
            });
          } else {
            new PNotify({
              title: '¡Error!',
              text: "Algo salio mal",
              type: 'error',
              styling: 'bootstrap3'
            });
          }
        }
      });
    }
  } else {
    
    c2 = parseFloat(c2).toFixed(2);
    
    $.ajax({
      url: "/blissey/public/tratamiento",
      headers: { 'X-CSRF-TOKEN': token },
      type: "POST",
      data: {
        transaccion: transaccion_id,
        tipo_detalle: 2,
        f_producto: id,
        cantidad: cantidad,
        precio: c2
      },
      success: function (res) {
        if (res == 1) {
          if (transaccion_count_s == 0) {
            $("#mensaje_provisional_s").empty();

            html_2 = '<div class="col-xs-12">' +
              '<table class="table" id="tablaDetalle_s">' +
              '<thead>' +
              '<th style="width: 120px">Fecha</th>' +
              '<th style="width: 110px">Cantidad</th>' +
              '<th>Detalle</th>' +
              '<th style="width: 120px">Opciones</th>'
              '</thead>' +
              '</table>' +
              '</div>';

            $("#mensaje_provisional_s").append(html_2);
          }

          tabla = $('#tablaDetalle_s');
          html = "<tr>" +
            "<td>" + fecha.getDate() + " / " + (fecha.getMonth() + 1) + " / " + fecha.getFullYear() + "</td>" +
            "<td>" + cantidad + "</td>" +
            "<td>" + c1 + "</td>";
          if (tipo_usuario == "Enfermería") {
            html += "<td><span class='label label-lg label-warning col-xs-12'>Pendiente</span></td>";
          } else {
            html += "<td><button type='button' class='btn btn-sm btn-primary'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger'><i class='fa fa-remove'></i></button></td>" +
              "</tr>";
          }
            
          tabla.append(html);

          new PNotify({
            title: '¡Hecho!',
            text: "Servicio almacenado",
            type: 'info',
            styling: 'bootstrap3'
          });
        } else {
          new PNotify({
            title: '¡Error!',
            text: "Algo salio mal",
            type: 'error',
            styling: 'bootstrap3'
          });
        }
      }
    });
  }
}
function recarga() {
  limpiarTablaVenta();
  location.reload();
}
function cambio_radios_especial(i) {
  cambioRadio(i);
  if (i == 3) {
    document.getElementById('radios').style = "display: none";
  } else {
    document.getElementById('radios').style = "display: block";
  }
}
var aux;
function cambio_habitacion(i) {
  var tipo = $("#tipo_i").val();
  var tipo_text;
  var cambio_text;
  if (tipo == 0) {
    tipo_text = "Ingreso";
  } else if(tipo == 1) {
    tipo_text = "Medi ingreso";
  } else {
    tipo_text = "Observación";
  }
  if (i == 0) {
    cambio_text = "Observación";
  } else if (i == 1) {
    cambio_text = "Medi ingreso";
  } else {
    cambio_text = "Ingreso";
  }

  if (cambio_text == tipo_text) {
    $("#p").text("Por favor seleccione la nueva habitación donde se ubicará al paciente");
    $("#p_").text("Por favor seleccione la nueva habitación donde se ubicará al paciente");
    $("#h").text("Cambio de habitación");
    $("#h_").text("Cambio de habitación");
  } else {
    $("#p").text("Se cambiará el " + tipo_text + " a " + cambio_text + ", por favor seleccione la nueva habitación donde se ubicará al paciente");
    $("#p_").text("Se cambiará el " + tipo_text + " a " + cambio_text + ", por favor seleccione la nueva habitación donde se ubicará al paciente");
    $("#h").text("Cambio a " + cambio_text);
    $("#h_").text("Cambio a " + cambio_text);
  }

  if (i == 0 || i == 1) {
    document.getElementById("go").style = "display:none";
    document.getElementById("vista_1").style = "display:none";
    document.getElementById("vista_2").style = "display:block; min-height: 200px;";
    document.getElementById("vista_3").style = "display:none";
    document.getElementById("ret").style = "display:inline-block";
  } else if (i == -1) {
    document.getElementById("go").style = "display:inline-block";
    document.getElementById("vista_1").style = "display:block; min-height: 200px;";
    document.getElementById("vista_2").style = "display:none";
    document.getElementById("vista_3").style = "display:none";
    document.getElementById("ret").style = "display:none";
  } else {
    document.getElementById("go").style = "display:none";
    document.getElementById("vista_1").style = "display:none";
    document.getElementById("vista_3").style = "display:block; min-height: 200px;";
    document.getElementById("vista_2").style = "display:none";
    document.getElementById("ret").style = "display:inline-block";
  }
  aux = i;
}
function guardar_cambio(i) {
  var token = $("#tokenTransaccion").val();
  var id = $("#id").val();
  console.log(habitacion);
  if (i == 0) {
    var estado = 2;
    var habitacion = $("#h_hab").val();
  } else if (i == 0 && aux == 1) {
    var estado = 1;
    var habitacion = $("#h_hab").val();
  } else {
    var estado = 0;
    var habitacion = $("#h_hab_").val();
  }
  if (habitacion != null) {
    $.ajax({
      url: "/blissey/public/cambio_ingreso",
      type: "post",
      headers: { 'X-CSRF-TOKEN': token },
      data: {
        tipo: estado,
        f_habitacion: habitacion,
        ingreso: id,
      },
      success: function (r) {
        if (r == 1) {
          swal('¡Hecho!', 'Cambio exitoso', 'success');
          location.reload();
        } else {
          swal('¡Error!', 'Algo salio mal', 'error');
        }
      }
    });
  } else {
    swal('¡Error!','Es necesario que haya al menos una habitación disponible','error');
  }

}
function accion24(tipo, id) {
  //0: Eliminar, 1: Editar y 2: Cambiar estado
  var token = $("#tokenTransaccion").val();
  if (tipo == 1) {
    var html_ = '<p>Ingrese la nueva cantidad correcta</p><input class="swal2-input" type="number" step="1" min="1" id="edit_cantidad">';

    swal({
      title: "Editar",
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default'
    }).then(function() {
      var cantidad= $("#edit_cantidad").val();
      $.ajax({
        url: "/blissey/public/editar24",
        type: "post",
        headers: { 'X-CSRF-TOKEN': token },
        data: {
          id: id,
          cantidad: cantidad
        },
        success: function (res) {
          if (res) {
            swal('¡Hecho!', 'Acción realizada satisfactoriamente', 'success');
            location.reload();
          } else {
            swal('¡Error!', 'Algo salio mal', 'error');
          }
        }
      });
    }).catch(swal.noop);
  } else if (tipo == 2) { 
    $.ajax({
      url: '/blissey/public/cambiar_estado',
      type: 'post',
      headers: { 'X-CSRF-TOKEN': token },
      data: {
        id: id
      },
      success: function (r) {
        if (r) {
          swal('¡Hecho!', '¡Acción realizada satisfactoriamente!', 'success');
          location.reload();
        } else {
          swal('¡Erro!', 'Algo salio mal', 'error');
        }
      }
    });
  } else {
    swal({
      title: 'Eliminar registro',
      text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: "Si, ¡Eliminar!",
      cancelButtonText: "No, ¡Cancelar!",
      confirmButtonClass: 'btn btn-danger',
      cancelButtonClass: 'btn btn-default',
    }).then(function () {
      $.ajax({
        url: "/blissey/public/eliminar24",
        type: "post",
        headers: { 'X-CSRF-TOKEN': token },
        data: {
          id: id
        },
        success: function (res) {
          if (res) {
            swal('¡Eliminado!', 'Acción realizada satisfactoriamente', 'success');
            location.reload();
          } else {
            swal('¡Error!', 'Algo salio mal', 'error');
          }
        }
      });
    }).catch(swal.noop);
  }
}