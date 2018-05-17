$(document).on("ready", function () {
  $("#guardar_consulta").on("click", function (e) { 
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/blissey/public/consulta",
      headers: { 'X-CSRF-TOKEN': $("#tokenTransaccion").val() },
      data: {
        motivo: $("#motivo").val(),
        historia: $("#historia").val(),
        examen_fisico: $("#ex_fisico").val(),
        diagnostico: $("#diagnostico").val(),
        f_ingreso: $("#id").val()
      },
      success: function (r) {
        if (r) {
          swal("¡Hecho!", "Accion realizada satisfactoriamente", "success");
          location.reload();
        } else {
          swal("¡Error!", "Algo salio mal", "error");
        }
      }
    });
  });

  function cargar(consulta) {
    var contenido = $("#contenido_consulta");
    var html = '<div class="row bg-blue"><center><h5>' +
      '<i class="fa fa-calendar"></i> '+
      consulta.fecha +  
      '</h5></center></div>';
    contenido.append(html);
    html = '<div class="row" style="margin-top: 5px;"><b>Consultó por:</b></div>';
    contenido.append(html);
    html = '<div class="row"> ' +
      consulta.motivo +  
      '</div>';
    contenido.append(html);
    html = '<div class="row" style="margin-top: 5px;"><b>Historia clínica:</b></div>';
    contenido.append(html);
    html = '<div class="row"> ' +
      consulta.historia +
      '</div>';
    contenido.append(html);
    html = '<div class="row" style="margin-top: 5px;"><b>Examen físico:</b></div>';
    contenido.append(html);
    html = '<div class="row"> ' +
      consulta.ex_fisico +
      '</div>';
    contenido.append(html);
    html = '<div class="row" style="margin-top: 5px;"><b>Diagnostico:</b></div>';
    contenido.append(html);
    html = '<div class="row"> ' +
      consulta.diagnostico +
      '</div>';
    contenido.append(html);
  }
});