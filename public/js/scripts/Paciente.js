$(document).on('ready',function(){
  var minimo = $("#min").val();
  var maximo = $("#max").val();
  var desde = $("#from").val();
  var hasta = $("#to").val();

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

  $("#lsexo1").on("click",function(){
    peticion();
  });

  $("#lsexo2").on("click",function(){
    peticion();
  });

  $("#lsexo3").on("click",function(){
    peticion();
  });

  $("#abrir_filtro").on("click",function(){
    peticion();
  });

  function peticion() {
    var v_nombre = $("#nombre").val();
    var v_apellido = $("#apellido").val();
    if($("#sexo1").is(":checked")){
      var v_sexo = 2;
    }else if($("#sexo2").is(":checked")){
      var v_sexo = 1;
    }else{
      var v_sexo = 0;
    }
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
          "La busqueda generará "+
          "<b style = 'color: rgb(0,128,64);'>"+
            respuesta + " registros" +
          "</b>" +
          " es óptimo para reportes";
        }else{
          var html =
          "La busqueda generará "+
          "<b style = 'color: rgb(255,60,60);'>"+
            respuesta + " registros" +
          "</b>" +
          " no podrá generar reportes";
        }
        p.append(html);
      },
    });
  }
});
