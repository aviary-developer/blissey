var radio = 1;
var componentes_agregados = [];
var contadorcp = 0;
var replica = 0;
$(document).on('ready', function () {
  var contador = $("#contador").val();
  $("#codigoBuscar").val("");
  $("#producto").val("");
  $("#cantidad").val("1");
  for (i = 0; i <= contador; i++) {
    var prod_tmp = $("#f_prod" + i).val();
    componentes_agregados.push(prod_tmp);
    contadorcp++;
  }
  $("#resultado").keyup(function () {
    var valor = $("#resultado").val();
    var tipo = $("#tipo").val();
    var laboratorio = "1";
    var confirmar = $("#confirmar").val();
    if (laboratorio != "") {
      conteo = valor.length;
      if (conteo > 0) {
        if (confirmar == true || tipo == 0) { //Venta a clientes
          var ruta = $('#guardarruta').val() + "/buscarProductoTransaccion/" + laboratorio + "/" + valor;
          var tabla = $("#tablaBuscar");
          $.get(ruta, function (res) {
            tabla.empty();
            head =
              "<thead>" +
              "<th>Código</th>" +
              "<th colspan='2'>Resultado</th>" +
              "<th style='width : 80px'>Acción</th>" +
              "</thead>";
            tabla.append(head);
            $(res).each(function (key, value) {
              var res2 = value.division_producto;
              $(res2).each(function (key2, value2) {
                if (value2.unidad == null) {
                  n_division = value2.division.nombre + " " + value2.cantidad + " " + value.presentacion.nombre;
                } else {
                  n_division = value2.division.nombre + " " + value2.cantidad + " " + value2.unidad.nombre;
                }
                html =
                  "<tr>" +
                  "<td>" +
                  value2.codigo +
                  "</td>" +
                  "<td>" +
                  value.nombre +
                  "</td>" +
                  "<td>" +
                  n_division +
                  "</td>" +
                  "<td>" +
                  "<input type='hidden' name='producto_division[]' value ='" + n_division + "'>" +
                  "<input type='hidden' name='nombre_producto[]' value ='" + value.nombre + "'>" +
                  "<input type='hidden' name='id_producto[]' value ='" + value2.id + "'>" +
                  "<button type='button' class='btn btn-sm btn-primary' id='agregar_resultado'>" +
                  "<i class='fas fa-check'></i>" +
                  "</button>" +
                  "</td>" +
                  "</tr>";
                tabla.append(html);
              });
            });
          });

        } else {      //Compra a proveedores
        }
      }
    } else {
      $("#resultado").val("");
      swal({
        type: 'error',
        title: '¡Proveedor no seleccionado!',
        showConfirmButton: false,
        timer: 2000,
        animation: false,
        customClass: 'animated tada'
      }).catch(swal.noop);
    }
  });
  $("#resultadoVenta").keyup(async function () {
    var valor = $("#resultadoVenta").val();
    if (valor.length < 2) {
      var tabla = $("#tablaBuscar");
      tabla.empty();
    }
    var conteo = 0;
    if (radio == '1' && valor.length > 1) {
      var ruta = $('#guardarruta').val() + "/buscarProductoVenta/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, await async function (res) {

        await tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th>Estante|Nivel</th>" +
          "<th>Existencias</th>" +
          "<th style='width : 80px'>Precio</th>" +
          "<th style='width : 80px'>Lote próximo</th>" +
          "<th style='width : 80px'>Acción</th>" +
          "</thead>";
        tabla.append(cab);
        await $(res).each(async function (key, value) {
          if (value.inventario != 0) {
            if (value.u_nombre != null) {
              var aux = value.u_nombre;
            } else {
              var aux = value.p_nombre;
            }
            html = "<tr>" +
              "<td id='cu" + value.id + "'>" + value.nombre + "</td>" +
              "<td id='cd" + value.id + "'>" + " " + value.d_nombre + " " + value.cantidad + " " + aux + "</td>" +
              "<td>" + value.ubicacion + "</td>" +
              "<td id='ct" + value.id + "'>" + value.inventario + "</td>" +
              "<td>$ <label id='cc" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
              "<td>" + value.lote + "</td>" +
              "<td>" +
              "<button type='button' class='btn btn-sm btn-primary' onclick='registrarventa(" + value.id + ");'>" +
              "<i class='fas fa-check'></i>" +
              "</button>" +
              "</td>" +
              "</tr>";
            if (conteo < 10) {
              tabla.append(html);
            }
            conteo++;
          }
        });
      });
    }
    if (radio == '2' && valor.length > 1) {
      var ruta = $('#guardarruta').val() + "/buscarComponenteVenta/" + valor;
      var tabla = $("#tablaBuscar");
      $.get(ruta, function (res) {
        tabla.empty();
        cab = "<thead>" +
          "<th colspan='2'>Resultado</th>" +
          "<th>Estante|Nivel</th>" +
          "<th>Existencias</th>" +
          "<th style='width : 80px'>Precio</th>" +
          "<th>Componente</th>" +
          "<th style='width : 80px'>Acción</th>" +
          "</thead>";
        tabla.append(cab);
        $(res).each(function (key, value) {
          if (parseFloat(value.inventario) > 0) {
            if (value.u_unidad != null) {
              var aux = value.u_nombre;
            } else {
              var aux = value.p_nombre;
            }
            html = "<tr>" +
              "<td id='cu" + value.id + "'>" + value.nombre + "</td>" +
              "<td id='cd" + value.id + "'>" + " " + value.d_nombre + " " + value.cantidad + " " + aux + "</td>" +
              "<td>" + value.ubicacion + "</td>" +
              "<td id='ct" + value.id + "'>" + value.inventario + "</td>" +
              "<td>$ <label id='cc" + value.id + "'>" + parseFloat(value.precio).toFixed(2) + "</label></td>" +
              "<td>" + value.co_nombre + "</td>" +
              "<td>" +
              "<button type='button' class='btn btn-sm btn-primary' onclick='registrarventa(" + value.id + ");'>" +
              "<i class='fas fa-check'></i>" +
              "</button>" +
              "</td>" +
              "</tr>";

            tabla.append(html);

            conteo++;
          }
        });
      });
    }
    if (radio == '3' && valor.length > 1) {
      var ruta = $('#guardarruta').val() + "/buscarServicios/" + valor + "/b";
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
            "<button type='button' class='btn btn-sm btn-primary' onclick='registrarventa(" + value.id + ");'>" +
            "<i class='fas fa-check'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          if (conteo < 20) {
            tabla.append(html);
          }
          conteo++;
        });
      });
    }
  });
  $("#codigoBuscar").keyup(function () {
    codigo = $('#codigoBuscar').val();
    if (codigo != "") {
      conf = $('#tipo').val();
      ruta = $('#guardarruta').val() + "/busquedaCodigo/" + codigo + "/" + conf;
      $.get(ruta, function (res) {
        if (res != 0 && res != 1) {
          var ruta3 = $('#guardarruta').val() + "/buscarNombreDivision/" + res.f_division;
          $.get(ruta3, function (res3) {
            var ruta4 = $('#guardarruta').val() + "/buscarNombrePresentacion/" + res.f_producto + "/2";
            $.get(ruta4, function (res4) {
              if (res.unidad == null) {
                n_division = res3 + " " + res.cantidad + " " + res4.presentacion.nombre;
              } else {
                n_division = res3 + " " + res.cantidad + " " + res.unidad.nombre;
              }
              $('#producto').val(n_division + " " + res4.nombre);
              $('#idoculto').val(res.id);
              $('#divoculto').val(n_division);
              $('#nomoculto').val(res4.nombre);
              $('#preoculto').val(res.precio);
              $('#exioculto').val(res.inventario);
            });
          });
        } else {
          $('#producto').val("");
        }
      });
    }
  });
  $("#tablaBuscar").on('click', "#agregar_resultado", function (e) {
    var v = validarCantidad();
    var f_producto = $(this).parents('tr').find('input:eq(2)').val();
    // if (componentes_agregados.includes(f_producto)) {
    //   notaError('Ya fue agregado');
    // }
    // if (v == true && !componentes_agregados.includes(f_producto)) {
    if (v == true) {
      var division = $(this).parents('tr').find('input:eq(0)').val();
      var nombre = $(this).parents('tr').find('input:eq(1)').val();
      var tabla = $("#tablaDetalle");
      var cantidad = parseFloat($("#cantidad_resultado").val());
      if ($("#confirmar").val() == false) {
        html = "<tr>" +
          "<td>" + cantidad + "</td>" +
          "<td>" + division + "</td>" +
          "<td>" + nombre + "</td>" +
          "<td>" +
          "<input type='hidden' name='f_producto[]' value ='" + f_producto + "'>" +
          "<input type='hidden' name='cantidad[]' value ='" + cantidad + "'>" +
          "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
          "<i class='fas fa-times'></i>" +
          "</button>" +
          "</td>" +
          "</tr>";
      } else {
        html = "<tr>" +
          "<td><input type='number' placeholder='cantidad' name='cantidad[]' onKeyUp='recalcular();' class='form-control form-control-sm' value='" + cantidad + "'>" +
          '	<input type="hidden" name="descuento[]" id="descuento_h">' +
          '<input type="hidden" name="fecha_vencimiento[]" id="fecha_vencimiento_h">' +
          '<input type="hidden" name="precio[]" id="precio_h">' +
          '<input type="hidden" name="lote[]" id="lote_h">' +
          '<input type="hidden" name="f_estante[]" id="estante_h">' +
          '	<input type="hidden" name="nivel[]" id="nivel_h">' +
          '<input type="hidden" name="state-of[]" id="state-of" value="false">' +
          "</td>" +
          "<td>" + division + "&nbsp;<b>" + nombre + "</b></td>" +
          "<td>" +
          "<input type='hidden' name='f_producto[]' value ='" + f_producto + "'>" +
          "<input type='hidden' name='estado[]' value ='nuevo'>" +
          '<center>' +
          '<button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#almacenar" id="almacen">' +
          '<i class="fas fa-check"></i>' +
          '</button>' +
          "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
          "<i class='fas fa-times'></i>" +
          "</button>" +
          '</center>' +
          "</td>" +
          "</tr>";
      }
      tabla.append(html);
      componentes_agregados.push(f_producto);
      notaInfo('Ha sido agregado en detalles');
    }
  });
  $("#tablaDetalle").on('click', '#eliminar_detalle', function (e) {
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var cantidad = $(this).parents('tr').find('input:eq(1)').val();
    var precio = $(this).parents('tr').find('input:eq(2)').val();
    var solicitud = $(this).parents('tr').find('input:eq(4)').val();
    if (solicitud != "undefined") {
      $('#bts' + solicitud).attr("disabled", false);
    }
    total_c = parseFloat(cantidad) * parseFloat(precio);
    cambiarTotal(total_c, 0);
    var indice = componentes_agregados.indexOf(elemento);
    componentes_agregados.splice(indice, 1);
    $(this).parents('tr').remove();
    notaNotice("El producto fue removido");
  });
  $("#tablaDetalle").on('click', '#eliminar_fila_pedido', function (e) {
    var elemento = $(this).parent('center').parent('td').parent('tr').find('td:eq(2)').find('input:eq(0)').val();
    var estado = $(this).parent('center').parent('td').parent('tr').find('td:eq(2)').find('input:eq(1)').val();
    var indice = componentes_agregados.indexOf(elemento);
    componentes_agregados.splice(indice, 1);
    $(this).parent('center').parent('td').parent('tr').remove();
    if (estado != 'nuevo') {
      var eliminado = "<input type='hidden' name='eliminado[]' value='" + estado + "'>";
      $('#eliminados').append(eliminado);
    }
    notaNotice("El producto fue removido");
  });
  function validaciones() { //campo cantidad
    c = 0;
    var error = [];
    valor = true;
    if ($("#cantidadp").val() == "") {
      error[c] = 'El campo cantidad es requerido';
      c = c + 1;
      valor = false;
    } if (parseFloat($("#cantidadp").val()) <= 0) {
      error[c] = 'La cantidad debe ser mayor a cero';
      c = c + 1;
      valor = false;
    }
    if ($('#producto').val() == "") {
      error[c] = 'No ha ingresado un código de producto válido';
      c = c + 1;
      valor = false;
    }
    for (var i = 0; i < c; i++) {
      notaError(error[i]);
    }
    return valor;
  }
  $("#agregar").on("click", function () {
    gd = false;
    var v = validaciones();
    f_producto = $('#idoculto').val();
    v2 = componentes_agregados.includes(f_producto);
    if (v == true && !v2) {
      var tabla = $("#tablaDetalle");
      var cantidad = parseFloat($("#cantidadp").val());
      if ($("#confirmar").val() == false) {
        if (parseFloat($("#exioculto").val()) >= cantidad || $("#tipo").val() != '2') {
          gd = true;
          total_c = (cantidad * parseFloat($("#preoculto").val())).toFixed(2);
          cambiarTotal(total_c, 1);
          html = "<tr id='itr" + contadorcp + "'>" +
            "<td>" + cantidad + "</td>" +
            "<td>" + $("#divoculto").val() + "</td>" +
            "<td>" + $("#nomoculto").val() + "</td>";
          if ($('#tipo').val() == '2') {
            html = html + "<td>$ " + parseFloat($("#preoculto").val()).toFixed(2) + "</td>" +
              "<td>$ " + total_c + "</td>";
          }
          html = html + "<td>" +
            "<input type='hidden' name='f_producto[]' value ='" + f_producto + "'>" +
            "<input type='hidden' name='cantidad[]' value ='" + cantidad + "'>";
          if ($('#tipo').val() == '2') {
            html = html + "<input type='hidden' name='precio[]' value ='" + $("#preoculto").val() + "'>" +
              "<input type='hidden' name='tipo_detalle[]' value ='1'>" +
              "<button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#modalcp' onclick='cambiarPrecio(" + contadorcp + ");'>" +
              "<i class='fas fa-dollar-sign'></i>" +
              "</button>";
          }
          html = html + "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
            "<i class='fas fa-times'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          notaInfo('Ha sido agregado en detalles');
        } else {
          notaError('Cantidad supera las existencias');
        }
      } else {
        gd = true;
        html = "<tr>" +
          "<td><input type='number' placeholder='cantidad' name='cantidad[]' class='form-control valu' value='" + cantidad + "'></td>" +
          "<td>" + $("#divoculto").val() + "</td>" +
          "<td>" + $("#nomoculto").val() + "</td>" +
          "<td><input name='descuento[]' class='form-control vald' type='number' placeholder='%' value='0'></td>" +
          "<td><input name='fecha_vencimiento[]' class='form-control valt' type='date' placeholder=''></td>" +
          "<td><input name='precio[]' class='form-control valc' type='number' placeholder='Precio'></td>" +
          "<td><input name='lote[]' class='form-control vali' type='text' placeholder='N° de lote'></td>" +
          "<td><select name='f_estante[]' class='form-control vals' id='f_estante" + f_producto + "' onChange='cambioEstante(" + f_producto + ")'>" + $('#opciones').val() + "</select></td>" +
          "<td><select name='nivel[]' class='form-control' id='nivel" + f_producto + "'><option value=''>Nivel</option></select></td>" +
          "<td>" +
          "<input type='hidden' name='f_producto[]' value ='" + f_producto + "'>" +
          "<input type='hidden' name='estado[]' value ='nuevo'>" +
          "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
          "<i class='fas fa-times'></i>" +
          "</button>" +
          "</td>" +
          "</tr>";
        notaInfo('Ha sido agregado en detalles');
      }
      if (gd) {
        tabla.append(html);
        $('#idoculto').val("");
        $('#divoculto').val("");
        $('#nomoculto').val("");
        $('#codigoBuscar').val("");
        $('#producto').val("");
        $('#cantidadp').val("1");
        componentes_agregados.push(f_producto);
      }
    } else if (v2) {
      notaError('El producto ya se encuentra incluido');
    }
    contadorcp++;
  });
  $("#resultadoCliente").keyup(function () {
    var valor = $("#resultadoCliente").val();
    conteo = valor.length;
    var tabla = $("#tablaBuscarCliente");
    if (conteo > 0) {
      var ruta = $('#guardarruta').val() + "/buscarCliente/" + valor;
      $.get(ruta, function (res) {
        tabla.empty();
        html = "<thead><th>Nombre</th><th>Apellido</th><th>Edad</th><th>Teléfono</th><th>DUI</th><th style='width : 80px'>Acción</th></thead>";
        tabla.append(html);
        $(res).each(function (key, value) {
          aux_fecha = value.fechaNacimiento.split('-');
          edad = calculate_age(aux_fecha[0], aux_fecha[1], aux_fecha[2]);
          if (value.telefono == null)
            value.telefono = "";
          if (value.dui == null)
            value.dui = "";
          cadena = "<tr>" +
            "<td id='tbcn" + value.id + "'>" + value.nombre + "</td>" +
            "<td id='tbca" + value.id + "'>" + value.apellido + "</td>" +
            "<td>" + edad + " años</td>" +
            "<td>" + value.telefono + "</td>" +
            "<td>" + value.dui + "</td>" +
            "<td>" +
            "<button type='button' class='btn btn-sm btn-primary' onclick='agregarCliente(" + value.id + ");' data-dismiss='modal'>" +
            "<i class='fas fa-check'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          tabla.append(cadena);
        });
      });
    } else {
      tabla.empty();
    }
  });
  $('#confirmarPedido').on('click', function (e) {
    var bandera = true;

    var valido = new Validated('fac');
    valido.required();
    bandera = valido.value(bandera);


    $("input[name='state-of[]']").each(function (k, v) {
      if ($(v).val() == "false") {
        bandera = false;
      }
    });

    if (bandera) {
      acumulado = parseFloat($('#total_venta_aux').val());
      var arqueo = parseFloat($('#arqueo').val());
      if (arqueo >= acumulado) {
        $('#formVender').submit();
      } else {
        notaError('El costo supera el valor en caja');
      }
    } else {
      notaError('Debe completar todos los campos');
    }
  });
  $('#confirmarAsignacion').on('click', function (e) {
    var error = v = 0;
    $('.vals').each(function () { //Lote
      if ($(this).val().trim() == "") {
        error++;
        v = 1;
      }
    });
    if (v == 1) {
      notaError('Todos los productos deben asignarse a un estante');
    } else {
      $("#formAsignar").submit();
    }
  });
});
function entero(obj, e, valor) {
  val = (document.all) ? e.keyCode : e.which;
  if (val > 47 && val < 58) {
    return true;
  } else {
    return false;
  }
}
function agregarCliente(id) {
  nombre = $('#tbcn' + id).text();
  apellido = $('#tbca' + id).text();
  $('#f_clientea').val(nombre + " " + apellido);
  $('#f_cliente').val(id);
}

