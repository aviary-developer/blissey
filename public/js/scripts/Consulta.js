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
      success: function(r){
        console.log(r);
      },
    });

  });
});