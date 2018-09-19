$(document).on('ready',function(){
  var minimo = $("#min").val();
  var maximo = $("#max").val();
  var desde = $("#from").val();
  var hasta = $("#to").val();
  var ubicacion = window.location.pathname;

  if (ubicacion.indexOf("/blissey/public/pacientes/") > -1) {
    if ($("#ubi").val() != "show") {
      cargar_municipio();
      cambio_residencia();
    } else {
      var ingreso_tabla = $("#ingreso-table").DataTable();
      var consulta_tabla = $("#consulta-table").DataTable();
    }
  }

  function cargar_municipio() {
    var v_departamento = $("#departamento_select").val();
    var municipio_select = $("#municipio_select");
    var editado = $("#municipio_edit").val();

    $.ajax({
      type: "GET",
      url: "/blissey/public/municipios/"+v_departamento,
      success: function (respuesta) {
        municipio_select.empty();
        $(respuesta).each(function (key, value) {
          if (editado == value) {
            municipio_select.append("<option value='" + value + "' selected>" + value + "</option>");
          } else {
            municipio_select.append("<option value='" + value + "'>" + value + "</option>");
          }
        });
      }
    });
  }

  $("#departamento_select").on("change", function () {
    cargar_municipio();
  });

  $("#range_paciente_edad").ionRangeSlider({
    type: "double",
    grid: true,
    min: minimo,
    max: maximo,
    from: desde,
    to: hasta,
    step: 1,
    postfix: " años",
    onChange: function (){
      peticion();
    }
  });

  var slider = $("#range_paciente_edad").data("ionRangeSlider");

  $("#limpiar_paciente_filtro").on("click",function(){
    $("#nombre").val("");
    $("#apellido").val("");
    $("#sexo1").parents('div').addClass("checked");
    $("#sexo1").prop("checked",true);
    $("#sexo2").parents('div').removeClass("checked");
    $("#sexo3").parents('div').removeClass("checked");
    $("#telefono").val("");
    $("#dui").val("");
    $("#direccion").val("");
    slider.update({
      from: desde,
      to: hasta
    });
  });

  $("#nombre").on("keyup",function(){
    peticion();
  });

  $("#apellido").on("keyup",function(){
    peticion();
  });

  $("#telefono").on("keyup",function(){
    peticion();
  });

  $("#dui").on("keyup",function(){
    peticion();
  });

  $("#direccion").on("keyup",function(){
    peticion();
  });

  $("#sexo1").on("click",function(){
    peticion();
  });

  $("#sexo2").on("click",function(){
    peticion();
  });

  $("#sexo3").on("click",function(){
    peticion();
  });

  $("#abrir_filtro").on("click",function(){
    peticion();
  });

  function peticion() {
    var v_nombre = $("#nombre").val();
    var v_apellido = $("#apellido").val();
    var v_sexo = $("#sexo").val();
    var v_telefono = $("#telefono").val();
    var v_dui = $("#dui").val();
    var v_direccion = $("#direccion").val();
    var v_edad = $("#range_paciente_edad").val();
    var v_estado = $("#estado").val();

    $.ajax({
      type: "GET",
      url: "/blissey/public/filtrarPaciente",
      data: {
        nombre: v_nombre,
        apellido: v_apellido,
        sexo: v_sexo,
        telefono: v_telefono,
        dui: v_dui,
        direccion: v_direccion,
        edad: v_edad,
        estado: v_estado
      },
      dataType: 'json',
      success: function(respuesta){
        console.log(respuesta);
        var p = $("#texto");
        p.empty();
        if (respuesta > 0 && respuesta < 3){
          var html =
          "La búsqueda generará "+
          "<b style = 'color: rgb(0,128,64);'>"+
            respuesta + " registros" +
          "</b>" +
          " es óptimo para reportes";
        }else{
          var html =
          "La búsqueda generará "+
          "<b style = 'color: rgb(255,60,60);'>"+
            respuesta + " registros" +
          "</b>" +
          " no podrá generar reportes";
        }
        p.append(html);
      },
    });
  }

  $("#fecha_paciente").on("change", function () {
    var hoy = new Date();
    var fecha = $("#fecha_paciente").val();
    var a_fecha = fecha.split('-');
    var is_anio = true;
    var is_mes = true;
    var is_dia = true;
    var anio = parseInt(a_fecha[0]);
    var mes = parseInt(a_fecha[1]);
    var dia = parseInt(a_fecha[2]);

    if (isNaN(anio)) {
      is_anio = false;
    }
    if (isNaN(mes)) {
      is_mes = false;
    }
    if (isNaN(dia)) {
      is_dia = false;
    }

    if (is_dia && is_mes && is_anio && (anio > 1000)) {
      var edad = hoy.getFullYear() - anio;
      if (mes > (hoy.getMonth() + 1)) {
        edad--;
      }
      if (mes == (hoy.getMonth() + 1) && dia > hoy.getDay()) {
        edad--;
      }

      if (edad > 17) {
        $("#dui_paciente").show();
      } else {
        $("#dui_paciente").hide();
      }
    } else {
      $("#dui_paciente").hide();
    }
  });

  $('.radio-pais').on("click", function () {
    cambio_residencia()
  });

  function cambio_residencia() {
    var valor = $("#residencia_paciente").val();
    if (valor == 0) {
      document.getElementById("pais_div").style = "display:block";
      document.getElementById("departamento_div").style = "display:none";
      document.getElementById("municipio_div").style = "display:none";
    } else {
      document.getElementById("pais_div").style = "display:none";
      document.getElementById("departamento_div").style = "display:block";
      document.getElementById("municipio_div").style = "display:block";
    }
  }

  $("#filtro_h").on('change', function () {
    var tipo = $("#filtro_h").val();
    var id = $("#id-p").val();

    $.ajax({
      type: 'get',
      url: '/blissey/public/paciente/servicio_medico',
      data: {
        id: id,
        tipo : tipo
      },
      success: function (r) {
        var tabla = $("#body-table");
        tabla.empty();
        ingreso_tabla.clear();

        for (var i = 0; i < r.count; i++) {
          var fecha = moment(r.r[i].fecha_ingreso);
          var tipo_txt;
          html = '<tr>' +
            '<td>' +
            (i + 1) +
            '</td>' +
            '<td>' +
            fecha.format('DD [de] MMMM [de] YYYY') +
            '</td>' +
            '<td>';
          if (r.r[i].tipo == 0) {
            html += '<span class="badge border border-success text-success col-8">Ingreso</span>';
            tipo_txt = '<span class="badge border border-success text-success col-8">Ingreso</span>';
          } else if (r.r[i].tipo == 1) {
            html += '<span class="badge border border-purple text-purple col-8">Medi ingreso</span>';
            tipo_txt = '<span class="badge border border-purple text-purple col-8">Medi ingreso</span>';
          } else if (r.r[i].tipo == 2) {
            html += '<span class="badge border border-primary text-primary col-8">Observación</span>';
            tipo_txt = '<span class="badge border border-primary text-primary col-8">Observación</span>';
          } else if (r.r[i].tipo == 3 ) {
            html += '<span class="badge border border-pink text-pink col-8">Consulta</span>';
            tipo_txt = '<span class="badge border border-pink text-pink col-8">Consulta</span>';
          } else {
            html += '<span class="badge border border-info text-info col-8">Curación</span>';
            tipo_txt = '<span class="badge border border-info text-info col-8">Curación</span>';
          }
          html += '</td>' +
            '<td>' +
            '<center>' +
            '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></button>' +
            '</center>'+
            '</td>' +
            '</tr>';
          var bto = '<center>' +
            '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></button>' +
            '</center>';
          tabla.append(html);
          ingreso_tabla.row.add([
            (i+1),
            fecha.format('DD [de] MMMM [de] YYYY'),
            tipo_txt,
            bto
          ]);
        }
        ingreso_tabla.draw();
      }
    });
  });

});
