$(document).on('ready', function () {
  var count_hi = $("#count_hi").val();
  var count_ho = $("#count_ho").val();
  var count_hm = $("#count_hm").val();

  var count_ci = $("#count_ci").val();
  var count_co = $("#count_co").val();
  var count_cm = $("#count_cm").val();

  var add_rows = 0;
  var anterior = 1;

  var ubicacion = window.location.pathname;
  if (ubicacion.indexOf("/blissey/public/habitaciones/create") > -1) {
    $("#radioBtn a").on("click", function (e) {
      e.preventDefault();
      var tipo = $("#tipo").val();
      var fondo = $("#fondo");
      var texto = $("#hnumero");
      var hnumero_i = $("#hnumero_i");
      if (tipo == 0) {
        fondo.removeClass('bg-c1 bg-c3').addClass('bg-c2');
        texto.text(count_ho);
        hnumero_i.val(count_ho);
      } else if (tipo == 1) {
        fondo.removeClass('bg-c2 bg-c3').addClass('bg-c1');
        texto.text(count_hi);
        hnumero_i.val(count_hi);
      } else {
        fondo.removeClass('bg-c1 bg-c2').addClass('bg-c3');
        texto.text(count_hm);
        hnumero_i.val(count_hm);
      }

      console.log(anterior);
      if (add_rows > 0) {
        if (anterior == 0) {
          count_co -= add_rows;
        } else if(anterior == 1){
          count_ci -= add_rows;
        } else {
          count_cm -= add_rows;
        }
        $("#msg > div").each(function (key, value) {
          input_numero = $(value).children('div:eq(1)').children('center').children('div').children('input');
          span_numero = $(value).children('div:eq(1)').children('center').children('div').children('span');
    
          if (tipo == 0) {
            input_numero.val(count_co);
            span_numero.text(count_co);
            count_co++;
          } else if (tipo == 1) {
            input_numero.val(count_ci);
            span_numero.text(count_ci);
            count_ci++;
          } else {
            input_numero.val(count_cm);
            span_numero.text(count_cm);
            count_cm++;
          }
        });
      }
  
      anterior = tipo;
    });

  }
  $("#cama_nueva").on("click", async function (e) {
    e.preventDefault();
    var tipo = $("#tipo").val();

    var html_ = '<p>Ingrese el precio diario en dólares por utilizar esta cama</p><input type="number" class="swal2-input" step="0.01" id="precio" min="0.00" placeholder="Precio" autofocus>';

    await swal({
      title: 'Nueva cama',
      type: 'info',
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default'
    }).then(function () {
      
      var panel = $("#msg");
      if (add_rows == 0) {
        panel.empty();
      }

      var html = '<div class="col-xs-3 btn-default" style="border-radius: 4px">' + 
        '<div class="row">' +
        '<center>' +
        '<span class="big-text">Cama</span>' +
        '</center>' +
        '</div>' +
        '<div class="row">' +
        '<center>' +
      '<div class ="circulo-div-mini bg-c4">';

      if (tipo == 0) {
        html += '<span>' + count_co + '</span><input type="hidden" name = "cama[]" value = "'+ count_co+'">';
        count_co++;
      } else if(tipo == 1) {
        html += '<span>' + count_ci + '</span><input type="hidden" name = "cama[]" value = "' + count_ci + '">';
        count_ci++;
      } else {
        html += '<span>' + count_cm + '</span><input type="hidden" name = "cama[]" value = "' + count_cm + '">';
        count_cm++;
      }
      html += '</div>' +
        '</center>' +
        '</div>' +
        '<div class="row" style="margin: 3px 0 7px 0;">' +
        '<center>' +
        '<span class = "label label-lg label-default">$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format($("#precio").val()) + '</span><input type="hidden" name="c_precio[]" value ="' + $("#precio").val() + '">' +
        '</center>' +
        '</div>' +
        '<div class="row bg-blue-sky" style="border-radius: 0 0 4px 4px;">' +
        '<center>' +
        '<button type="button" class="btn btn-xs btn-default blue" id="delete_card" style="margin: 2px 0 2px 0;"><i class="fa fa-remove"></i> Eliminar</button>' +
        '</center>' +
        '</div>' +
        '</div>';

      panel.append(html);
      add_rows++;

    }).catch(swal.noop);
  });

  $("#msg").on('click', '#delete_card', function (e) {
    e.preventDefault();

    $(this).parent('center').parent('div').parent('div').remove();
    

    var tipo = $("#tipo").val();

    if (tipo == 0) {
      count_co -= add_rows;
    } else if(tipo == 1) {
      count_ci -= add_rows;
    } else {
      count_cm -= add_rows;
    }

    add_rows--;

    if (add_rows > 0) {
      $("#msg > div").each(function (key, value) {
        input_numero = $(value).children('div:eq(1)').children('center').children('div').children('input');
        span_numero = $(value).children('div:eq(1)').children('center').children('div').children('span');
  
        if (tipo == 0) {
          input_numero.val(count_co);
          span_numero.text(count_co);
          count_co++;
        } else if (tipo == 1) {
          input_numero.val(count_ci);
          span_numero.text(count_ci);
          count_ci++;
        } else {
          input_numero.val(count_cm);
          span_numero.text(count_cm);
          count_cm++;
        }
      });
    } else {
      $("#msg").empty();
      var html = '<center style="margin-top: 60px">' +
        '<i class="fa fa-info-circle gray" style="font-size: 800%"></i>' +
        '</center>' +
        '<center class="big-text gray">' +
        '<h4>Información</h4>' +
        '</center>' +
        '<center>' +
        '<span>No se ha registrado ninguna cama a esta habitación</span>' +
        '</center>';
      
      $("#msg").append(html);
    }

  });
});