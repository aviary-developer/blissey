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
    lista();
  });

  $("#btn_listar").on("click", function (e) {
    lista();
  });

  $("#btn_info").on("click", function (e) {
    $("#informacion__").show();
    $("#consultas__").hide();
    $("#ver_consulta__").hide();
    $("#signos__").hide();
    $("#ver_signo__").hide();
  });

  $("#btn_signos").on("click", function(e){
    lista_signos();
  });

  $("#btn_sign").on("click", function (e) {
    lista_signos();
  });

  function lista_signos() {
    $("#informacion__").hide();
    $("#consultas__").hide();
    $("#ver_consulta__").hide();
    $("#signos__").show();
    $("#ver_signo__").hide();
  }

  function lista() {
    $("#informacion__").hide();
    $("#consultas__").show();
    $("#ver_consulta__").hide();
    $("#signos__").hide();
    $("#ver_signo__").hide();
  }

});

$('#modal_consulta').on('shown.bs.modal', function () {
  $(document).off('focusin.modal');
});

function consulta_load(id) {
  $("#informacion__").hide();
  $("#consultas__").hide();
  $("#ver_consulta__").show();
  $("#signos__").hide();
  $("#ver_signo__").hide();

  $.ajax({
    type: 'get',
    url: '/blissey/public/consultar',
    data: {
      id: id
    },
    success: function (r) {
      var padre = $("#consulta_body");
      padre.empty();
      var html_ = '<div class="row bg-blue" style="margin: 5px;"><center><h4><i class="fa fa-calendar"></i> '+ r.fecha+'</h4></center></div>';
      padre.append(html_);
      html_ = '<div class="row blue"><center><span>' + r.medico + '</span></center></div>';
      padre.append(html_);
      html_ = '<div id="bdy" style="overflow-y: scroll; overflow-x:hidden; height: 230px; width:97%"></div>';
      padre.append(html_);
      var panel = $("#bdy");
      html_ = '<br><div class="row bg-gray" style="margin: 5px"><center><span class="black"><b>Consulta por</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.motivo + '</p></div>';
      panel.append(html_);
      html_ = '<div class="row bg-gray black" style="margin: 5px"><center><span class="black"><b>Historia clínica</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.historia + '</p></div>';
      panel.append(html_);
      html_ = '<div class="row bg-gray black" style="margin: 5px"><center><span class="black"><b>Examen físico</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.examen_fisico + '</p></div>';
      panel.append(html_);
      html_ = '<div class="row bg-gray black" style="margin: 5px"><center><span class="black"><b>Diagnostico</b></span></center></div>';
      panel.append(html_);
      html_ = '<div class="row" style="padding: 5px; margin: 2px 5px;"><p>' + r.consulta.diagnostico + '</p></div>';
      panel.append(html_);
    }
  });
}

