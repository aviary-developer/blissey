var c_lab = 0;
var c_ryx = 0;
var c_ult = 0;
var c_tac = 0;

$(document).on("ready", function () {

  $("#accordion").on("click", "#activar", function (e) {
    e.preventDefault();
    var id = $(this).parents('tr').find("input:eq(0)").val();
    var examen = $(this).parents('tr').find("input:eq(1)").val();
    var celda = $(this).parents('tr').find("td:eq(3)");
    var tooltip = $(".tooltip-inner").parent('div');
    var html =
      '<center><a id="evaluar" href="evaluarExamen/'+id+'/'+ examen +'" class="btn btn-dark btn-sm" title="Evaluar" >' +
        '<i class="fa fa-paste"></i>' +
      '</a ></center>';
    $.ajax({
      type: "GET",
      url: "/blissey/public/aceptarSolicitudExamen/" + id,
      dataType: 'json',
      success: function (respuesta) {
        if (respuesta == 1) {
          celda.empty();
          celda.append(html);
          $("#evaluar").tooltip();
          tooltip.remove();
        }
      }
    });
  });

  $("#accordion").on("click", "#eliminar", function (e) {
    var id = $(this).parents('tr').find("input:eq(0)").val();
    var fila = $(this).parents('tr');
    var tooltip = $(".tooltip-inner").parent('div');
    var panel = $(this).parents('td').parents('tr').parents('table').parent('div').parent('div').parent('div');
    console.log(panel);
    return swal({
      title: 'Eliminar registro',
      text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Eliminar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-danger',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "GET",
          url: "/blissey/public/destroySolicitudExamen/" + id,
          dataType: 'json',
          success: function (respuesta) {
            fila.remove();
            tooltip.remove();
            if (respuesta == 0) {
              panel.remove();
            }
            localStorage.setItem('msg', 'yes');
            location.reload();
          }
        });
      }
    });
  });

  //Receta
  $("#buscar_receta_s").click(async function (e) { 
    e.preventDefault();
    var codigo = $("#codi-receta").val();

    if (codigo.length > 0) {
      await $.ajax({
        type: 'get',
        url: '/blissey/public/receta/buscar_solicitud',
        data: {
          codigo: codigo
        },
        success: function (r) {
          var panel = $("#cont_solicitud_m");
  
          
          if (r.cero == false) {
            $("#res_solicitud_m").show();
            $("#res_negativa_m").hide();
  
            $("#n_pac").text(r.paciente);
            $("#id_p_").val(r.id_p);
            $("#f_rec").text(r.fecha);
    
            c_lab = r.total_lab;
            c_ult = r.total_ultra;
            c_ryx = r.total_rayo;
            c_tac = r.total_tac;
  
            panel.empty();  
            if (r.total_lab > 0) {
              build_display(r.lab_v, panel, 0);
            }
            if (r.total_rayo > 0) {
              build_display(r.rayo_v, panel, 1);
            }
            if (r.total_ultra > 0) {
              build_display(r.ultra_v, panel, 2);
            }
            if (r.total_tac > 0) {
              build_display(r.tac_v, panel, 3);
            }
          } else {
            $("#res_negativa_m").show();
            $("#res_solicitud_m").hide();
          }
        }
      });
    }

    $("#codi-receta").val('');
  });
  
  $("#close-search-receta").click(function (e) {
    $("#codi-receta").val('');
    $("#res_negativa_m").hide();
    $("#res_solicitud_m").hide();
  });

  //Funciones de dibujo
  function build_display(vector, panel, tipo) {
    if (tipo == 0) {
      var name = 'lab';
      var html = '<div class="col-xs-6"><div class="x_panel" id="p_' + name + '" >' +
        '<div class="row"><center>' +
        '<h4 class="gray"> Laboratorio Clínico </h4>' +
        '</center></div>' +
        '</div></div>';
    } else if (tipo == 1) {
      var name = "ryx";
      var html = '<div class="col-xs-6"><div class="x_panel" id="p_' + name + '" >' +
        '<div class="row"><center>' +
        '<h4 class="gray"> Rayos X </h4>'+
        '</center></div>' +
        '</div></div>';
    } else if (tipo == 2) {
      var name = "ult";
      var html = '<div class="col-xs-6"><div class="x_panel" id="p_' + name + '" >' +
        '<div class="row"><center>' +
        '<h4 class="gray"> Ultrasonografía </h4>' +
        '</center></div>' +
        '</div></div>';
    } else {
      var name = "tac";
      var html = '<div class="col-xs-6"><div class="x_panel" id="p_' + name + '" >' +
        '<div class="row"><center>' +
        '<h4 class="gray"> TAC </h4>' +
        '</center></div>' +
        '</div></div>';
    }
    
    panel.append(html);

    var subpanel = $("#p_"+name);
    $(vector).each(function (key, value) {
      html = '<div class="row">' +
        '<div class="col-xs-10">' +
        '<b class="blue">' + value.nombre + '</b>' +
        '<input type="hidden" name="' + name + '[]" value="' + value.id + '">'+
        '</div>' +
        '<div class="col-xs-2">' +
        '<button type="button" class="btn btn-xs btn-danger" onclick="remove_vector(this,' + tipo + ')">' +
        '<i class="fa fa-remove"></i>'+
        '</button>'
        '</div>'+
        '</div>';
      
      subpanel.append(html);
    });

    html = '<div class="row">' +
      '<center>'+
      '<button type="button" class="btn btn-xs btn-success" onclick="solicitar(this,' + tipo + ')">' +
      '¡Listo!'+
      '</button>'+
      '</center>'+
    '</div >';
    
    subpanel.append(html);
  }
});

