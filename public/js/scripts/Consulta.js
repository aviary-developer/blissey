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

  $("#alergia_btn").on("click", function (e) {
    var paciente = $("#f__paciente").val();
    var alergia = $("#alergia_").val();
    var token = $("#tokenTransaccion").val();
    var html_ = '<input type="text" class="swal2-input" id="a_lergia" placeholder="Alergias del paciente" value="' + alergia + '" autofocus>';
  
    swal({
      title: 'Alergias',
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default'
    }).then(function () {
      $.ajax({
        url: "/blissey/public/editar_alergia",
        type: "POST",
        headers: { 'X-CSRF-TOKEN': token },
        data: {
          id: paciente,
          alergia: $("#a_lergia").val()
        },
        success: function (r) {
          if (r == 1) {
            swal("¡Hecho!", "Acción realizada exitosamente", 'success');
            location.reload();
          } else {
            swal("¡Algo salio mal!", 'No se guardo', 'error');
          }
        }
      });
    }).catch(swal.noop);
  });

  $("#btn_lista").on("click", function (e) { 
    $("#informacion__").hide();
    $("#consultas__").show();
  });

  $("#btn_info").on("click", function (e) {
    $("#informacion__").show();
    $("#consultas__").hide();
  });

});

$('#modal_consulta').on('shown.bs.modal', function () {
  $(document).off('focusin.modal');
});