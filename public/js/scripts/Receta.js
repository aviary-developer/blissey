$(document).on('ready', function () {
  $("#med-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#med-btn").removeClass('btn-default').addClass('btn-primary');
    $('#lab-btn').removeClass('btn-primary').addClass('btn-default');
    $('#ryu-btn').removeClass('btn-primary').addClass('btn-default');
    $('#otro-btn').removeClass('btn-primary').addClass('btn-default');

    //Metodos de los divs
    $("#med-div").show();
    $("#lab-div").hide();
    $("#ryu-div").hide();
    $("#otro-div").hide();
  });

  $("#lab-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#lab-btn").removeClass('btn-default').addClass('btn-primary');
    $('#med-btn').removeClass('btn-primary').addClass('btn-default');
    $('#ryu-btn').removeClass('btn-primary').addClass('btn-default');
    $('#otro-btn').removeClass('btn-primary').addClass('btn-default');

    //Metodos de los divs
    $("#lab-div").show();
    $("#med-div").hide();
    $("#ryu-div").hide();
    $("#otro-div").hide();
  });

  $("#ryu-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#ryu-btn").removeClass('btn-default').addClass('btn-primary');
    $('#lab-btn').removeClass('btn-primary').addClass('btn-default');
    $('#med-btn').removeClass('btn-primary').addClass('btn-default');
    $('#otro-btn').removeClass('btn-primary').addClass('btn-default');

    //Metodos de los divs
    $("#ryu-div").show();
    $("#lab-div").hide();
    $("#med-div").hide();
    $("#otro-div").hide();
  });

  $("#otro-btn").click(function (e) {
    e.preventDefault();

    //Metodos de botones
    $("#otro-btn").removeClass('btn-default').addClass('btn-primary');
    $('#lab-btn').removeClass('btn-primary').addClass('btn-default');
    $('#ryu-btn').removeClass('btn-primary').addClass('btn-default');
    $('#med-btn').removeClass('btn-primary').addClass('btn-default');

    //Metodos de los divs
    $("#otro-div").show();
    $("#lab-div").hide();
    $("#ryu-div").hide();
    $("#med-div").hide();
  });

  $("#nombre_producto").on('change keyup',async function () {
    var texto = $("#nombre_producto").val();

    if (texto.length > 0) {
      await $.ajax({
        type: 'get',
        url: '/blissey/public/consultas/datos_producto',
        data: {
          valor: texto
        },
        success: function (r) {
          $("#presentacion-selecta").text(r.presentacion);
          if (r.presentacion != "¡No está disponible!") {
            $("#presentacion-selecta").addClass('blue').removeClass('gray red');
          } else {
            $("#presentacion-selecta").addClass('red').removeClass('gray blue');
          }
        }
      });
    } else {
      $("#presentacion-selecta").text('Buscando...');
      $("#presentacion-selecta").addClass('gray').removeClass('blue red');
    }
  });

  $("#alergia_btn").on("click", function (e) {
    var paciente = $("#id_p").val();
    var alergia = $("#alergias").text();
    if (alergia == "Ninguna") {
      alergia = "";
    }
    
    var html_ = '<input type="text" class="swal2-input" id="a_lergia" placeholder="Alergias del paciente" value="' + alergia + '" autofocus>';

    swal({
      title: 'Alergias',
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default'
    }).then(function () {
      $.ajax({
        url: "/blissey/public/editar_alergia",
        type: "POST",
        data: {
          id: paciente,
          alergia: $("#a_lergia").val()
        },
        success: function (r) {
          if (r != 2) {
            swal("¡Hecho!", "Acción realizada exitosamente", 'success');
            $("#alergias").text(r);
          } else {
            swal("¡Algo salio mal!", 'No se guardo', 'error');
          }
        }
      });
    }).catch(swal.noop);
  });

  $("#agregar-medicamento-receta").click(function (e) { 
    e.preventDefault();

    //Variables de información
    var medicamento = $("#nombre_producto").val();
    var cant_dosis = $("#numero-dosis").val();
    var forma_dosis = $("#forma-dosis").val();
    var texto_dosis = $("#forma-dosis option:selected").text();
    var cant_frec = $("#numero-frec").val();
    var forma_frec = $("#forma-frec").val();
    var texto_frec = $("#forma-frec option:selected").text();
    var cant_duracion = $("#numero-duracion").val();
    var forma_duracion = $("#forma-duracion").val();
    var texto_duracion = $("#forma-duracion option:selected").text();
    var observacion = $("#observacion-receta").val();
    var presentacion = $("#presentacion-selecta").text();

    if (medicamento.length > 0) {
      
      var html = '<div class="row">' +
        '<div class="row" style="margin: 0 10px 0 15px">' +
        '<p style="font-size: medium">' +
        '<button type="button" class="btn btn-xs btn-danger" id="remove_medicamento">' +
        '<i class="fa fa-remove"></i>' +
        '</button>' +
        cant_dosis + ' ' + ((forma_dosis == 0 && presentacion != "¡No está disponible!") ? presentacion : texto_dosis) + ' de ' +
        '<b class="blue">'+
        medicamento +
        '</b>'+
        ' cada ' + cant_frec + ' ' + texto_frec + ' durante ' + ((forma_duracion == 5) ? ('tiempo ' + texto_duracion) : (cant_duracion + ' ' + texto_duracion)) + '. ' +
        ((observacion.length > 0)?('<i>' + 'Nota: '+ observacion + '</i>'):"") +
        '</p>' +
        '<input type="hidden" name="medicamento[]" id="i_medicamento" value="' + medicamento + '">' +
        '<input type="hidden" name="cant_dosis[]" id="i_cant_dosis" value="' + cant_dosis + '">' +
        '<input type="hidden" name="forma_dosis[]" id="i_forma_dosis" value="' + forma_dosis + '">' +
        '<input type="hidden" name="cant_frec[]" id="i_cant_frec" value="' + cant_frec + '">' +
        '<input type="hidden" name="forma_frec[]" id="i_forma_frec" value="' + forma_frec + '">' +
        '<input type="hidden" name="cant_duracion[]" id="i_cant_duracion" value="' + cant_duracion + '">' +
        '<input type="hidden" name="forma_duracion[]" id="i_forma_duracion" value="' + forma_duracion + '">' +
        '<input type="hidden" name="observacion[]" id="i_observacion" value="' + observacion + '">' +
        '</div>' +
        '</div>';
      
      $("#texto-medicamento").append(html);
    } else {
      swal('Error', 'No ha seleccionado ningún medicamento', 'error');
    }

    $("#nombre_producto").val("");
    $("#numero-dosis").val("1");
    $("#forma-dosis").val(0);
    $("#numero-frec").val("1");
    $("#forma-frec").val(0);
    $("#numero-duracion").val("1");
    $("#forma-duracion").val(0);
    $("#observacion-receta").val("");
    $("#presentacion-selecta").text('Buscando...');
    $("#presentacion-selecta").addClass('gray').removeClass('blue red');

    $("#checkObservacion").prop('unchecked');
    $("#divObservacion").hide();

    $("#nombre_producto").focus();
  });

  $("#texto-medicamento").on('click','#remove_medicamento' ,function (e) {
    e.preventDefault();

    $(this).parent('p').parent('div').parent('div').remove();
  });
});

$("#receta").on('shown.bs.modal', function () {
  $(document).off('focusin.modal');
});