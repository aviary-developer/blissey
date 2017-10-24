$(document).on('ready',function(){
  var division_agregada = [];
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
        ganancia+
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
    var ruta = "/blissey/public/buscarComponenteProducto/"+valor;
    $.get(ruta,function(res){
      $(res).each(function(key,value){
        alert(value.nombre);
      });
    });
  });
});
