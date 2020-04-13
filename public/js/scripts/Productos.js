$(document).on('ready', async function () {
  var division_agregada = [];
  var componentes_agregados = [];
  var codigos_agregados = [];
  var limite_divisiones = $("#contador_division").val();
  var limite_componente = $("#contador_componente").val();
  for (i = 0; i <= limite_divisiones; i++) {
    var division_tmp = $("#division" + i).val();
    division_agregada.push(division_tmp);
  }
  for (i = 0; i <= limite_componente; i++) {
    var componente_tmp = $("#componente" + i).val();
    componentes_agregados.push(componente_tmp);
  }
  $('#agregar_division').click(async function () {
    var codigo = $('#codigo').val();
    var division = $('#division').find('option:selected').text();
    var valor = $('#division').find('option:selected').val();
    var cantidad = $('#cantidad').val();
    var precio = $('#precio').val();
    var stock = $('#minimo').val();
    var com = $('#hchange').val(); //Cantidad o contenido
    var n_mesesv = $('#n_meses').find('option:selected').val();
    var n_mesesp = $('#n_meses').find('option:selected').text();
    var idu = 0;
    var unidad = "";
    if (com == "o") {
      idu = $('#v_valor').find('option:selected').val();
      unidad = $('#v_valor').find('option:selected').text();
    } else {
      unidad = $('#valor').val();
    }
    var vmc = valor + cantidad; //Valor más cantidad
    if (codigos_agregados.includes(codigo)) {
      notaError("Código ya fue agregado en otra división");
    } else if (division_agregada.includes(vmc)) {
      notaError("Ya existe una división con la misma cantidad");
    } else {
      vc = await validarCodigo();
      vp = await validarPresentacionE();
      vr = await validarPrecio();
      vs = await validarStock();
      if (!vp && !vc && !vr && !vs) {
        var html_texto =
          "<tr class='divis'>" +
          "<td>" +
          codigo +
          "</td>" +
          "<td>" +
          division +
          "</td>" +
          "<td>" +
          cantidad + " " + unidad +
          "</td>" +
          "<td>" +
          "$ " + precio +
          "</td>" +
          "<td>" +
          stock +
          "</td>" +
          "<td>" +
          n_mesesp +
          "</td>" +
          "<td>" +
          "<input type='hidden' name='divisiones[]' value='" + valor + "'/>" +
          "<input type='hidden' name='codigos[]' value='" + codigo + "'/>" +
          "<input type='hidden' name='cantidades[]' value='" + cantidad + "'/>" +
          "<input type='hidden' name='precios[]' value='" + precio + "'/>" +
          "<input type='hidden' name='idus[]' value='" + idu + "'/>" +
          "<input type='hidden' name='stocks[]' value='" + stock + "'/>" +
          "<input type='hidden' name='meses[]' value='" + n_mesesv + "'/>" +
          "<button type='button' name='button' class='btn btn-sm btn-danger' id='eliminar_division'>" +
          "<i class='fas fa-times'></i>" +
          "</button>" +
          "</td>" +
          "</tr>";

        division_agregada.push(vmc);
        codigos_agregados.push(codigo);
        $("#tablaDivision").append(html_texto);
        $("#cantidad").val("1");
        $("#precio").val("0.00");
        $("#codigo").val("");
        $("#minimo").val("40");
        $("#n_meses").val("3");
        notaInfo('Ha sido agregado en divisiones');
      }
    }
  });

  $("#tablaDivision").on('click', '#eliminar_division', function (e) {
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var cantidad = $(this).parents('tr').find('input:eq(2)').val();
    var cod = $(this).parents('tr').find('input:eq(1)').val();
    var indice = division_agregada.indexOf(elemento + cantidad);
    var indice2 = codigos_agregados.indexOf(cod);
    division_agregada.splice(indice);
    codigos_agregados.splice(indice2);
    $(this).parent('td').parent('tr').remove();
  });

  $("#componente").keyup(function () {
    var valor = $("#componente").val();
    if (valor.length > 0) {
      var ruta = $('#guardarruta').val() + "/buscarComponenteProducto/" + valor;
      var tabla = $("#tablaBuscarComponente");
      $.get(ruta, function (res) {
        tabla.empty();
        head =
          "<thead>" +
          "<th>Componente</th>" +
          "<th style='width : 80px'>Acción</th>" +
          "</thead>";
        tabla.append(head);
        $(res).each(function (key, value) {
          html =
            "<tr>" +
            "<td>" +
            value.nombre +
            "</td>" +
            "<td>" +
            "<input type='hidden' name='nombre_componente[]' value ='" + value.nombre + "'>" +
            "<input type='hidden' name='id_componente[]' value ='" + value.id + "'>" +
            "<button type='button' class='btn btn-sm btn-primary' id='agregar_componente'>" +
            "<i class='fa fa-check'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          tabla.append(html);
        });
      });
    }
  });

  $("#tablaBuscarComponente").on('click', '#agregar_componente', function (e) {
    e.preventDefault();
    var nombre = $(this).parents('tr').find('input:eq(0)').val();
    var id = $(this).parents('tr').find('input:eq(1)').val();
    var tabla = $("#tablaComponente");
    var tabla_busqueda = $("#tablaBuscarComponente");
    var cantidad = $("#cantidad_componente").val();
    var unidad = $("#unidad").find("option:selected").text();
    var unidad_id = $("#unidad").find("option:selected").val();
    var html =
      "<tr>" +
      "<td>" +
      nombre +
      "</td>" +
      "<td>" +
      cantidad + " " + unidad +
      "</td>" +
      "<td>" +
      "<input type='hidden' name='componentes[]' value ='" + id + "'>" +
      "<input type='hidden' name='cantidades_componentes[]' value ='" + cantidad + "'>" +
      "<input type='hidden' name='unidades[]' value ='" + unidad_id + "'>" +
      "<button type='button' class='btn btn-sm btn-danger' id='eliminar_componente'>" +
      "<i class='fas fa-times'></i>" +
      "</button>" +
      "</td>" +
      "</tr>";
    if (componentes_agregados.indexOf(id) == -1) {
      componentes_agregados.push(id);
      tabla.append(html);

      tabla_busqueda.empty();
      head =
        "<thead>" +
        "<th>Componente</th>" +
        "<th style='width : 80px'>Acción</th>" +
        "</thead>";
      tabla_busqueda.append(head);

      $("#cantidad_componente").val("1");
      $("#componente").val("");

      $("#componente").focus();
    }
  });

  $("#tablaComponente").on('click', '#eliminar_componente', function (e) {
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = componentes_agregados.indexOf(elemento);
    componentes_agregados.splice(indice);
    $(this).parent('td').parent('tr').remove();
  });

  $("#tablaDivision").on("click", '#eliminar_division_antigua', function (e) {
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = division_agregada.indexOf(elemento);
    division_agregada.splice(indice);

    var valores = $(this).parents('tr').find('input:eq(1)').val();
    $("#division_eliminada").val(valores);
    $(this).parent('div').parent('td').parent('tr').remove();
  });

  $("#tablaComponente").on('click', '#eliminar_componente_antiguo', function (e) {
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = componentes_agregados.indexOf(elemento);
    componentes_agregados.splice(indice);

    var valores = $(this).parents('tr').find('input:eq(1)').val();
    $("#componente_eliminado").val(valores);
    $(this).parent('td').parent('tr').remove();
  });
  $('#f_presentacion').on('change', function (e) {
    var obtener = $("#f_presentacion").find('option:selected');
    nPresentacion = obtener.text();
    $('#valor').val(nPresentacion);
  });
  $('#contenido').click(function () {
    if (this.checked) {
      $('#opc1').css("display", "none");
      $('#opc2').css("display", "block");
      $('#lchange').text("Contenido *");
      $('#hchange').val("o");
    } else {
      $('#opc1').css("display", "block");
      $('#opc2').css("display", "none");
      $('#lchange').text("Cantidad *");
      $('#hchange').val("a");
    }
  });

  $("#smartwizard").smartWizard({
    lang: {
      next: 'Siguiente',
      previous: 'Anterior'
    },
    toolbarSettings: {
      toolbarPosition: 'bottom', // none, top, bottom, both
      toolbarButtonPosition: 'right', // left, right
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      toolbarExtraButtons: [
        $('<button type="button"></button>').text('Guardar')
          .addClass('btn btn-primary btn-sm')
          .on('click', save_producto),
        $('<a href="../productos?estado=1"></a>').text('Cancelar')
          .addClass('btn btn-light btn-sm')
      ]
    },
    keyNavigation: false,
  });
  $("#smartwizarde").smartWizard({
    lang: {
      next: 'Siguiente',
      previous: 'Anterior'
    },
    toolbarSettings: {
      toolbarPosition: 'bottom', // none, top, bottom, both
      toolbarButtonPosition: 'right', // left, right
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
      toolbarExtraButtons: [
        $('<button type="button"></button>').text('Guardar')
          .addClass('btn btn-primary btn-sm')
          .on('click', save_producto),
        $('<a href="../../productos?estado=1"></a>').text('Cancelar')
          .addClass('btn btn-light btn-sm')
      ]
    },
    keyNavigation: false,
  });
  function save_producto() {
    n = vnombre();
    p = vpresentacion();
    c = vcategoria();
    v = vproveedor();
    d = vdivision();
    if (n && p && c && v && d) {
      $('#form').submit();
    }
  }
});
async function validarCodigo() {
  var codigo = $("#codigo").val();
  if (codigo.trim() != "") {
    var ruta = $('#guardarruta').val() + "/existeCodigoProducto/" + codigo;
    $.get(ruta, await function (existe) {
      if (existe == 1) {
        notaError('¡Ya existe una división con el código ' + codigo + '!');
        $("#codigo").val("");
      }
      return existe;
    });
  } else {
    notaError('¡Necesita proporcionar un código!');
    $("#codigo").val("");
    return 1;
  }
}
function validarPresentacionE() {
  if ($('#f_presentacion').find('option:selected').val().trim() == "") {
    notaError('¡Seleccione una presentación!');
    return 1;
  } else {
    return 0;
  }
}
function validarPrecio() {
  if (parseFloat($('#precio').val()) <= 0) {
    notaError('¡Precio debe ser mayor que $0.00!');
    return 1;
  } else {
    return 0;
  }
}
function validarStock() {
  if (parseFloat($('#minimo').val()) <= 0) {
    notaError('¡Stock debe ser mayor que cero!');
    return 1;
  } else {
    return 0;
  }
}
function mensajeError(sms) {
  swal({
    type: 'error',
    title: sms,
    showConfirmButton: false,
    timer: 2000,
    animation: false,
    customClass: 'animated tada'
  }).catch(swal.noop);
}
function vnombre() {
  if ($('#nombre').val().trim() == "") {
    notaError('El campo nombre es obligatorio');
    return 0;
  } else {
    return 1;
  }
}
function vpresentacion() {
  p = $('#f_presentacion').val();
  if (p.trim() == "" || parseFloat(p) < 1) {
    notaError('Seleccione una presentación válida');
    return 0;
  } else {
    return 1;
  }
}
function vcategoria() {
  c = $('#f_categoria').val();
  if (c.trim() == "" || parseFloat(c) < 1) {
    notaError('Seleccione una categoría válida');
    return 0;
  } else {
    return 1;
  }
}
function vproveedor() {
  p = $('#f_proveedor').val();
  if (p.trim() == "" || parseFloat(p) < 1) {
    notaError('Seleccione una droguería válida');
    return 0;
  } else {
    return 1;
  }
}
function vdivision() {
  c = 0;
  $('.divis').each(function () {
    c++;
  });
  if (c == 0) {
    notaError('No se agregó ninguna división');
    return 0;
  } else {
    return 1;
  }
}

