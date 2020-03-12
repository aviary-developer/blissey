var x = 0;
var total_seccion = 0;
var parametros = 0;
var agregar = true;
var seccion_vista;
$('#agregar_parametro_x').on('click', function (e) {
  e.preventDefault();

  var v_parametro = $("#parametro_select").val();
  var n_parametro = $("#parametro_select option:selected").text();

  var check = $("#checkReactivo");

  if (check.is(':checked')) {
    var v_reactivo = $("#reactivo_select").val();
    var n_reactivo = $("#reactivo_select option:selected").text();
  } else {
    var v_reactivo = "";
    var n_reactivo = "--";
  }
  var tabla = $("#tabla_parametros");

  var fila = "<tr>" +
    "<td>" +
    n_parametro.trim() +
    "</td>" +
    "<td>" +
    n_reactivo.trim() +
    "</td>" +
    "<td>" +
    "<input type='hidden' name='n_parametro' value='" + n_parametro + "'>" +
    "<input type='hidden' name='v_parametro' value='" + v_parametro + "'>" +
    "<input type='hidden' name='n_reactivo' value='" + n_reactivo + "'>" +
    "<input type='hidden' name='v_reactivo' value='" + v_reactivo + "'>" +
    "<button id='eliminar_fila' class='btn btn-sm btn-danger'>" +
    "<i class='fa fa-times'></i>"
  "<button>" +
    "</td>" +
    "</tr>";

  var tabla_verificar = $("#tabla_parametros tbody tr");

  if (verificarParametroEnTabla(tabla_verificar, n_parametro.trim() + n_reactivo.trim())) {
    tabla.append(fila);
  } else {
    swal({
      type: 'error',
      title: '¡Repetido!',
      text: 'El parametro ya ha sido agregado',
      showConfirmButton: false,
      timer: 1500,
      animation: false,
      customClass: 'animated tada'
    }).catch(swal.noop);
  }
  parametros++;
  bloqueo_listo();
});

