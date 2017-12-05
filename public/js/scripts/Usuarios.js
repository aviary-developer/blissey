$(document).on('ready',function(){
  var limite = $("#contador").val();
  var especialidad_agregada = [];
  for(i=0;i<=limite;i++)
  {
    var especial = $('#especialidad'+i).val();
    especialidad_agregada.push(especial);
  }
  var wrapper = $('#tablaTelefono');
  var wrapper2 = $('#tablaEspecialidad');
  var contador_especialidad = 0;

  $('#agregar_telefono').click(function(){
    var contenido = $('#telefono_usuario').val();
    var html_texto = "<tr>"+
    "<td>"+
    "<input type='hidden' name='telefono[]' value = '"+contenido+"'/>"+
    contenido+
    "</td>"+
    "<td>"+
      "<button type = 'button' name='button' class='btn btn-danger btn-xs' id='eliminar_telefono' data-toggle='tooltip' data-placement='top' title='Eliminar'>"+
        "<i class='fa fa-remove'></i>"+
      "</button>"+
    "</td>"+
    "</tr>";
    if(contenido != ""){
      $(wrapper).append(html_texto);
      $('#telefono_usuario').val("");
      $('#eliminar_telefono').tooltip();
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
    if(especialidad_agregada.indexOf(valor)==-1)
    {
      especialidad_agregada.push(valor);
      $(wrapper2).append(html_texto);
      contador_especialidad++;
    }
  });

  $(wrapper).on('click','#eliminar_telefono',function(e){
    e.preventDefault();
    $(this).parent('td').parent('tr').remove();
  });

  $(wrapper).on('click','#eliminar_telefono_antiguo',function(e){
    e.preventDefault();
    var valores = $(this).parents('tr').find('input').val();
    $("#deletes").val(valores);
    $(this).parent('td').parent('tr').remove();
  });

  $(wrapper2).on('click','#eliminar_especialidad',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input').val();
    var indice = especialidad_agregada.indexOf(elemento);
    especialidad_agregada.splice(indice);
    $(this).parent('td').parent('tr').remove();
  });

  $(wrapper2).on('click','#eliminar_especialidad_antiguo',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = especialidad_agregada.indexOf(elemento);
    especialidad_agregada.splice(indice);

    var valores = $(this).parents('tr').find('input:eq(1)').val();
    $("#delesp").val(valores);
    $(this).parent('td').parent('tr').remove();
  });

  $("#guardar_especialidad").on('click', function (e) {
    e.preventDefault();
    var v_nombre = $("#nombre_especialidad");
    var s_especialidad = $("#select_especialidad");
    var modal = $("#modal");
    $.ajax({
      type: "GET",
      url: "/blissey/public/guardarEspecialidad",
      data: {
        nombre: v_nombre.val()
      },
      dateType: 'json',
      success: function (respuesta) {
        if (respuesta > 0) {
          var html = "<option value = '" + respuesta + "'>" + v_nombre.val() + "</option>";
          s_especialidad.append(html);
          modal.modal('hide');
          return swal('Hecho', 'Acción realizada satisfactoriamente', 'success');
          v_nombre.val("");
        } else {
          return swal('Algo salio mal', 'Acción no realizada', 'error');
        }
      }
    });
  });
});