//Modales de Productos
$("#guardarPresentacionModal").on('click', async function (e) {
  e.preventDefault();
  var v_nombre = $("#nombrePresentacionModal").val();
  var token = $("#tokenPresentacionModal").val();

  await $.ajax({
    url: $('#guardarruta').val() + "/ingresoPresentacion",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Presentación registrada!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
    },
    error: function (data) {
      if (data.status === 422) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          notaError(value);
        });
      }
    }
  });
  rellenarPresentacion();
  $("#nombrePresentacionModal").val("");
});

function rellenarPresentacion() {
  var presentacion = $("#f_presentacion");
  var ruta = $('#guardarruta').val() + "/llenarPresentacion";

  $.get(ruta, function (res) {
    presentacion.empty();
    presentacion.attr('placeholder', 'Seleccione una presentación');
    $(res).each(function (key, value) {
      presentacion.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
$("#guardarCategoriaModal").on('click', async function (e) {
  e.preventDefault();
  var v_nombre = $("#nombreCategoriaModal").val();
  var token = $("#tokenCategoriaModal").val();

  await $.ajax({
    url: $('#guardarruta').val() + "/ingresoCategoria",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Categoría registrada!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
    },
    error: function (data) {
      if (data.status === 422) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          notaError(value);
        });
      }
    }
  });
  rellenarCategoria();
  $("#nombreCategoriaModal").val("");
});

function rellenarCategoria() {
  var categoria = $("#f_categoria");
  var ruta = $('#guardarruta').val() + "/llenarCategoria";

  $.get(ruta, function (res) {
    categoria.empty();
    categoria.attr('placeholder', 'Seleccione una categoría');
    $(res).each(function (key, value) {
      categoria.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
$("#guardarDivisionModal").on('click', async function (e) {
  e.preventDefault();
  var v_nombre = $("#nombreDivisionModal").val();
  var token = $("#tokenDivisionModal").val();

  await $.ajax({
    url: $('#guardarruta').val() + "/ingresoDivision",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡División registrada!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
    },
    error: function (data) {
      if (data.status === 422) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          notaError(value);
        });
      }
    }
  });
  rellenarDivision();
  $("#nombreDivisionModal").val("");
});

function rellenarDivision() {
  var division = $("#division");
  var ruta = $('#guardarruta').val() + "/llenarDivision";

  $.get(ruta, function (res) {
    division.empty();
    division.attr('placeholder', 'Seleccione una división');
    $(res).each(function (key, value) {
      division.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
$("#guardarUnidadModal").on('click', async function (e) {
  e.preventDefault();
  var v_nombre = $("#nombreUnidadModal").val();
  var token = $("#tokenUnidadModal").val();

  await $.ajax({
    url: $('#guardarruta').val() + "/ingresoUnidad",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Unidad registrada!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
    },
    error: function (data) {
      if (data.status === 422) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          notaError(value);
        });
      }
    }
  });
  rellenarUnidad();
  $("#nombreUnidadModal").val("");
});
function rellenarUnidad() {
  var unidad = $("#v_valor");//Unidad de división
  var unidadc = $("#unidad");//Unidad de componente
  var ruta = $('#guardarruta').val() + "/llenarUnidad";

  $.get(ruta, function (res) {
    unidad.empty();
    unidadc.empty();
    $(res).each(function (key, value) {
      unidad.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
      unidadc.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
$("#guardarComponenteModal").on('click', async function (e) {
  e.preventDefault();
  var v_nombre = $("#nombreComponenteModal").val();
  var token = $("#tokenComponenteModal").val();

  await $.ajax({
    url: $('#guardarruta').val() + "/ingresoComponente",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Componente registrado!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
    },
    error: function (data) {
      if (data.status === 422) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          notaError(value);
        });
      }
    }
  });
  $("#nombreComponenteModal").val("");
});
$("#guardarProveedorModal").on('click', async function (e) {
  e.preventDefault();
  var v_nombre = $("#nombreProveedorModal").val();
  var v_correo = $("#correoProveedorModal").val();
  var v_telefono = $("#telefonoProveedorModal").val();
  var token = $("#tokenProveedorModal").val();

  await $.ajax({
    url: $('#guardarruta').val() + "/ingresoProveedor",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
      correo: v_correo,
      telefono: v_telefono,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Proveedor registrado!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
    },
    error: function (data) {
      if (data.status === 422) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          notaError(value);
        });
      }
    }
  });
  rellenarProveedor();
  $("#nombreProveedorModal").val("");
  $("#correoProveedorModal").val("");
  $("#telefonoProveedorModal").val("");
});
function rellenarProveedor() {
  var proveedor = $("#f_proveedor");
  var ruta = $('#guardarruta').val() + "/llenarProveedor";

  $.get(ruta, function (res) {
    proveedor.empty();
    $(res).each(function (key, value) {
      proveedor.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
