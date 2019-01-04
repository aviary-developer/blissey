var contadorSelectsParametros = 1;
$('#agregarSeccionExamen').click(function () {
  $('.seccionesExamenes').append("<div class='col-md-6 col-sm-6 col-xs-12'>" +
    "<div class='x_panel'>" +
    "<div class='x_title'>" +
    "<div class='col-md-9 col-sm-9 col-xs-12'>" +
    "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>" +
    "<select class='form-control has-feedback-left' name='selectSeccion" + contadorSelectsParametros + "' id='selectSeccion" + contadorSelectsParametros + "'><option><strong>Cargando...</strong></option></select></div>" +
    "<ul class='nav navbar-center panel_toolbox'>" +
    "<li><a class='close-link' onClick='cerrarSeccion(this);'><i class='fa fa-close'></i></a></li>" +
    "</ul><div class='clearfix'></div></div>" +
    "<div class='row'><div class='col-md-4 col-sm-4 col-xs-12 form-group'><label>" +
    "<input type='checkbox' name='checkReactivo' id='checkReactivo" + contadorSelectsParametros + "' onClick='chekearReactivo(this," + contadorSelectsParametros + ");' class='js-switch' unchecked /> Añadir reactivo" +
    "</label></div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-5 col-sm-12 col-xs-12 form-group'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span><select class='form-control has-feedback-left' name='selectParametrosExamenes" + contadorSelectsParametros + "' id='selectParametrosExamenes" + contadorSelectsParametros + "'><option><strong>Cargando...</strong></option></select></div>" +
    "<div id='divReactivo" + contadorSelectsParametros + "' class='col-md-5 col-sm-12 col-xs-12 form-group' style='display:none;'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span><select class='form-control has-feedback-left'  name='selectReactivosExamenes" + contadorSelectsParametros + "' id='selectReactivosExamenes" + contadorSelectsParametros + "'><option><strong>Cargando...</strong></option></select></div>" +
    "<div class='col-md-2 col-sm-12 col-xs-12 form-group'><span class='input-group-btn'><button type='button' name='button' class='btn btn-primary' id='agregarParametroReactivo' onClick='agregarParametro(" + contadorSelectsParametros + ")'><i class='fa fa-save'></i></button></span></div>" +
    "<table class='table' id='tablaParametros" + contadorSelectsParametros + "'><thead><th>Parametros</th><th>Reactivos</th><th style='width : 80px'>Acción</th></thead>" +
    "<tbody></tbody></table>" +
    "</div></div></div></div>");
  llenarSecciones();
  llenarParametros();
  llenarReactivos();
  contadorSelectsParametros++;
  $("#totalSecciones").val(contadorSelectsParametros);
});
function cerrarSeccion(seccion) {
  var $BOX_PANEL = seccion.closest('.x_panel');
  $BOX_PANEL.remove();
  contadorSelectsParametros--;
  $("#totalSecciones").val(contadorSelectsParametros);
}
function llenarSecciones() {
  var secciones = $("#selectSeccion" + contadorSelectsParametros);
  var ruta = $('#guardarruta').val() + "/llenarSeccionExamenes";
  $.get(ruta, function (res) {
    secciones.empty();
    secciones.append("<option value='0' readonly='readonly'>[Seleccione sección]</option>");
    $(res).each(function (key, value) {
      secciones.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
function llenarParametros() {
  var parametros = $("#selectParametrosExamenes" + contadorSelectsParametros);
  var ruta = $('#guardarruta').val() + "/llenarParametrosExamenes";
  $.get(ruta, function (res) {
    parametros.empty();
    $(res).each(function (key, value) {
      parametros.append("<option value='" + value.id + "'>" + value.nombreParametro + "</option>");
    });
  });
}
function llenarReactivos() {
  var reactivos = $("#selectReactivosExamenes" + contadorSelectsParametros);
  var ruta = $('#guardarruta').val() + "/llenarReactivosExamenes";
  $.get(ruta, function (res) {
    reactivos.empty();
    $(res).each(function (key, value) {
      reactivos.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
function agregarParametro(paso) {
  //var parametro=$("#selectParametrosExamenes"+contadorSelectsParametros);
  var valorParametro = $("#selectParametrosExamenes" + paso).val();
  var textoParametro = $("#selectParametrosExamenes" + paso + " option:selected").text();
  var valorReactivo = $("#selectReactivosExamenes" + paso).val();
  var textoReactivo = $("#selectReactivosExamenes" + paso + " option:selected").text();
  var tablaActual = $("#tablaParametros" + paso);
  var tablaAVerificar = $("#tablaParametros" + paso + " tbody tr");
  var html_texto = "texto";
  if ($("#checkReactivo" + paso).is(':checked')) {
    html_texto = "<tr>" +
      "<td>" +
      "<input type='hidden' id='parametrosEnTabla" + paso + "[]' name='parametrosEnTabla" + paso + "[]' value = '" + valorParametro + "'/>" +
      textoParametro + "</td>" +
      "<td><input type='hidden' id='reactivosEnTabla" + paso + "[]' name='reactivosEnTabla" + paso + "[]' value = '" + valorReactivo + "'/>" +
      textoReactivo +
      "</td>" +
      "<td>" +
      "<button type = 'button' name='button' class='btn btn-danger btn-xs' onClick='eliminarParametroEnTabla(this);'>" +
      "<i class='fa fa-remove'></i>" +
      "</button>" +
      "</td>" +
      "</tr>";
  }
  else {
    html_texto = "<tr>" +
      "<td>" +
      "<input type='hidden' id='parametrosEnTabla" + paso + "[]' name='parametrosEnTabla" + paso + "[]' value = '" + valorParametro + "'/>" +
      textoParametro + "</td>" +
      "<td><input type='hidden' id='reactivosEnTabla" + paso + "[]' name='reactivosEnTabla" + paso + "[]' value = ''/>" +
      '-' +
      "</td>" +
      "<td>" +
      "<button type = 'button' name='button' class='btn btn-danger btn-xs' onClick='eliminarParametroEnTabla(this);'>" +
      "<i class='fa fa-remove'></i>" +
      "</button>" +
      "</td>" +
      "</tr>";
  }
  if (verificarParametroEnTabla(tablaAVerificar, textoParametro + textoReactivo) == true) {
    $(tablaActual).append(html_texto);
  } else {
    swal({
      type: 'error',
      title: '¡Ya esta agregado!',
      showConfirmButton: false,
      timer: 1500,
      animation: false,
      customClass: 'animated tada'
    }).catch(swal.noop);
  }
}
function verificarParametroEnTabla(tabla, nombreParametro) {
  var bandera = true;
  $(tabla).each(function (key, value) {
    if ($(this).text().trim() == nombreParametro) {
      bandera = false;
    }
  });
  return bandera;
}
function eliminarParametroEnTabla(tabla) {
  $(tabla).parent('td').parent('tr').remove();
}

////////////////////////////////////SCRIPTS DE EDITAR
var contadorEnEditar = $("#contadorEnEdit").val();
$('#agregarSeccionExamenEditar').click(function () {
  if (!contadorEnEditar) {
    contadorEnEditar = 0;
  }
  $('.seccionesExamenes').append("<div class='col-md-6 col-sm-6 col-xs-12'>" +
    "<div class='x_panel'>" +
    "<div class='x_title'>" +
    "<div class='col-md-9 col-sm-9 col-xs-12'>" +
    "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>" +
    "<select class='form-control has-feedback-left' name='selectSeccion" + contadorEnEditar + "' id='selectSeccion" + contadorEnEditar + "'><option><strong>Cargando...</strong></option></select></div>" +
    "<ul class='nav navbar-right panel_toolbox'>" +
    "<li><a class='close-link' onClick='cerrarSeccionEditar(this,contadorEnEditar);'><i class='fa fa-close'></i></a></li>" +
    "</ul><div class='clearfix'></div></div>" +
    "<div class='x_content'>" +
    "<div class='col-md-9 col-sm-9 col-xs-6'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>" +
    "<select class='form-control has-feedback-left' name='selectParametrosExamenes" + contadorEnEditar + "' id='selectParametrosExamenes" + contadorEnEditar + "' onChange='agregarParametro(this," + contadorEnEditar + ")';><option><strong>Cargando...</strong></option></select><hr>" +
    "<table class='table' id='tablaParametros" + contadorEnEditar + "'><thead><th>Parametros</th><th style='width : 80px'>Acción</th></thead>" +
    "<tbody></tbody></table>" +
    "</div></div></div></div>");
  llenarSeccionesEditar();
  llenarParametrosEditar();
  contadorEnEditar++;
  $("#contadorEnEdit").val(contadorEnEditar);
  $("#contadorTotal").val(contadorEnEditar);
});
function cerrarSeccionEditar(seccion, paso) {
  disminuiContadorSeccionesEnEditar(paso);
  var $BOX_PANEL = seccion.closest('.x_panel');
  $BOX_PANEL.remove();
}
function disminuiContadorSeccionesEnEditar(paso) {
  contadorEnEditar--;
  $("#contadorEnEdit").val(contadorEnEditar);
}
function llenarSeccionesEditar() {
  var secciones = $("#selectSeccion" + contadorEnEditar);
  var ruta = $('#guardarruta').val() + "/llenarSeccionExamenes";
  $.get(ruta, function (res) {
    secciones.empty();
    secciones.append("<option value='0' readonly='readonly'>[Seleccione sección]</option>");
    $(res).each(function (key, value) {
      secciones.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
    });
  });
}
function llenarParametrosEditar() {
  var parametros = $("#selectParametrosExamenes" + contadorEnEditar);
  var ruta = $('#guardarruta').val() + "/llenarParametrosExamenes";
  $.get(ruta, function (res) {
    parametros.empty();
    //parametros.append("<option value='-1' readonly='readonly'>[Seleccione parametros]</option>");
    $(res).each(function (key, value) {
      parametros.append("<option value='" + value.id + "'>" + value.nombreParametro + "</option>");
    });
  });
}
//////////////////PARA PARAMETROS
$('#checkValores').click(function () {
  if (this.checked == true) {
    $("#divValoresNormales").show();
    $("#valorMinimo").prop("readonly", false);
    $("#valorMaximo").prop("readonly", false);
    $("#valorMinimoFemenino").prop("readonly", false);
    $("#valorMaximoFemenino").prop("readonly", false);
    $("#selectUnidadParametro").removeAttr('disabled');
    $("#unidadModal").removeAttr('disabled');
  } else {
    $("#divValoresNormales").hide();
    $("#valorMaximo").prop("readonly", true);
    $("#valorMinimo").prop("readonly", true);
    $("#valorMaximoFemenino").prop("readonly", true);
    $("#valorMinimoFemenino").prop("readonly", true);
    $("#selectUnidadParametro").prop('disabled', 'disabled');
    $("#unidadModal").prop('disabled', 'disabled');
  }
});
//////////////////PARA EXAMENES
$('#checkObservacion').click(function () {
  if (this.checked == true) {
    document.getElementById('divObservacion').style.display = 'block';
  } else {
    document.getElementById('divObservacion').style.display = 'none';
  }
});
function chekearReactivo(checke, paso) {
  if (checke.checked == true) {
    document.getElementById('divReactivo' + paso).style.display = 'block';
  } else {
    document.getElementById('divReactivo' + paso).style.display = 'none';
  }
}
