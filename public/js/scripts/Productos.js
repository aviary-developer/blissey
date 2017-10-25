$(document).on('ready',function(){
  var division_agregada = [];
  var componentes_agregados = [];
  $('#agregar_division').click(function(){
    var division = $('#division').find('option:selected').text();
    var valor = $('#division').find('option:selected').val();
    var cantidad = $('#cantidad').val();
    var ganancia = $('#ganancia').val();
    var html_texto =
    "<tr>"+
      "<td>"+
        division+
      "</td>"+
      "<td>"+
        cantidad+
      "</td>"+
      "<td>"+
        "$ "+ganancia+
      "</td>"+
      "<td>"+
        "<input type='hidden' name='divisiones[]' value='"+valor+"'/>"+
        "<input type='hidden' name='cantidades[]' value='"+cantidad+"'/>"+
        "<input type='hidden' name='ganancias[]' value='"+ganancia+"'/>"+
        "<button type='button' name='button' class='btn btn-xs btn-danger' id='eliminar_division'>"+
          "<i class='fa fa-remove'></i>"+
        "</button>"+
      "</td>"+
    "</tr>";

    if(division_agregada.indexOf(valor)==-1){
      division_agregada.push(valor);
      $("#tablaDivision").append(html_texto);
      $("#cantidad").val("1");
      $("#ganancia").val("0.00");
    }
  });

  $("#tablaDivision").on('click','#eliminar_division',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input').val();
    var indice = division_agregada.indexOf(elemento);
    division_agregada.splice(indice);
    $(this).parent('td').parent('tr').remove();
  });

  $("#componente").keyup(function(){
    var valor = $("#componente").val();
    if(valor.length > 2){
      var ruta = "/blissey/public/buscarComponenteProducto/"+valor;
      var tabla = $("#tablaBuscarComponente");
      $.get(ruta,function(res){
        tabla.empty();
        head =
        "<thead>"+
        "<th>Componente</th>"+
        "<th style='width : 80px'>Acción</th>"+
        "</thead>";
        tabla.append(head);
        $(res).each(function(key,value){
          html =
          "<tr>"+
          "<td>"+
          value.nombre+
          "</td>"+
          "<td>"+
          "<input type='hidden' name='nombre_componente[]' value ='"+value.nombre+"'>"+
          "<input type='hidden' name='id_componente[]' value ='"+value.id+"'>"+
          "<button type='button' class='btn btn-xs btn-primary' id='agregar_componente'>"+
          "<i class='fa fa-arrow-right'></i>"+
          "</button>"+
          "</td>"+
          "</tr>";
          tabla.append(html);
        });
      });
    }
  });

  $("#tablaBuscarComponente").on('click','#agregar_componente',function(e){
    e.preventDefault();
    var nombre = $(this).parents('tr').find('input:eq(0)').val();
    var id = $(this).parents('tr').find('input:eq(1)').val();
    var tabla = $("#tablaComponente");
    var tabla_busqueda = $("#tablaBuscarComponente");
    var cantidad = $("#cantidad_componente").val();
    var unidad = $("#unidad").find("option:selected").text();
    var unidad_id = $("#unidad").find("option:selected").val();
    var html =
    "<tr>"+
      "<td>"+
        nombre+
      "</td>"+
      "<td>"+
        cantidad+" "+unidad+
      "</td>"+
      "<td>"+
        "<button type='button' class='btn btn-xs btn-danger' id='eliminar_componente'>"+
          "<i class='fa fa-remove'></i>"+
        "</button>"+
      "</td>"+
    "</tr>";
    if(componentes_agregados.indexOf(id)==-1){
      componentes_agregados.push(id);
      tabla.append(html);

      tabla_busqueda.empty();
      head =
      "<thead>"+
        "<th>Componente</th>"+
        "<th style='width : 80px'>Acción</th>"+
      "</thead>";
      tabla_busqueda.append(head);

      $("#cantidad_componente").val("1");
      $("#componente").val("");

      $("#componente").focus();
    }
  });
});