$("#listo_x").on("click", function (e) {
  e.preventDefault();

  var v_seccion = $("#seccion_select").val();
  var n_seccion = $("#seccion_select option:selected").text();

  if (parametros > 0) {
    if (agregar) {


      var panel = $("#panel_seccion");
      html = '<div class="btn-light col-sm-3 border border-primary rounded" style="height: 130px; margin: 0px" id="x_seccion_x' + x + '">' +
        '<input type="hidden" name="seccion_a_ver" value="seccion_x' + x + '">' +
        '<center>' +
        '<i class="fa fa-flask text-primary" style="font-size: 300%; margin: 15px 15px 10px 15px;"></i>' +
        '<br>' +
        '<div style="margin-bottom: 4px;">' +
        '<span class="badge font-sm badge-primary" >' + n_seccion + '</span>' +
        '</div>' +
        '<div id="seccion_x' + x + '">' +
        '<input type="hidden" id="y_seccion" name="y_seccion[]" value="' + v_seccion + '">' +
        '<button class="btn btn-sm btn-primary" id="ver_seccion" data-toggle="modal" data-target="#modal1">' +
        '<i class="fa fa-search"></i>' +
        '</button>' +
        '<button class="btn btn-sm btn-danger" id="eliminar_ficha">' +
        '<i class="fa fa-times"></i>' +
        '</button>' +
        '</div>' +
        '</center>' +
        '</div>';
      panel.append(html);

      var seccion = $("#seccion_x" + x);

      var input = $("#tabla_parametros").find("input");

      $(input).each(function (key, value) {
        if (value.name == "v_parametro") {
          var input_v_p = "<input type='hidden' name='f_parametro[]' value='" + value.value + "'>";
          var input_v_s = '<input type="hidden" name="f_seccion[]" value="' + v_seccion + '">';
        } else if (value.name == "n_parametro") {
          var input_n_p = "<input type='hidden' name='parametro[]' value='" + value.value + "'>";
        } else if (value.name == "v_reactivo") {
          var input_v_r = "<input type='hidden' name='f_reactivo[]' value='" + value.value + "'>";
        } else {
          var input_n_r = "<input type='hidden' name='reactivo[]' value='" + value.value + "'>";
        }

        seccion.append(input_v_s);//Id seccion
        seccion.append(input_v_p);//Id parametro
        seccion.append(input_n_p);//Nombre parametro
        seccion.append(input_v_r);//Id reactivo
        seccion.append(input_n_r);//Nombre reactivo
      });
      var input_n_s = '<input type="hidden" name="n_seccion[]" value="' + n_seccion + '">';
      seccion.append(input_n_s);

      $("#modal1").modal('hide');

      reset_modal();

      x++;
      total_seccion++;
      parametros = 0;
      bloqueo_listo();
    } else {
      $('#x_' + seccion_vista).empty();
      var ficha = $("#x_" + seccion_vista);
      var html = '<input type="hidden" name="seccion_a_ver" value="' + seccion_vista + '">' +
        '<center>' +
        '<i class="fa fa-flask text-primary" style="font-size: 300%; margin: 15px 15px 10px 15px;"></i>' +
        '<br>' +
        '<div style="margin-bottom: 4px;">' +
        '<span class="badge font-sm badge-primary" >' + n_seccion + '</span>' +
        '</div>' +
        '<div id="' + seccion_vista + '">' +
        '<input type="hidden" id="y_seccion" name="y_seccion[]" value="' + v_seccion + '">' +
        '<button class="btn btn-sm btn-primary" id="ver_seccion" data-toggle="modal" data-target="#modal1">' +
        '<i class="fa fa-search"></i>' +
        '</button>' +
        '<button class="btn btn-sm btn-danger" id="eliminar_ficha">' +
        '<i class="fa fa-times"></i>' +
        '</button>' +
        '</div>' +
        '</center>';
      ficha.append(html);

      var seccion = $('#' + seccion_vista);

      var input = $("#tabla_parametros").find("input");

      $(input).each(function (key, value) {
        if (value.name == "v_parametro") {
          var input_v_p = "<input type='hidden' name='f_parametro[]' value='" + value.value + "'>";
          var input_v_s = '<input type="hidden" name="f_seccion[]" value="' + v_seccion + '">';
        } else if (value.name == "n_parametro") {
          var input_n_p = "<input type='hidden' name='parametro[]' value='" + value.value + "'>";
        } else if (value.name == "v_reactivo") {
          var input_v_r = "<input type='hidden' name='f_reactivo[]' value='" + value.value + "'>";
        } else {
          var input_n_r = "<input type='hidden' name='reactivo[]' value='" + value.value + "'>";
        }

        seccion.append(input_v_s);//Id seccion
        seccion.append(input_v_p);//Id parametro
        seccion.append(input_n_p);//Nombre parametro
        seccion.append(input_v_r);//Id reactivo
        seccion.append(input_n_r);//Nombre reactivo
      });
      var input_n_s = '<input type="hidden" name="n_seccion[]" value="' + n_seccion + '">';
      seccion.append(input_n_s);

      $("#modal1").modal('hide');

      reset_modal();

      parametros = 0;
      bloqueo_listo();
    }
  }
});

$('#agregar_seccion_x').on('click', function (e) {
  e.preventDefault();
  agregar = true;
  reset_modal();
});

$("#panel_seccion").on('click', '#eliminar_ficha', function (e) {
  e.preventDefault();
  seccion_vista = $(this).parent('div').parent('center').parent('div').find('input[name="seccion_a_ver"]').val();
  $('#x_' + seccion_vista).remove();
  reset_modal();
  total_seccion--;
});

$('#panel_seccion').on('click', '#ver_seccion', function (e) {
  e.preventDefault();

  reset_modal();
  agregar = false;

  seccion_vista = $(this).parent('div').parent('center').parent('div').find('input[name="seccion_a_ver"]').val();

  var seccion_id = $(this).parent('div').find('#y_seccion').val();

  $("#seccion_select").val(seccion_id);

  var input_n_p = $(this).parent('div').find('input[name="parametro[]"]');
  var input_v_p = $(this).parent('div').find('input[name="f_parametro[]"]');
  var input_n_r = $(this).parent('div').find('input[name="reactivo[]"]');
  var input_v_r = $(this).parent('div').find('input[name="f_reactivo[]"]');


  $(input_n_p).each(function (key, value) {
    var v_parametro = input_v_p[key].value;
    var n_parametro = value.value;
    var v_reactivo = input_v_r[key].value;
    var n_reactivo = input_n_r[key].value;

    var tabla = $("#tabla_parametros");

    var fila = "<tr>" +
      "<td>" +
      n_parametro +
      "<input type='hidden' name='n_parametro' value='" + n_parametro + "'>" +
      "<input type='hidden' name='v_parametro' value='" + v_parametro + "'>" +
      "</td>" +
      "<td>" +
      n_reactivo +
      "<input type='hidden' name='n_reactivo' value='" + n_reactivo + "'>" +
      "<input type='hidden' name='v_reactivo' value='" + v_reactivo + "'>" +
      "</td>" +
      "<td>" +
      "<button id='eliminar_fila' class='btn btn-sm btn-danger'>" +
      "<i class='fa fa-times'></i>"
    "<button>" +
      "</td>" +
      "</tr>";

    tabla.append(fila);
    parametros++;
    bloqueo_listo();
  });
});

