$("#cambio_div_consulta").on('click', function (e) {
  e.preventDefault();
  $("#div_previo").hide();
  $("#div_consulta").show();
});

$("#cancelar_consulta").on('click', function (e) {
  e.preventDefault();
  $("#div_previo").show();
  $("#div_consulta").hide();
});

async function v_consulta(id, tipo, nivel = 0) {
  if (tipo == 3) {

    await $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/consultar',
      data: {
        id: id
      },
      success: function (r) {
        $("#fechado").text(r.fecha);
        $("#s_motivo").text(r.consulta.motivo);
        $("#s_historia").text(r.consulta.historia);
        $("#s_fisico").text(r.consulta.examen_fisico);
        $("#s_diagnostico").text(r.consulta.diagnostico);
        $("#s_medico").text(r.medico);
        $("#id_sel").val(r.consulta.f_ingreso);
      }
    });

    $("#historial").hide();
    $("#ver_consulta").show();
    $("#action_bar").show();
    $("#ver_ingresos").hide();
  } else {

    await $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/consultar_ingresos',
      data: {
        id: id
      },
      success: function (r) {
        $("#ver_ingresos").empty();

        $(r.consultas).each(function (key, value) {
          var ubicacion = window.location.hostname;
          var ruta = "/";
          if (ubicacion == "localhost") {
            ruta = "/blissey/public/";
          }
          var html = '<div class="col-sm-12 m-1 border border-secondary rounded">' +
            '<div class="flex-row">' +
            '<center>' +
            '<h6 class="text-primary mt-1">' +
            '<i class="far fa-calendar"></i> ' +
            r.fechas[key] +
            '</h6>' +
            '</center>' +
            '</div>' +
            '<div class="flex-row mb-1">' +
            '<div class="col-sm-10">' +
            '<div class="flex-row">' +
            '<center>' +
            '<span class="font-weight-bold">' +
            '<i class="fa fa-stethoscope"></i> ' +
            r.medicos[key] +
            '</span>' +
            '</center>' +
            '</div>' +
            '<div class="flex-row mb-1">' +
            '<center>' +
            '<i>' +
            '<span>' +
            '"' + value.diagnostico + '"' +
            '</span>' +
            '</i>' +
            '</center>' +
            '</div>' +
            '<div class="flex-row">' +
            '<center><span class="col-6 badge font-sm mb-2 badge-pink">Consulta Médica</span></center>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<div class="btn-group">' +
            '<button type="button" class="mb-2 btn btn-sm btn-dark" style="margin: auto" onclick="v_consulta(' + value.id + ',3,1)">' +
            '<i class="fa fa-eye"></i>' +
            '</button>' +
            '<a href="' + ruta + '/blissey/public/recetas/' + value.id + '" target="_blank" class="btn btn-sm btn-primary mb-2">' +
            '<i class="fas fa-prescription"></i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

          $("#ver_ingresos").append(html);
        });
      }
    });

    $("#historial").hide();
    $("#ver_consulta").hide();
    $("#ver_ingresos").show();
    $("#action_bar").show();
  }
  $("#nivel").val(nivel);
  $("#back_historial").show();
}

$("#back_historial").on('click', function (e) {
  e.preventDefault();
  nivel = $("#nivel").val();

  if (nivel == 0) {
    $("#historial").show();
    $("#ver_consulta").hide();
    $("#action_bar").hide();
    $("#ver_ingresos").hide();

    $("#back_historial").hide();
  } else {
    $("#historial").hide();
    $("#ver_consulta").hide();
    $("#action_bar").show();
    $("#ver_ingresos").show();

    $("#nivel").val(0);
  }
});