function limpiarTabla() {
  $('#tablaBuscarCliente').empty();
  $('#resultadoCliente').val("");
}
function limpiarTablaVenta() {
  $('#tablaBuscar').empty();
  $('#cantidad_resultado').val("1");
  $('#resultadoVenta').val("");
}
function cambioRadio(t) {
  radio = t;
  limpiarTablaVenta();
}
async function registrarventa(id) {
  var v = validarCantidad();
  if (v == true) {
    var cantidad = parseFloat($('#cantidad_resultado').val());
    var existencia = parseFloat($('#ct' + id).text());
    c1 = $('#cu' + id).text();
    c2 = $('#cd' + id).text();
    if (radio != 3) {
      if (cantidad > existencia || componentes_agregados.includes("" + id + "")) {
        if (cantidad > existencia) {
          notaError("La cantidad solicitada supera las existencias");
        } else {
          notaError('El producto ya se encuentra incluido');
        }
      } else {
        c4 = parseFloat($('#cc' + id).text()).toFixed(2);
        tabla = $('#tablaDetalle');
        total_c = parseFloat(cantidad * c4).toFixed(2);
        cambiarTotal(total_c, 1);
        html = "<tr id='itr" + contadorcp + "'>" +
          "<td>" + cantidad + "</td>" +
          "<td>" + c2 + "</td>" +
          "<td>" + c1 + "</td>" +
          "<td>$ " + c4 + "</td>" +
          "<td>$ " + total_c + "</td>" +
          "<td>" +
          "<input type='hidden' name='f_producto[]' value='" + id + "'>" +
          "<input type='hidden' name='cantidad[]' value='" + cantidad + "'>" +
          "<input type='hidden' name='precio[]' value='" + c4 + "'>" +
          "<input type='hidden' name='tipo_detalle[]' value='1'>" +
          "<button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#modalcp' onclick='cambiarPrecio(" + contadorcp + ");'>" +
          "<i class='fas fa-dollar-sign'></i>" +
          "</button>" +
          "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
          "<i class='fas fa-times'></i>" +
          "</button>" +
          "</td>" +
          "</tr>";
        tabla.append(html);
        componentes_agregados.push("" + id + "");
        notaInfo('Ha sido agregado en detalles');
      }
    } else {
      var ruta = $('#guardarruta').val() + "/comprobarServicio/" + id + "/" + cantidad;
      var tabla = $("#tablaBuscar");
      await $.get(ruta, async function (res) {

        if (res == 1) {
          console.log('Servicio');
          c2 = parseFloat(c2).toFixed(2);
          tabla = $('#tablaDetalle');
          total_c = parseFloat(cantidad * c2).toFixed(2);
          cambiarTotal(total_c, 1);
          html = "<tr id='itr" + contadorcp + "'>" +
            "<td>" + cantidad + "</td>" +
            "<td>" + c1 + "</td>" +
            "<td></td>" +
            "<td>$ " + c2 + "</td>" +
            "<td>$ " + total_c + "</td>" +
            "<td>" +
            "<input type='hidden' name='f_producto[]' value='" + id + "'>" +
            "<input type='hidden' name='cantidad[]' value='" + cantidad + "'>" +
            "<input type='hidden' name='precio[]' value='" + c2 + "'>" +
            "<input type='hidden' name='tipo_detalle[]' value='2'>" +
            "<button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#modalcp' onclick='cambiarPrecio(" + contadorcp + ");'>" +
            "<i class='fas fa-dollar-sign'></i>" +
            "</button>" +
            "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
            "<i class='fas fa-times'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          tabla.append(html);
          notaInfo('Ha sido agregado en detalles');
        } else {
          notaError('No hay sufientes productos para usar la promoción');
        }
      });
    }
    contadorcp++;
  }
}
async function registrarsolicitud(c1, c2, id, ids) {
  console.log('Servicio');
  c2 = parseFloat(c2).toFixed(2);
  tabla = $('#tablaDetalle');
  total_c = parseFloat(1 * c2).toFixed(2);
  cambiarTotal(total_c, 1);
  $('#bts' + ids).attr("disabled", true);
  html = "<tr id='itr" + contadorcp + "'>" +
    "<td>" + 1 + "</td>" +
    "<td>" + c1 + "</td>" +
    "<td></td>" +
    "<td>$ " + c2 + "</td>" +
    "<td>$ " + total_c + "</td>" +
    "<td>" +
    "<input type='hidden' name='f_producto[]' value='" + id + "'>" +
    "<input type='hidden' name='cantidad[]' value='" + 1 + "'>" +
    "<input type='hidden' name='precio[]' value='" + c2 + "'>" +
    "<input type='hidden' name='tipo_detalle[]' value='2'>" +
    "<input type='hidden' name='solicitud[]' value='" + ids + "'>" +
    "<button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#modalcp' onclick='cambiarPrecio(" + contadorcp + ");'>" +
    "<i class='fas fa-dollar-sign'></i>" +
    "</button>" +
    "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
    "<i class='fas fa-times'></i>" +
    "</button>" +
    "</td>" +
    "</tr>";
  tabla.append(html);
  contadorcp++;
  notaInfo('Ha sido agregado en detalles');
}