$("#tabla_parametros").on('click', '#eliminar_fila', function (e) {
  e.preventDefault();
  $(this).parent('td').parent('tr').remove();
  parametros--;
  bloqueo_listo();
});

function bloqueo_listo() {
  if (parametros == 0) {
    $("#listo_x").addClass('disabled');
  } else {
    $("#listo_x").removeClass('disabled');
  }
}

$("#guardar_examen").on("click", function (e) {
  e.preventDefault();
  var imagens;
  if (imagen = $("#checkImagenExamen:checked").val() != null) {
    imagen = imagen;
  } else {
    imagen = imagen;
  }
  var nombre = $("#nombre_examen").val();
  var precio = $("#precio_campo").val();
  var bandera = true;
  if ((total_seccion < 1) && (imagen == false)) {
    swal({
      type: 'error',
      title: '¡Error!',
      text: 'Se necesita al menos una sección o una imagen',
      toast: true,
      timer: 5000,
      showConfirmButton: false,
    });
    bandera = false;
  }
  var valido = new Validated('nombre_examen');
  valido.required();
  valido.min(4);
  valido.max(50);
  bandera = valido.value(bandera);

  var valido = new Validated('precio_campo');
  valido.required();
  bandera = valido.value(bandera);

  if (bandera) {
    if (imagen) {
      imagen = "Si";
    } else {
      imagen = "No";
    }
    var seccion_agregadas = $("#panel_seccion").find('input[name="seccion_a_ver"]');
    var titulo = $('#nombre_examen').val();
    var tipo_muestra = $("#tipo_muestra_select option:selected").text();
    var area = $("#area_select option:selected").text();

    var html_ = "<h3 class='blue'>" + titulo + "</h3>" +
      "<div class='ln_solid'></div>" +
      "<span class='left'>Tipo de muestra: " +
      "<b class='blue'>" + tipo_muestra + "</b></span>" +
      "<br><span class='left'>Área del examen: " +
      "<b class='blue'>" + area + "</b></span>" +
      "<br><span class='left'>Se agregará imagen: " +
      "<b class='blue'>" + imagen + "</b></span>" +
      "<br><div class='ln_solid'></div>";
    var html_2 = "";
    $(seccion_agregadas).each(function (key, value) {
      var n_seccion = $("#" + value.value).find("input[name='n_seccion[]']").val();
      html_2 += "<h3 class='left'><i class='fa fa-flask'></i> " + n_seccion + "</h3><div class='clearfix'></div>";

      var n_parametro = $("#" + value.value).find("input[name='parametro[]']");
      var n_reactivo = $("#" + value.value).find("input[name='reactivo[]']");

      $(n_parametro).each(function (key, value) {
        html_2 += "<span class='left' style='width: 50%; text-align: left;'><i class='fa fa-sliders blue'></i> " + value.value.trim() + "</span>" +
          "<span class='left' style='width: 50%; text-align: left;'><i class='fa fa-tint green'></i> " + n_reactivo[key].value.trim() + "</span>" +
          "<br>";
      });

      html_2 += "<div class='clearfix'></div><div class='ln_solid'></div>";
    });

    var html_3 = "<h4 class='red'>¡Importante!<h4>" +
      '<span>¿Está seguro que desea guardar?<br><small> Si guarda los cambios, estos no podrán ser modificados después</small></span>';

    swal({
      title: 'Resumen',
      html: html_ + html_2 + html_3,
      showCancelButton: true,
      confirmButtonText: 'Si, ¡Guardar!',
      cancelButtonText: 'No, ¡Seguir trabajando!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light'
    }).then((result) => {
      if (result.value) {
        $("#examen_form").submit();
      }
    });
  }
});

function reset_modal() {
  parametros = 0;
  bloqueo_listo();

  var tabla = $("#tabla_parametros");
  tabla.empty();

  var head = '<thead>' +
    '<th>Parámetro</th>' +
    '<th>Reactivo</th>' +
    '<th style="width: 80px">Acción</th>' +
    '</thead>' +
    '<tbody>' +
    '</tbody>';

  tabla.append(head);
}
