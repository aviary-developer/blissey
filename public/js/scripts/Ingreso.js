$(document).on('ready', function () {
  var ubicacion = window.location.pathname;
  //Variables globales
  transaccion_count_p = 0;
  transaccion_count_s = 0;

  if (ubicacion.indexOf("/ingresos/create") > -1) {
    cargar_municipio();
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

  $("#busqueda").keyup(async function () {
    var valor = $("#busqueda").val();
    var v_tipo = $("#seleccion").val();
    if (valor.length > 0) {
      var tabla = $("#tablaPaciente");
      try {
        await $.ajax({
          url: $('#guardarruta').val() + "/buscarPersonas",
          type: "GET",
          data: {
            nombre: valor,
            tipo: v_tipo
          },
          success: function (res) {
            if (res != 0) {
              tabla.empty();
              head =
                "<thead>" +
                "<th>Nombre</th>" +
                "<th>Edad</th>" +
                "<th style='width : 80px'>Opción</th>" +
                "</thead>";
              tabla.append(head);
              $(res).each(function (key, value) {
                aux_fecha = value.fechaNacimiento.split('-');
                edad = calculate_age(aux_fecha[0], aux_fecha[1], aux_fecha[2]);
                html =
                  "<tr>" +
                  "<td>" +
                  value.apellido + ', ' + value.nombre +
                  "</td>" +
                  "<td>" +
                  edad +
                  " años</td>" +
                  "<td><center>" +
                  "<input type='hidden' name='nombre_paciente[]' value ='" + value.apellido + ', ' + value.nombre + "'>" +
                  "<input type='hidden' name='id_paciente[]' value ='" + value.id + "'>" +
                  "<button type='button' class='btn btn-sm btn-primary' id='agregar_paciente'>" +
                  "<i class='fa fa-check'></i>" +
                  "</button>" +
                  "</center></td>" +
                  "</tr>";
                tabla.append(html);
              });
            }
          }
        });
      } catch (error) {
        console.log(error);
      }
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

    if (ubicacion.indexOf("/ingresos") > -1) {
      // $("#centro").removeClass('modal-lg');
      // $("#izquierda").removeClass('col-sm-6').addClass('col-sm-12');
      // $("#derecha").hide();
      // $("#izq_interno").attr('style', 'height:auto');
      //Mostrar el panel de la izquierda y ocultar el de la derecha
      $("#izquierda").show();
      $("#derecha").hide();
      $("#derecha_nuevo").hide();
      $("#btn_derecha").hide();
      $("#btn_izquierda").show();
    } else {
      $("#modal_").modal('hide');
    }

  });

  $("#guardar_paciente_nuevo").on('click', function (e) {
    e.preventDefault();

    var v_nombre = $("#pac_nombre");
    var v_apellido = $("#pac_apellido");
    var v_sexo = $("#pac_sexo");
    var v_fecha = $("#pac_fecha");
    var v_telefono = $("#pac_telefono");

    var is_valid = true;

    var valido = new Validated('pac_nombre');
    valido.required();
    is_valid = valido.value(is_valid);

    var valido = new Validated('pac_apellido');
    valido.required();
    is_valid = valido.value(is_valid);

    var valido = new Validated('pac_fecha');
    valido.required();
    is_valid = valido.value(is_valid);

    if (is_valid) {
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
        url: $('#guardarruta').val() + "/guardar_paciente",
        data: {
          nombre: v_nombre.val(),
          apellido: v_apellido.val(),
          sexo: v_sexo.val(),
          fechaNacimiento: v_fecha.val(),
          telefono: v_telefono.val()
        },
        success: function (respuesta) {
          if (respuesta != false) {
            input_id.val(respuesta.id);
            input_nombre.val(respuesta.apellido + ", " + respuesta.nombre);
            swal({
              type: 'success',
              toast: true,
              title: '¡Acción exitosa!',
              position: 'top-end',
              showConfirmButton: false,
              timer: 4000
            });
          } else {
            return swal('¡Algo salio mal!', 'No se almaceno la información', 'error');
          }
        },
        error: function () {
          swal('¡Aviso!', 'El registro no fue agregado, intentelo de nuevo', 'warning');
        }

      });

      $("#pac_nombre").val("");
      $("#pac_apellido").val("");
      $("#dui_paciente").val("");
      $("#pac_telefono").val("");

      // $("#centro").removeClass('modal-lg');
      // $("#izquierda").removeClass('col-sm-6').addClass('col-sm-12');
      // $("#derecha").hide();
      // $("#derecha_nuevo").hide();
      // $("#izq_interno").attr('style', 'height:auto');

      $("#izquierda").show();
      $("#derecha").hide();
      $("#derecha_nuevo").hide();
      $("#btn_derecha").hide();
      $("#btn_izquierda").show();
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
    var transaccion_id = $("#id_t").val();
    var medicos = $("input[name='medicos[]']").serializeArray();
    var union = [];
    $(medicos).each(function (key, value) {
      union.push(value.value);
    });
    if (union.length > 0) {
      $.ajax({
        url: $('#guardarruta').val() + "/servicio_medicos",
        type: "POST",
        data: {
          f_transaccion: transaccion_id,
          f_medico: union
        },
        success: function (res) {
          if (res) {
            localStorage.setItem('msg', 'yes');
            location.reload();
          } else {
            swal("¡Error!", "Algo salio mal", "error");
          }
        }
      });
    } else {
      swal("¡Error!", "Se debe seleccionar al menos un médico", "error");
    }
  });

  $("#guardarSolicitudModal").on("click", function (e) {
    e.preventDefault();
    var examen = $("input[name='examen[]']").serializeArray();
    var paciente = $("#id_p").val();
    var transaccion_id = $("#id_t").val();
    var id = $("#id").val();
    var concat = [];
    $(examen).each(function (key, value) {
      concat.push(value.value);
    });
    if (concat.length > 0) {
      $.ajax({
        url: $('#guardarruta').val() + "/solicitudex",
        type: "POST",
        data: {
          f_paciente: paciente,
          examen: concat,
          f_ingreso: id,
          transaccion: transaccion_id,
          tipo: "examenes"
        },
        success: function (respuesta) {
          if (respuesta) {
            localStorage.setItem('msg', 'yes');
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
      var ruta = $('#guardarruta').val() + "/buscarProductoVenta/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th>Existencias</th>" +
          "<th>Precio</th>" +
          "<th style='width : 50px'>Acción</th>" +
          "</thead>";
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
              "<td id='ct" + value.id + "'>" + value.inventario + "</td>" +
              "<td>$ <label id='cc" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
              "<td>" +
              "<center><button type='button' class='btn btn-sm btn-primary' onclick='registrarventa_(" + value.id + ");'>" +
              "<i class='fa fa-check'></i>" +
              "</button></center>" +
              "</td>" +
              "</tr>";
            tabla.append(html);
          }
        });
      });
    }
    if (radio == '2') {
      var ruta = $('#guardarruta').val() + "/buscarComponenteVenta/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th>Existencias</th>" +
          "<th>Precio</th>" +
          "<th>Componente</th>" +
          "<th style='width : 50px'>Acción</th>" +
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
                  "<center><button type='button' class='btn btn-sm btn-primary' onclick='registrarventa_(" + value3.id + ");'>" +
                  "<i class='fa fa-check'></i>" +
                  "</button></center>" +
                  "</td>" +
                  "</tr>";
                tabla.append(html);
              }
            });
          });
        });
      });
    }
  });

  $("#resultadoVentaS_").keyup(function () {
    var valor = $("#resultadoVentaS_").val();
    if (radio == '3') {
      var ruta = $('#guardarruta').val() + "/buscarServicios/" + valor + "/h";
      var tabla = $("#tablaBuscarS");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th>Resultado</th>" +
          "<th>Precio</th>" +
          "<th style='width : 50px'>Acción</th>" +
          "</thead>";
        tabla.append(cab);
        $(res).each(function (key, value) {
          html = "<tr>" +
            "<td id='cu" + value.id + "'>" + value.nombre + "</td>" +
            "<td>$ <label id='cd" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
            "<td>" +
            "<center><button type='button' class='btn btn-sm btn-primary' onclick='registrarventa_(" + value.id + ");'>" +
            "<i class='fa fa-check'></i>" +
            "</button></center>" +
            "</td>" +
            "</tr>";
          tabla.append(html);
        });
      });
    }
  });

  $("#dar_alta").on("click", async function (e) {
    e.preventDefault();

    var transaccion_id = $("#id_t").val();
    var deuda = $("#deuda_para_alta").val();
    var id = $("#id").val();
    await swal({
      title: "¡Advertencia!",
      text: "Al dar de alta el paciente debe haber cancelado $" + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(deuda),
      showCancelButton: true,
      confirmButtonText: '¡Aceptar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light',
      type: "warning"
    }).then((result) => {
      console.log(result);
      if (result.value) {
        $.ajax({
          url: $('#guardarruta').val() + "/abonar",
          type: "POST",
          data: {
            transaccion: transaccion_id,
            abono: deuda,
            ingreso: id,
          },
          success: function (r) {
            if (r == 1) {
              localStorage.setItem('msg', 'yes');
              location.reload();
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
      } else if (result.dismiss === swal.DismissReason.cancel) {
        location.reload();
      }
    });
    location.reload();
  });

  $("#fin_consulta").on("click", async function (e) {
    e.preventDefault();
    var transaccion_id = $("#id_t").val();
    var deuda = $("#precio_consulta").val();
    var id = $("#id").val();
    await swal({
      title: "¡Advertencia!",
      text: "Al dar de alta el paciente debe haber cancelado $" + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(deuda),
      showCancelButton: true,
      confirmButtonText: '¡Aceptar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light',
      type: "warning"
    }).then((result) => {
      console.log(result.value);
      if (result.value) {
        $.ajax({
          url: $('#guardarruta').val() + "/abonar",
          type: "POST",
          data: {
            transaccion: transaccion_id,
            abono: deuda,
            ingreso: id,
          },
          success: function (r) {
            if (r == 1) {
              localStorage.setItem('msg', 'yes');
              window.location.href = $('#guardarruta').val()+"/ingresos";
              //location.reload();
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
    location.reload();
  });

  //Ver si existen los honorarios
  $("#guardar_ingreso").on("click", function (e) {
    $("#ingreso_form").submit();
  });

  //Guardar el ingreso
  $("#guardar_i").on('click', function (e) {
    e.preventDefault();
    value = ($("#c_responsable").is(':checked') == true) ? 1 : 0;
    $.ajax({
      type: 'post',
      url: $('#guardarruta').val() + '/ingresos',
      data: {
        f_paciente: $("#f_paciente").val(),
        c_responsable: value,
        f_responsable: $("#f_responsable").val(),
        f_medico: $("#f_medico").val(),
        fecha_ingreso: $("#fecha_ingreso").val(),
        tipo: $("#tipo").val(),
        f_cama: $("#cama").val()
      }, success: function (r) {
        console.log(r);
        if (r == 1) {
          localStorage.setItem('msg', 'yes');
          location.reload();
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
  });
});

$("#cancelar_derecha").click(function (e) {
  e.preventDefault();
  $("#izquierda").show();
  $("#derecha").hide();
  $("#derecha_nuevo").hide();

  $("#btn_derecha").hide();
  $("#btn_izquierda").show();
});

$("#nuevo_abono").on('click', function (e) {
  e.preventDefault();
  var transaccion_id = $("#id_t").val();
  var html_ = '<p>Ingrese la cantidad en dólares que desea abonar</p><input type="number" class="swal2-input" step="0.01" id="monto" min="0.00" placeholder="Monto a abonar" autofocus aria-autocomplete="false">';
  var deuda = $("#deuda_para_alta").val();
  deuda = parseFloat(deuda);
  swal({
    title: 'Nuevo abono',
    type: 'info',
    html: html_,
    showCancelButton: true,
    confirmButtonText: '¡Guardar!',
    cancelButtonText: 'Cancelar',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light'
  }).then((result) => {
    if (result.value) {
      console.log($("#monto").val())
      var monto_a = $("#monto").val();
      if (parseFloat(monto_a) <= deuda) {
        $.ajax({
          url: $('#guardarruta').val() + "/abonar",
          type: "POST",
          data: {
            transaccion: transaccion_id,
            abono: $("#monto").val(),
          },
          success: function (r) {
            if (r == 1) {
              localStorage.setItem('msg', 'yes');
              location.reload();
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
      } else {
        swal({
          type: 'error',
          title: '¡Error!',
          text: 'La cantidad ingresada debe ser igual o menor a la deuda total',
          toast: true,
          timer: 5000,
          showConfirmButton: false,
        });
      }
    }
  });
});
//Agregar a la nueva tabla
function registrarventa_(id) {
  var cantidad = parseFloat($('#cantidad_resultado').val());
  var existencia = parseFloat($('#ct' + id).text());
  var transaccion_id = $("#id_t").val();
  var tipo_usuario = $("#tipo_usuario").val();
  c1 = $('#cu' + id).text();
  c2 = $('#cd' + id).text();
  var fecha = new Date();
  if (radio != 3) {
    if (cantidad > existencia) {
      swal({
        type: 'error',
        title: '¡Error!',
        text: 'La cantidad solicitada supera las existencias',
        toast: true,
        timer: 5000,
        showConfirmButton: false,
      });
    } else {
      c4 = parseFloat($('#cc' + id).text()).toFixed(2);

      $.ajax({
        url: $('#guardarruta').val() + "/tratamiento",
        type: "POST",
        data: {
          transaccion: transaccion_id,
          tipo_detalle: 1,
          f_producto: id,
          cantidad: cantidad,
          precio: c4
        },
        success: function (res) {
          if (res != -1) {
            if (transaccion_count_p == 0) {
              $("#mensaje_provisional").empty();

              html_2 = '<div class="col-sm-12">' +
                '<table class="table table-sm table-hover table-striped" id="tablaDetalle">' +
                '<thead>' +
                '<th>Detalle</th>' +
                '<th style="width: 40px">Acción</th>'
              '</thead>' +
                '</table>' +
                '</div>';

              $("#mensaje_provisional").append(html_2);
            }

            tabla = $('#tablaDetalle');
            html = "<tr id='r" + res + "'>" +
              "<td>" + cantidad + " <span class='text-monospace font-weight-light'>" + c2 + "</span><b class=''> " + c1 + "</b></td>";
            if (tipo_usuario == "Enfermería") {
              html += "<td><span class='badge badge-light col-sm-12'>Pendiente</span></td>";
            } else {
              html += "<td><center><button type='button' id='" + res + "' class='btn btn-sm btn-danger' onclick='accion24(3," + res + ",this)'><i class='fa fa-times'></i></button></center></td>";
            }
            html += "</tr>";

            tabla.append(html);
            transaccion_count_p = 1;

            swal({
              type: 'success',
              toast: true,
              title: '¡Acción exitosa!',
              position: 'top-end',
              showConfirmButton: false,
              timer: 4000
            });
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
  } else {

    c2 = parseFloat(c2).toFixed(2);

    $.ajax({
      url: $('#guardarruta').val() + "/tratamiento",
      type: "POST",
      data: {
        transaccion: transaccion_id,
        tipo_detalle: 2,
        f_producto: id,
        cantidad: cantidad,
        precio: c2
      },
      success: function (res) {
        if (res != -1) {
          if (transaccion_count_s == 0) {
            $("#mensaje_provisional_s").empty();

            html_2 = '<div class="col-sm-12">' +
              '<table class="table table-sm table-hover table-striped" id="tablaDetalle_s">' +
              '<thead>' +
              '<th>Detalle</th>' +
              '<th style="width: 40px">Acción</th>'
            '</thead>' +
              '</table>' +
              '</div>';

            $("#mensaje_provisional_s").append(html_2);
          }

          tabla = $('#tablaDetalle_s');
          html = "<tr id='r" + res + "'>" +
            "<td>" + cantidad + " " +
            "<b class=''>" + c1 + "</b></td>";
          if (tipo_usuario == "Enfermería") {
            html += "<td><span class='badge badge-light col-sm-12'>Pendiente</span></td>";
          } else {
            html += "<td><center><button type='button' id='" + res + "' class='btn btn-sm btn-danger' onclick='accion24(3," + res + ",this)'><i class='fa fa-times'></i></button></center></td>";
          }

          tabla.append(html);
          transaccion_count_s = 1;

          swal({
            type: 'success',
            toast: true,
            title: '¡Acción exitosa!',
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
          });
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
}
function recarga() {
  limpiarTablaVenta();
  location.reload();
}
var aux;

function accion24(tipo, id, objeto = null) {
  //0: Eliminar, 1: Editar y 2: Cambiar estado
  //6: Editar el precio
  if (tipo == 1) {
    var html_ = '<p>Ingrese la nueva cantidad correcta</p><input class="swal2-input" type="number" step="1" min="1" id="edit_cantidad" value="' + objeto + '">';
    swal({
      title: "Editar",
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light'
    }).then((result) => {
      if (result.value) {
        var cantidad = $("#edit_cantidad").val();
        $.ajax({
          url: $('#guardarruta').val() + "/editar24",
          type: "post",
          data: {
            id: id,
            cantidad: cantidad
          },
          success: function (res) {
            if (res) {
              localStorage.setItem('msg', 'yes');
              location.reload();
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
  } else if (tipo == 2) {
    $.ajax({
      url: $('#guardarruta').val() + '/cambiar_estado',
      type: 'post',
      data: {
        id: id
      },
      success: function (r) {
        if (r) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        } else {
          swal('¡Erro!', 'Algo salio mal', 'error');
        }
      }
    });
  } else if (tipo == 3) {
    $.ajax({
      url: $('#guardarruta').val() + "/eliminar24",
      type: "post",
      data: {
        id: id
      },
      success: function (res) {
        if (res) {
          $("#r" + objeto.id).remove();
          swal({
            type: 'success',
            toast: true,
            title: '¡Acción exitosa!',
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
          });
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
  } else if (tipo == 4) {
    $.ajax({
      url: $('#guardarruta').val() + "/eliminarDS",
      type: "post",
      data: {
        id: id
      },
      success: function (res) {
        if (res) {
          $("#r" + objeto.id).remove();
          swal({
            type: 'success',
            toast: true,
            title: '¡Acción exitosa!',
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
          });
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
  } else if (tipo == 5) {
    var html_ = '<p>Ingrese el nuevo precio correcto</p><input class="swal2-input" type="number" step="0.01" min="0" id="edit_precio" value="' + objeto + '">';
    swal({
      title: "Editar",
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light'
    }).then((result) => {
      if (result.value) {
        var precio = $("#edit_precio").val();
        $.ajax({
          url: $('#guardarruta').val() + "/editarx24",
          type: "post",
          data: {
            id: id,
            precio: precio
          },
          success: function (res) {
            if (res) {
              localStorage.setItem('msg', 'yes');
              location.reload();
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
  } else if (tipo == 6) {
    var html_ = '<p>Ingrese el nuevo precio unitario correcto</p><input class="swal2-input" type="number" step="1" min="0" id="edit_precio" value="' + objeto + '">';
    swal({
      title: "Editar",
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light'
    }).then((result) => {
      if (result.value) {
        var precio = $("#edit_precio").val();
        $.ajax({
          url: $('#guardarruta').val() + "/editar24",
          type: "post",
          data: {
            id: id,
            precio: precio
          },
          success: function (res) {
            if (res) {
              localStorage.setItem('msg', 'yes');
              location.reload();
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
  } else {
    swal({
      title: 'Eliminar registro',
      text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: "Si, ¡Eliminar!",
      cancelButtonText: "No, ¡Cancelar!",
      confirmButtonClass: 'btn btn-danger',
      cancelButtonClass: 'btn btn-light',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: $('#guardarruta').val() + "/eliminar24",
          type: "post",
          data: {
            id: id
          },
          success: function (res) {
            if (res) {
              localStorage.setItem('msg', 'yes');
              location.reload();
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
  }
}

function input_seleccion(e = null, btn = 0) {
  document.getElementById('seleccion').value = e;

  var principal = $("#centro");
  if (btn == 0) {
    var derecha = $("#derecha");
    $("#derecha_nuevo").hide();
    $("#guardar_paciente_nuevo").hide();
  } else {
    var derecha = $("#derecha_nuevo");
    $("#derecha").hide();
    $("#guardar_paciente_nuevo").show();
  }
  var izquierda = $("#izquierda");
  var interno = $("#izq_interno");

  // principal.addClass('modal-lg');
  // izquierda.removeClass('col-sm-12').addClass('col-sm-6');
  // derecha.show();
  // interno.attr('style', 'height:auto');

  izquierda.hide();
  derecha.show();
  $("#btn_derecha").show();
  $("#btn_izquierda").hide();

  $("#busqueda").focus();
}

function i_activo(cama, tipo) {
  $("#cama").val(cama);
  $("#tipo").val(tipo);
  if (tipo == 0) {
    $("#tipo_ingreso_div").show();
  } else {
    $("#tipo_ingreso_div").hide();
  }
}