function validarCantidad() { //Campo cantidad_resultado
  c = 0;
  var error = [];
  valor = true;
  if ($("#cantidad_resultado").val() == "") {
    error[c] = 'El campo cantidad es requerido';
    c = c + 1;
    valor = false;
  } if (parseFloat($("#cantidad_resultado").val()) <= 0) {
    error[c] = 'La cantidad debe ser mayor a cero';
    c = c + 1;
    valor = false;
  }
  for (var i = 0; i < c; i++) {
    notaError(error[i]);
  }
  return valor;
}
function cambiarTotal(cantidad, tipo) { //cantidad que recibe y si la cantidad se suma o resta
  descuento = $('#descuento').val();
  if (descuento == "") {
    descuento = 0;
  } else {
    descuento = parseFloat(descuento);
  }
  total = parseFloat($('#total_venta_aux').val());
  if (tipo == 1) {
    total = parseFloat(total) + parseFloat(cantidad);
  } else {
    total = parseFloat(total) - parseFloat(cantidad);
  }

  $('#total_venta').text((total - (total * (descuento / 100))).toFixed(2));
  $('#total_venta_aux').val(parseFloat(total).toFixed(2));
}
function validarFechaMenorActual(date) {
  actual = $('#fechaM').val();
  if (date > actual) {
    return false;
  }
  else {
    return true;
  }
}
function limpiarCliente() {
  $('#f_cliente').val("");
  $('#f_clientea').val("");
}
function cambiarPrecio(ntr) {
  $('#cpoculto').val(ntr);
  var pa = $("#itr" + ntr).find('input:eq(2)').val();//precio actual de casilla
  $('#cambioPrecioModal').val(pa);
}
function guardarcp() {
  var indice = $('#cpoculto').val();
  var precio = parseFloat($('#cambioPrecioModal').val());
  if (precio > 0) {
    var cantidad = parseFloat($("#itr" + indice).find('input:eq(1)').val());
    var precio_anterior = parseFloat($("#itr" + indice).find('input:eq(2)').val());
    var total_anterior = precio_anterior * cantidad;
    cambiarTotal(total_anterior, 0);
    var total = cantidad * precio;
    cambiarTotal(total, 1);
    $("#itr" + indice).find('input:eq(2)').val(precio.toFixed(2));
    $("#itr" + indice).find('td:eq(3)').text("$" + precio.toFixed(2));
    $("#itr" + indice).find('td:eq(4)').text("$" + total.toFixed(2));
    $("#cerrarCP").click();
    $('#cambioPrecioModal').val('100');
    notaNotice('El precio ha sido cambiado');
  } else {
    notaError('No es un precio válido');
  }

}
