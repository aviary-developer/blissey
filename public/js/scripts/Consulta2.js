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
        $("#id_con").val(r.consulta.id);
      }
    });

    $("#historial").hide();
    $("#ver_consulta").show();
  } else {
    
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

    $("#back_historial").hide();
  } else {
    $("#historial").hide();
    $("#ver_consulta").hide();

    $("#nivel").val(0);
  }
});