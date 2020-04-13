var promos_agregadas = [];
$(document).on('ready', function () {


    $("#resultado_promo").keyup(function () {
        var valor = $("#resultado_promo").val();
        tipo = $('#busq').val();
        conteo = valor.length;
        var tabla = $("#tablaBuscarPromo");
        if (conteo > 0) {
            if (tipo == 1) {
                var ruta = $('#guardarruta').val() + "/buscarProductoTransaccion/1/" + valor;
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
                                "<td id='cuno" + value2.id + "'>" +
                                value.nombre +
                                "</td>" +
                                "<td id='cdos" + value2.id + "'>" +
                                n_division +
                                "</td>" +
                                "<td>" +
                                "<button type='button' class='btn btn-sm btn-primary' onclick='registrarPromo(" + value2.id + ");'>" +
                                "<i class='fas fa-check'></i>" +
                                "</button>" +
                                "</td>" +
                                "</tr>";
                            tabla.append(html);
                        });
                    });
                });

            } else {
                var ruta = $('#guardarruta').val() + "/buscarServicios/" + valor + "/b";
                $.get(ruta, function (res) {
                    tabla.empty();
                    cab = "<thead>" +
                        "<th>Resultado</th>" +
                        "<th style='width : 80px'>Acción</th>" +
                        "</thead>";
                    tabla.append(cab);
                    $(res).each(function (key, value) {
                        html = "<tr>" +
                            "<td id='cuno" + value.id + "'>" + value.nombre + "</td>" +
                            "<td>" +
                            "<button type='button' class='btn btn-sm btn-primary' onclick='registrarPromo(" + value.id + ");'>" +
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
        } else {
            tabla.empty();
        }
    });
});
function cambioBusq(vi) {
    $('#busq').val(vi);
    $('#cantidad_resultado').val(1);
    $('#resultado_promo').val("");
    $("#tablaBuscarPromo").empty();
}
function registrarPromo(id) {
    tipo = $('#busq').val();
    cantidad = parseFloat($('#cantidad_resultado').val());

    if (tipo == 1 || tipo == '1') {
        identificador = "p" + id;
        nombre = $("#cuno" + id).text() + " " + $("#cdos" + id).text();

    } else {
        identificador = "s" + id;
        nombre = $("#cuno" + id).text();

    }
    if (!promos_agregadas.includes(identificador)) {
        if (cantidad > 0) {
            console.log(identificador);
            console.log(id);
            console.log(nombre);
            console.log(cantidad);

            html =
                "<tr id='el" + identificador + "'>" +
                "<td>" +
                nombre +
                "</td>" +
                "<td>" +
                cantidad +
                "</td>" +
                "<td>" +
                "<input type='hidden' name='tipo[]' value ='" + tipo + "'>" +
                "<input type='hidden' name='idp[]' value ='" + id + "'>" +
                "<input type='hidden' name='cantidad[]' value ='" + cantidad + "'>" +
                "<button type='button' class='btn btn-sm btn-danger' onClick='eliminarPromo(" + '"' + identificador + '"' + ")'>" +
                "<i class='fas fa-times'></i>" +
                "</button>" +
                "</td>" +
                "</tr>";

            $('#tablaPromos').append(html);
            $('#cantidad_resultado').val(1);
            promos_agregadas.push(identificador);
        } else {
            notaError('Ingrese una cantidad válida');
        }
    } else {
        notaError('El producto ya se encuentra incluido');
    }
}
function eliminarPromo(elemento) {
    var indice = promos_agregadas.indexOf(elemento);
    promos_agregadas.splice(indice, 1);
    $('#el' + elemento).remove();
}