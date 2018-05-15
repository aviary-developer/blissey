$(document).on("ready", function () {
  //Funcion para cargar el historial del paciente
  $("#consulta_btn_modal").on("click", function (e) { 
    e.preventDefault();
    //Consultar si tiene al menos una consulta el paciente
    var paciente = $("#f_paciente").val();
    Ajax = $.ajax({
      type: 'GET',
      url: '/blissey/public/historial_medico',
      data: {
        id: paciente,
      },
      success: function (r) {
        var panel = $("#panel_dinamico");
        panel.empty();
        //Panel de datos del paciente
        var html = '<div id="datos__paciente" class="x_panel"></div> ';
        panel.append(html);

        //Cargar los datos del paciente
        var panel_paciente = $("#datos__paciente");

        html = '<div class="row"><center><h4>' + r.paciente.nombre + ' ' + r.paciente.apellido + '</h4></center></div>';
        panel_paciente.append(html);

        html = '<div class="row"><center>' +
          ((r.paciente.sexo) ? 'Masculino ' : 'Femenino ') +
          '&#8226; ' +
          r.edad + ' años' +
            '</center></div';
        panel_paciente.append(html);

        html = '<div class="row ' + ((r.paciente.alergia == null) ? 'bg-gray' : 'bg-orange') + '" style="padding: 5px 5px 0px 5px; margin-top: 5px;">' +
        '<button type="button" class ="btn btn-xs btn-dark"><i class="fa fa-edit"></i></button>'  +
          '<b>Alergias: </b>' +
        ((r.paciente.alergia == null)?'<i>Ninguna</i>':r.paciente.alergia)  +
          '</div>';
        panel_paciente.append(html);

        html = '<div class="x_panel" id="datos__consulta" style="height: 267px;"></div>';
        panel.append(html);
        
        var panel_consulta = $("#datos__consulta");
        
        if (r.count_consulta > 0) {
          html = '<div class="row"><div class="col-xs-1"><button type="button" class="btn btn-xs btn-default" id="menu_consulta"><i class="fa fa-navicon"></i></button></div><div class="col-xs-11"><center><b>Historial del paciente</b></center></div></div>';
          panel_consulta.append(html);

          html = '<div id="contenido_consulta" style="overflow-y: scroll; overflow-x: hidden; padding: 0px 0px 0px 15px; height: 88%;"></div>';
          panel_consulta.append(html);

          cargar(r.consultar[0]);
        } else {
          html = '<div id="contenido_consulta"></div>';
          panel_consulta.append(html);

          var contenido = $("#contenido_consulta");

          html = '<center style="margin-top: 120px;"><span>Esta es la primer consulta del paciente.</span></center>';

          contenido.append(html);
        }
      },
    });

  });

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