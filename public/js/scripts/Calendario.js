$(document).ready(function () {
  var actividades = [];

  $.ajax({
    type: 'get',
    url: $('#guardarruta').val() + '/calendario/eventos',
    success: async function (r) {
      await $(r).each(function (key, value) {
        actividades.push({
          id: value.id,
          start: value.start,
          end: value.end,
          title: value.title,
          desc: value.desc,
          color: value.color,
          text: value.text
        });
      });
      console.log(actividades);

    }
  });

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,list',
    },

    views: {
      month: {
        titleFormat: 'MMMM YYYY',
      },
      week: {
        titleFormat: 'DD MMMM YYYY',
        columnHeaderFormat: 'dd DD/MMM',
      },
      day: {
        titleFormat: 'DD MMMM',
      },
    },

    buttonText: {
      today: 'Hoy',
      month: 'Mes',
      week: 'Semana',
      day: 'Día',
      list: 'Lista',
      next: 'Siguiente',
      prev: 'Anterior'
    },

    themeSystem: 'bootstrap3',
    height: 600,
    weekNumbers: true,
    selectable: true,
    editable: true,

    events: function (start, end, timezone, callback) {
      $.ajax({
        type: 'get',
        url: $('#guardarruta').val() + '/calendario/eventos',
        success: function (r) {
          var events = [];
          $(r).each(function (k, v) {
            events.push({
              id: v.id,
              start: v.start,
              end: v.end,
              title: v.title,
              desc: v.desc,
              color: v.color,
              textColor: v.text
            });
          });
          callback(events);
        }
      });
    },

    //Acciones
    dayClick: function (date, jsEvent, view) {
      $("#cal-title").text(date.format('DD [de]  MMMM [del]  YYYY'));
      $("#start-date").val(date.format());
      $("#end-date").val(date.format());

      $("#calendar-create").modal('show');
    },

    eventClick: function (event) {
      $('#event-id').val(event.id);
      $("#cal-title-u").text(event.start.format('DD [de]  MMMM [del]  YYYY'));
      $("#hora-i-u").text(event.start.format('hh:mm a'));
      $("#hora-f-u").text(event.end.format('hh:mm a'));
      $("#titulo-ev-u").val(event.title);
      $("#desc-ev-u").val(event.desc);
      $("#calendar-update").modal('show');
    },
  });


  $("#sel-user").on('change', function () {
    var valor = $("#sel-user").val();
    if (valor == 0) {
      $("#tipo-u-div").show();
    } else {
      $("#tipo-u-div").hide();
    }
  });

  $("#guardar_evento").click(function (e) {
    e.preventDefault();

    var fecha_inicio = $("#start-date").val();
    var fecha_final = $("#end-date").val();
    var hora_incio = $("#hora-inicio").val();
    var hora_final = $("#hora-final").val();
    var titulo = $("#titulo-ev").val();
    var descripcion = $("#desc-ev").val();
    var usuario = $("#sel-user").val();
    var tipo_u = $("#sel-t-user").val();
    fecha_inicio = fecha_inicio + ' ' + hora_incio;
    fecha_final = fecha_final + ' ' + hora_final;

    console.log(fecha_inicio + ' | ' + fecha_final);
    $.ajax({
      type: 'post',
      url: $('#guardarruta').val() + '/calendarios',
      data: {
        fecha_inicio: fecha_inicio,
        fecha_final: fecha_final,
        f_usuario: usuario,
        tipo_usuario: tipo_u,
        titulo: titulo,
        descripcion: descripcion
      },
      success: function (r) {
        if (r == 1) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        } else {
          swal("¡Error!", "Algo salio mal", "error");
        }
      }
    });
  });

  $("#editar_evento").click(function (e) {
    e.preventDefault();

    var titulo = $("#titulo-ev-u").val();
    var descripcion = $("#desc-ev-u").val();
    var id = $("#event-id").val();

    $.ajax({
      type: 'put',
      url: $('#guardarruta').val() + '/calendarios/' + id,
      data: {
        titulo: titulo,
        descripcion: descripcion
      },
      success: function (r) {
        if (r == 1) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        } else {
          swal("¡Error!", "Algo salio mal", "error");
        }
      }
    });
  });

  $("#eliminar_evento").click(function (e) {
    e.preventDefault();

    var id = $("#event-id").val();

    return swal({
      title: 'Eliminar registro',
      text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Eliminar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-danger',
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        type: 'delete',
        url: $('#guardarruta').val() + '/calendarios/' + id,
        success: function (r) {
          if (r == 1) {
            localStorage.setItem('msg', 'yes');
            location.reload();
          } else {
            swal("¡Error!", "Algo salio mal", "error");
          }
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal(
          'Cancelado',
          'El registro se mantiene',
          'info'
        )
      }
    });
  });
});