function remove_vector(obj, tipo) {
  if (tipo == 0) {
    c_lab--;

    if (c_lab <= 0) {
      $(obj).parent('div').parent('div').parent('div').parent('div').remove();
    } else {
      $(obj).parent('div').parent('div').parent('div').remove();
    }
  } else if (tipo == 1) {
    c_ryx--;
    console.log(c_ryx);
    if (c_ryx <= 0) {
      $(obj).parent('div').parent('div').parent('div').parent('div').remove();
    } else {
      $(obj).parent('div').parent('div').parent('div').remove();
    }
  } else if (tipo == 2) {
    c_ult--;

    if (c_ult <= 0) {
      $(obj).parent('div').parent('div').parent('div').parent('div').remove();
    } else {
      $(obj).parent('div').parent('div').parent('div').remove();
    }
  } else {
    c_tac--;

    if (c_tac <= 0) {
      $(obj).parent('div').parent('div').parent('div').parent('div').remove();
    } else {
      $(obj).parent('div').parent('div').parent('div').remove();
    }
  }
}

async function solicitar(obj, tipo) {
  var paciente = $("#id_p_").val();
  if (tipo == 0) {
    var examen_prov = $("input[name = 'lab[]']").serializeArray();
    var examen = [];
    $(examen_prov).each(function (key, value) {
      examen.push(value.value);
    });

    await $.ajax({
      url: "/blissey/public/solicitudex",
      type: "POST",
      data: {
        f_paciente: paciente,
        examen: examen,
        tipo: "examenes"
      },
      success: function (respuesta) {
        if (respuesta) {
          new PNotify({
            title: '¡Hecho!',
            text: "Solicitud realizada exitosamente",
            type: 'info',
            styling: 'bootstrap3'
          });
        }
      }
    });

    
  } else if (tipo == 1) {
    var rayo_prov = $("input[name = 'ryx[]']").serializeArray();
    var rayo = [];
    $(rayo_prov).each(function (key, value) {
      rayo.push(value.value);
    });

    $(rayo).each(async function (key, value) {
      await $.ajax({
        url: "/blissey/public/solicitudex",
        type: "POST",
        data: {
          f_paciente: paciente,
          rayox: value,
          tipo: "rayosx"
        },
        success: function (respuesta) {
          if (respuesta) {
            new PNotify({
              title: '¡Hecho!',
              text: "Solicitud realizada exitosamente",
              type: 'info',
              styling: 'bootstrap3'
            });
          }
        }
      });
    });
    
  } else if (tipo == 2) {
    var ultra_prov = $("input[name = 'ult[]']").serializeArray();
    var ultra = [];
    $(ultra_prov).each(function (key, value) {
      ultra.push(value.value);
    });
    
    $(ultra).each(async function (key, value) {
      await $.ajax({
        url: "/blissey/public/solicitudex",
        type: "POST",
        data: {
          f_paciente: paciente,
          ultrasonografia: value,
          tipo: "ultras"
        },
        success: function (respuesta) {
          if (respuesta) {
            new PNotify({
              title: '¡Hecho!',
              text: "Solicitud realizada exitosamente",
              type: 'info',
              styling: 'bootstrap3'
            });
          }
        }
      });
    });
  } else {   
    var tac_prov = $("input[name = 'tac[]']").serializeArray();
    var tac = [];
    $(tac_prov).each(function (key, value) {
      tac.push(value.value);
    });

    $(tac).each(async function (key, value) {
      await $.ajax({
        url: "/blissey/public/solicitudex",
        type: "POST",
        data: {
          f_paciente: paciente,
          tac: value,
          tipo: "tac"
        },
        success: function (respuesta) {
          if (respuesta) {
            new PNotify({
              title: '¡Hecho!',
              text: "Solicitud realizada exitosamente",
              type: 'info',
              styling: 'bootstrap3'
            });
          }
        }
      });
    });
  }
  $(obj).parent('center').parent('div').parent('div').parent('div').remove();
}