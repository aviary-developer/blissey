$(document).on('ready',function(){
  $("#busqueda").keyup(function(){
    var valor = $("#busqueda").val();
    if(valor.length > 2){
      var ruta = "/blissey/public/buscarPacienteIngreso/"+valor;
      var tabla = $("#tablaPaciente");
      $.get(ruta,function(res){
        tabla.empty();
        head =
        "<thead>"+
        "<th>Nombre</th>"+
        "<th style='width : 80px'>Acción</th>"+
        "</thead>";
        tabla.append(head);
        $(res).each(function(key,value){
          html =
          "<tr>"+
          "<td>"+
          value.apellido+', '+value.nombre+
          "</td>"+
          "<td>"+
          "<input type='hidden' name='nombre_paciente[]' value ='"+value.apellido+', '+value.nombre+"'>"+
          "<input type='hidden' name='id_paciente[]' value ='"+value.id+"'>"+
          "<button type='button' class='btn btn-xs btn-primary' id='agregar_paciente' data-dismiss='modal'>"+
          "<i class='fa fa-check'></i>"+
          "</button>"+
          "</td>"+
          "</tr>";
          tabla.append(html);
        });
      });
    }
  });

  $('#tablaPaciente').on('click','#agregar_paciente',function(e){
    e.preventDefault();
    var nombre = $(this).parents('tr').find('input:eq(0)').val();
    var id = $(this).parents('tr').find('input:eq(1)').val();
    var opcion = $("#seleccion").val();
    var tabla = $("#tablaPaciente");
    if(opcion == "paciente")
    {
      var input_nombre = $("#n_paciente");
      var input_id = $("#f_paciente");
    }else{
      var input_nombre = $("#n_responsable");
      var input_id = $("#f_responsable");
    }
    input_nombre.val(nombre);
    input_id.val(id);

    $("#busqueda").val("");
    tabla.empty();
    head =
    "<thead>"+
    "<th>Nombre</th>"+
    "<th style='width : 80px'>Acción</th>"+
    "</thead>";
    tabla.append(head);

    $("#modal").modal('hide');
  });
});
