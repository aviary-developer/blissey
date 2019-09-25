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
  if (ubicacion.indexOf("habitaciones/create") > -1) {
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
        } else if (anterior == 1) {
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

    var html_ = '<p>Ingrese el precio diario en dólares que será adicional al servicio médico por utilizar esta cama</p><input type="number" class="swal2-input" step="0.01" id="precio" min="0.00" placeholder="Precio" autofocus value="0">';

    await swal({
      title: 'Nueva cama',
      type: 'info',
      html: html_,
      showCancelButton: true,
      confirmButtonText: '¡Guardar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-light'
    }).then((result) => {

      if (result.value) {

        var id = $("#id").val();

        if (id > 0) {

          var numero;

          if (tipo == 0) {
            numero = $("#count_co").val();
          } else if (tipo == 1) {
            numero = $("#count_ci").val();
          } else {
            numero = $("#count_cm").val();
          }

          $.ajax({
            type: 'post',
            url: $('#guardarruta').val() + '/cama/nueva',
            data: {
              id: id,
              precio: $("#precio").val(),
              numero: numero,
              tipo: tipo
            },
            success: function (r) {
              if (r == 1) {
                localStorage.setItem('msg', 'yes');
                location.reload();
              } else {
                swal('¡Error!', 'Algo salio mal', 'error');
              }
            }
          });

        } else {
          var panel = $("#msg");
          if (add_rows == 0) {
            panel.empty();
          }

          var html = '<div class="col-sm-3 btn-light rounded border border-secondary">' +
            '<div class="flex-row">' +
            '<center>' +
            '<span class="font-weight-bold">Cama</span>' +
            '</center>' +
            '</div>' +
            '<div class="flex-row">' +
            '<center>' +
            '<div class ="circulo-div-mini bg-c4">';

          if (tipo == 0) {
            html += '<span>' + count_co + '</span><input type="hidden" name = "cama[]" value = "' + count_co + '">';
            count_co++;
          } else if (tipo == 1) {
            html += '<span>' + count_ci + '</span><input type="hidden" name = "cama[]" value = "' + count_ci + '">';
            count_ci++;
          } else {
            html += '<span>' + count_cm + '</span><input type="hidden" name = "cama[]" value = "' + count_cm + '">';
            count_cm++;
          }
          html += '</div>' +
            '</center>' +
            '</div>' +
            '<div class="flex-row" style="margin: 3px 0 7px 0;">' +
            '<center>' +
            '<span class = "badge font-sm badge-dark">$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format($("#precio").val()) + '</span><input type="hidden" name="c_precio[]" value ="' + $("#precio").val() + '">' +
            '</center>' +
            '</div>' +
            '<div class="flex-row" style="border-radius: 0 0 4px 4px;">' +
            '<center>' +
            '<button type="button" class="btn btn-sm btn-danger" id="delete_card" style="margin: 2px 0 2px 0;"><i class="fa fa-times"></i> Eliminar</button>' +
            '</center>' +
            '</div>' +
            '</div>';

          panel.append(html);
          add_rows++;
        }
      }
    });
  });

  $("#msg").on('click', '#delete_card', function (e) {
    e.preventDefault();

    $(this).parent('center').parent('div').parent('div').remove();


    var tipo = $("#tipo").val();

    if (tipo == 0) {
      count_co -= add_rows;
    } else if (tipo == 1) {
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
        '<center class="font-weight-bold gray">' +
        '<h4>Información</h4>' +
        '</center>' +
        '<center>' +
        '<span>No se ha registrado ninguna cama a esta habitación</span>' +
        '</center>';

      $("#msg").append(html);
    }

  });

  $("#show_activo").on("click", function (e) {
    e.preventDefault();
    $("#cama_activa").show();
    $("#cama_papelera").hide();
    $("#etiqueta_cama").removeClass('badge-danger').addClass('badge-success').text('Activas');
  });

  $("#show_papelera").on("click", function (e) {
    e.preventDefault();
    $("#cama_activa").hide();
    $("#cama_papelera").show();
    $("#etiqueta_cama").removeClass('badge-success').addClass('badge-danger').text('Papelera');
  });

  $("#save_me").click(function (e) {
    e.preventDefault();
    if (add_rows > 0) {
      $("#form").submit();
    } else {
      swal({
        type: 'error',
        title: '¡Error!',
        text: 'Debe agregar al menos una cama para guardar la habitación',
        timer: 4000,
        toast: true,
        showConfirmButton: false
      });
    }
  });
});

function cama_desactivar(id) {
  swal({
    title: 'Enviar registro a papelera',
    text: '¿Está seguro? ¡Ya no estara disponible!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Enviar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: 'post',
        url: $('#guardarruta').val() + '/cama/desactivar',
        data: {
          id: id
        },
        success: function (r) {
          if (r == 1) {
            localStorage.setItem('msg', 'yes');
            location.reload();
          } else {
            swal('¡Error!', 'Algo salio mal', 'error');
          }
        }
      });
    }
  });
}

function cama_activate(id) {
  swal({
    title: 'Restaurar registro',
    text: '¿Está seguro? ¡El registro estará activo nuevamente!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Restaurar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: 'post',
        url: $('#guardarruta').val() + '/cama/activar',
        data: {
          id: id
        },
        success: function (r) {
          if (r == 1) {
            localStorage.setItem('msg', 'yes');
            location.reload();
          } else {
            swal('¡Error!', 'Algo salio mal', 'error');
          }
        }
      });
    }
  });
}

function editar_cama(id, precio_actual) {

	var html_ = '<p>Ingrese el precio diario en dólares que será adicional al servicio médico por utilizar esta cama</p><input type="number" class="swal2-input" step="0.01" id="precio" min="0.00" placeholder="Precio" autofocus value="' + precio_actual + '">';

  swal({
    title: 'Editar cama',
    type: 'info',
    html: html_,
    showCancelButton: true,
    confirmButtonText: '¡Guardar!',
    cancelButtonText: 'Cancelar',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light'
  }).then(async (result) => {
    if (result.value) {
      await $.ajax({
        type: 'post',
        url: $('#guardarruta').val() + '/cama/editar',
        data: {
          id: id,
          precio: $("#precio").val(),
        },
        success: function (r) {
          if (r == 1) {
            localStorage.setItem('msg', 'yes');
            location.reload();
          } else {
            swal('¡Error!', 'Algo salio mal', 'error');
          }
        },
      });
    }
  });
}