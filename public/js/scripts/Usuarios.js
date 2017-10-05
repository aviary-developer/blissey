$(document).on('ready',function(){
    

  var wrapper = $('#tablaTelefono');
  var wrapper2 = $('#tablaEspecialidad');
  var especialidad_agregada = [];
  var contador_especialidad = 0;

  $('#agregar_telefono').click(function(){
    var contenido = $('#telefono').val();
    var html_texto = "<tr>"+
    "<td>"+
    "<input type='hidden' name='telefono[]' value = '"+contenido+"'/>"+
    contenido+
    "</td>"+
    "<td>"+
      "<button type = 'button' name='button' class='btn btn-danger btn-xs' id='eliminar_telefono'>"+
        "<i class='fa fa-remove'></i>"+
      "</button>"+
    "</td>"+
    "</tr>";
    if(contenido != ""){
      $(wrapper).append(html_texto);
      $('#telefono').val("");
    }

  });

  $('#agregar_especialidad').click(function(){
    var contenido = $('#especialidad').find('option:selected').text();
    var valor = $('#especialidad').find('option:selected').val();
    var html_texto = "<tr>"+
    "<td>"+
    contenido+
    "</td>"+
    "<td>"+
      "<input type='hidden' name='especialidad[]' value = '"+valor+"'/>"+
      "<button type = 'button' name='button' class='btn btn-danger btn-xs' id='eliminar_especialidad'>"+
        "<i class='fa fa-remove'></i>"+
      "</button>"+
    "</td>"+
    "</tr>";
    if(especialidad_agregada.indexOf(contenido)==-1)
    {
      especialidad_agregada.push(contenido);
      $(wrapper2).append(html_texto);
      contador_especialidad++;
    }
  });

  $(wrapper).on('click','#eliminar_telefono',function(e){
    e.preventDefault();
    $(this).parent('td').parent('tr').remove();
  });

  $(wrapper2).on('click','#eliminar_especialidad',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('td:eq(0)').html();
    var indice = especialidad_agregada.indexOf(elemento);
    especialidad_agregada.splice(indice);
    $(this).parent('td').parent('tr').remove();
  });
});
