$(document).on('ready',function(){
  var desde = $("#from").val();
  var hasta = $("#to").val();

  $("#range_paciente_edad").ionRangeSlider({
    type: "double",
    grid: true,
    min: desde,
    max: hasta,
    step: 1,
    postfix: " años",
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

    $.ajax({
      type: "GET",
      url: "blissey/public/filtrarPaciente",
      data: {
        nombre: v_nombre,
        apellido: v_apellido,
        sexo: v_sexo,
        telefono: v_telefono,
        dui: v_dui,
        direccion: v_direccion,
        edad: v_edad
      },
      success: console.log("HOla"),
    });
  }
});
