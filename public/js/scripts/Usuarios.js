$(document).on('ready', function () {
  var ubicacion = window.location.pathname;
  if (ubicacion.indexOf("/blissey/public/usuarios")>-1) {
    var boton_atras = "<a href='/blissey/public/usuarios' class='btn btn-default'>Cancelar</a>"
    $(".actionBar").append(boton_atras);
    if (!(ubicacion.indexOf('edit') > -1)) {
      $(".buttonFinish").addClass("stop_ex");
      $(".buttonFinish").addClass("usuario_ex");
    }
  }
  if (ubicacion.indexOf("/blissey/public/productos") > -1) {
    var boton_atras = "<a href='/blissey/public/productos' class='btn btn-default'>Cancelar</a>"
    $(".actionBar").append(boton_atras);
  }
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

  $(".usuario_ex").on("click", function (e) {
    e.preventDefault();
    var tipo_usuario = $("#tipoUsuario").val();
    
    if (tipo_usuario == "Médico" || tipo_usuario == "Gerencia") {
      var usuario = (tipo_usuario == "Médico") ? "Médico" : "Gerencia";
      var html_ = "<p>Para almacenar un usuario de tipo <span class='blue'>" + usuario + "</span> necesitamos saber el precio de sus honorarios por consulta:</p> <input type='number' class='swal2-input' step='0.01' min='0.00' placeholder='Precio' id='precio_swal'><p>También necesitamos saber el valor que le retiene el hospital por consulta:</p><input class='swal2-input' id='retencion_swal' type='number' step='0.01' min='0.00' placeholder='Retención'>";
      
      swal({
        title: '¡Importante!',
        html: html_,
        showCancelButton: true,
        confirmButtonText: '¡Guardar!',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-default'
      }).then(function () {
        $("#precio").val($("#precio_swal").val());
        $("#retencion").val($("#retencion_swal").val());
        $("#form").submit();
      }).catch(swal.noop);
    } else {
      $("#form").submit();
    }
  });

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

  $('#btn_change').on('click', function (e) {
    e.preventDefault();
    var v_nueva = $("#new_pass").val();
    var v_nueva_r = $("#new_pass_r").val();
    if (v_nueva.length >= 6) {
      var v_actual = $("#current_pass").val();
      if (v_nueva == v_nueva_r) {
        $.ajax({
          type: "POST",
          url: "/blissey/public/psw",
          data: {
            _token: $("#token").val(),
            actual: v_actual,
            nueva: v_nueva,
          },
          success: function (respuesta) {
            $("#modal").modal('hide');
            if (respuesta != "error") {
              return swal('¡Hecho!', 'Se ha cambiado la contraseña', 'success');
            } else {
              return swal('Error', 'La contraseña actual no coincide', 'error');
            }
          },
          error: function (respuesta) {
            if (respuesta == "error") {
              return swal('Error', 'La contraseña actual no coincide', 'error');
            }
            return swal('Error', 'Algo ha salido mal', 'error');
          }
        });
      } else {
        return swal('Error', 'No repitío correctamente la nueva contraseña', 'error');
      }
    } else {
      return swal('Error', 'La contraseña debe contener al menos 6 caracteres', 'error');
    }
  });
});
