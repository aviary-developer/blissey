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
      url: '/blissey/public/consultar',
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
      url: '/blissey/public/consultar_ingresos',
      data: {
        id: id
      },
      success: function (r) {
        $("#ver_ingresos").empty();

        $(r.consultas).each(function (key, value) {
          var html = '<div class="row borde" style="margin: 5px; border-radius: 4px;">' +
            '<div class="row blue">' +
            '<center>' +
            '<h4>' +
            '<i class="fa fa-calendar"></i> ' +
            r.fechas[key] +
            '</h4>' +
            '</center>' +
            '</div>' +
            '<div class="row" style="margin-bottom: 8px;">' +
            '<div class="col-xs-10">' +
            '<div class="row">' +
            '<center>' +
            '<span class="big-text">' +
            '<i class="fa fa-stethoscope"></i> ' +
            r.medicos[key] +
            '</span>' +
            '</center>' +
            '</div>' +
            '<div class="row" style="margin-bottom: 5px;">' +
            '<center>' +
            '<i>' +
            '<span>' +
            '"' + value.diagnostico + '"' +
            '</span>' +
            '</i>' +
            '</center>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-xs-3"></div>' +
            '<span class="col-xs-6 label label-lg label-pink">Consulta Médica</span>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-2">' +
            '<button type="button" class="btn btn-xs btn-dark" style="margin: auto" onclick="v_consulta(' + value.id + ',3,1)">' +
            '<i class="fa fa-eye"></i> Ver' +
            '</button>' +
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