function signos_load(id) {
  $("#informacion__").hide();
  $("#consultas__").hide();
  $("#ver_consulta__").hide();
  $("#signos__").hide();
  $("#ver_signo__").show();

  $.ajax({
    type: 'get',
    url: '/blissey/public/ver_signos',
    data: {
      id: id
    },
    success: function (r) {
      var padre = $("#signo_body");
      padre.empty();
      var html_ = '<div class="row bg-blue" style="margin: 5px;"><center><h4><i class="fa fa-calendar"></i> ' + r.fecha + '</h4></center></div>';
      padre.append(html_);
      html_ = '<div id="sbdy" style="overflow-y: scroll; overflow-x:hidden; height: 230px; width:97%"></div>';
      padre.append(html_);
      var panel = $("#sbdy");
      //Temperatura
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Temperatura: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.temperatura == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.temperatura > 37) {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.temperatura + ' °C</span>';
      } else {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.temperatura + ' °C</span>';
      }
      html_ += '</div>'  +
        '</div>';
      panel.append(html_);
      //Peso
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Peso: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.peso == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.peso + ' ' + ((r.signos.medida)?'Kg':'lb') +'</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Presion arterial
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Presión Arterial: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.sistole == null || r.signos.diastole == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if ((r.sexo &&
        (((r.edad >= 16 && r.edad <= 18) && (r.signos.sistole >= 105 && r.signos.sistole <= 135) && (r.signos.diastole >= 60 && r.signos.diastole <= 86)) ||
        ((r.edad >= 19 && r.edad <= 24) && (r.signos.sistole >= 105 && r.signos.sistole <= 139) && (r.signos.diastole >= 62 && r.signos.diastole <= 88)) ||
        ((r.edad >= 25 && r.edad <= 29) && (r.signos.sistole >= 108 && r.signos.sistole <= 139) && (r.signos.diastole >= 65 && r.signos.diastole <= 89)) ||
        ((r.edad >= 30 && r.edad <= 39) && (r.signos.sistole >= 110 && r.signos.sistole <= 145) && (r.signos.diastole >= 68 && r.signos.diastole <= 92)) ||
        ((r.edad >= 40 && r.edad <= 49) && (r.signos.sistole >= 110 && r.signos.sistole <= 150) && (r.signos.diastole >= 70 && r.signos.diastole <= 96)) ||
        ((r.edad >= 50 && r.edad <= 59) && (r.signos.sistole >= 115 && r.signos.sistole <= 155) && (r.signos.diastole >= 70 && r.signos.diastole <= 98)) ||
        ((r.edad >= 60) && (r.signos.sistole >= 115 && r.signos.sistole <= 160) && (r.signos.diastole >= 70 && r.signos.diastole <= 100)))) || 
        (!r.sexo &&
        (((r.edad >= 16 && r.edad <= 18) && (r.signos.sistole >= 100 && r.signos.sistole <= 130) && (r.signos.diastole >= 60 && r.signos.diastole <= 85)) ||
        ((r.edad >= 19 && r.edad <= 24) && (r.signos.sistole >= 100 && r.signos.sistole <= 130) && (r.signos.diastole >= 60 && r.signos.diastole <= 85)) ||
        ((r.edad >= 25 && r.edad <= 29) && (r.signos.sistole >= 102 && r.signos.sistole <= 135) && (r.signos.diastole >= 60 && r.signos.diastole <= 86)) ||
        ((r.edad >= 30 && r.edad <= 39) && (r.signos.sistole >= 105 && r.signos.sistole <= 139) && (r.signos.diastole >= 65 && r.signos.diastole <= 89)) ||
        ((r.edad >= 40 && r.edad <= 49) && (r.signos.sistole >= 105 && r.signos.sistole <= 150) && (r.signos.diastole >= 65 && r.signos.diastole <= 96)) ||
        ((r.edad >= 50 && r.edad <= 59) && (r.signos.sistole >= 110 && r.signos.sistole <= 155) && (r.signos.diastole >= 70 && r.signos.diastole <= 98)) ||
        ((r.edad >= 60) && (r.signos.sistole >= 115 && r.signos.sistole <= 160) && (r.signos.diastole >= 70 && r.signos.diastole <= 100))))
      ) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      } else if (r.edad < 16) {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.sistole + ' / ' + r.signos.diastole + ' °Hg</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Pulso
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Pulso: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.pulso == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.pulso > 59 && r.signos.pulso < 121) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.pulso + '  lpm</span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.pulso + '  lpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Glucosa
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Glucosa: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.glucosa == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.glucosa >= 70  && r.signos.glucosa <= 110) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.glucosa + '  mg / dl </span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.glucosa + '  mg / dl</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Altura
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Altura: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.altura == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else {
        html_ += '<span class="label label-lg label-white col-xs-12">' + r.signos.altura + '  cm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia cardiaca
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Frecuencia Cardiaca: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.frecuencia_cardiaca == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.frecuencia_cardiaca >= 60 && r.signos.frecuencia_cardiaca <= 101) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.frecuencia_cardiaca + '  lpm </span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.frecuencia_cardiaca + ' lpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Frecuencia Respiratoria
      html_ = '<div class="row" style="margin: 5px;">' +
        '<div class="col-xs-8">Frecuencia Respiratoria: </div>' +
        '<div class="col-xs-4">';
      if (r.signos.frecuencia_respiratoria == null) {
        html_ += '<span class="label label-lg label-gray col-xs-12">Vacio</span>';
      } else if (r.signos.frecuencia_respiratoria >= 12 && r.signos.frecuencia_respiratoria <= 20) {
        html_ += '<span class="label label-lg label-success col-xs-12">' + r.signos.frecuencia_respiratoria + '  rpm </span>';
      } else {
        html_ += '<span class="label label-lg label-danger col-xs-12">' + r.signos.frecuencia_respiratoria + ' rpm</span>';
      }
      html_ += '</div>' +
        '</div>';
      panel.append(html_);
      //Indice de masa corporal
      if (r.signos.altura != null && r.signos.peso != null) {
        var peso = parseFloat(r.signos.peso);
        peso *= (r.signos.medida) ? 1 : 0.453592;
      }
    }
  });
}