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
    if (valor.length > 2) {
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

  $("#guardarSolicitudModal").on("click", function (e) {
    e.preventDefault();
    var token = $("#tokenSolicitudModal").val();
    var examen = $("input[name='examen[]']").serializeArray();
    var paciente = $("#f_paciente").val();
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
          f_ingreso: id
        },
        success: function (respuesta) {
          console.log(respuesta);
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
    if (valor.length < 3) {
      var tabla = $("#tablaBuscar");
      tabla.empty();
    }
    if (radio == '1' && valor.length > 2) {
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
    if (radio == '2' && valor.length > 3) {
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
    if (radio == '3' && valor.length > 2) {
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

  //Ver si existen los honorarios
  $("#guardar_ingreso").on("click", function (e) {
    $.ajax({
      type: 'get',
      url: '/blissey/public/servicio_honorario',
      success: function (r) {
        if (r == 0) {
          var html_ = '<p class="text-justify">Parece que no se ha registrado el servicio por <span class="blue">Honorarios Médicos</span>, pero podemos hacerlo por tí en este momento, por favor indicanos cual es el precio en dólares que se cobra por este servicio:</p><input type="number" class="swal2-input" step="0.01" id="aux" min="0.00" placehorlder="Precio en dólares">';

          swal({
            title: '¡Antes de guardar!',
            html: html_,
            type: 'info',
            showCancelButton: true,
            confirmButtonText: '¡Guardar!',
            cancelButtonText: 'Cancelar',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-default'
          }).then(function () {
            $("#precio").val($("#aux").val());
            $("#ingreso_form").submit();
          }).catch(swal.noop);
        } else {
          $("#ingreso_form").submit();
        }
      }
    });
  });
});
//Agregar a la nueva tabla
function registrarventa_(id) {
  var transaccion_count = $("#transaccion_count").val();
  var cantidad = parseFloat($('#cantidad_resultado').val());
  var existencia = parseFloat($('#ct' + id).text());
  var token = $("#tokenTransaccion").val();
  var transaccion_id = $("#transaccion").val();
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
      if (transaccion_count == 0) {
        $("#mensaje_provisional").empty();

        html_2 = '<div class="col-xs-12">' +
          '<table class="table" id="tablaDetalle">' +
          '<thead>' +
          '<th style="width: 120px">Fecha</th>' +
          '<th style="width: 110px">Cantidad</th>' +
          '<th colspan="2">Detalle</th>' +
          '</thead>' +
          '</table>' +
          '</div>';
        
        $("#mensaje_provisional").append(html_2);
      }
      c4 = parseFloat($('#cc' + id).text()).toFixed(2);
      tabla = $('#tablaDetalle');
      html = "<tr>" +
        "<td>" + fecha.getDate() + " / " + (fecha.getMonth() + 1) + " / " + fecha.getFullYear() + "</td>" + 
        "<td>" + cantidad +" "+c2 + "</td>" +
        "<td>" + c1 + "</td>" +
        "</tr>";
      tabla.append(html);

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
          if (res == 1) {
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
    tabla = $('#tablaDetalle');
    html = "<tr>" +
      "<td>" + cantidad + "</td>" +
      "<td>" + c1 + "</td>" +
      "<td></td>" +
      "<td>$ " + c2 + "</td>" +
      "<td>$ " + parseFloat(cantidad * c2).toFixed(2) + "</td>" +
      "<td>" +
      "<input type='hidden' name='tipo_detalle[]' value='2'>" +
      "<input type='hidden' name='f_producto[]' value='" + id + "'>" +
      "<input type='hidden' name='cantidad[]' value='" + cantidad + "'>" +
      "<input type='hidden' name='precio[]' value='" + c2 + "'>" +
      "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>" +
      "<i class='fa fa-remove'></i>" +
      "</button>" +
      "</td>" +
      "</tr>";
    tabla.append(html);
  }
}
