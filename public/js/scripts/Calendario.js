$(document).ready(function () {
  var datos = [
    {
      title: 'event1',
      start: '2018-09-01 16:00:00',
      end: '2018-09-01 16:30:00',
      color: 'green'
    },
    {
      title: 'event2',
      start: '2018-09-05',
      end: '2018-09-06 02:15:00',
      id: 1010,
    },
    {
      title: 'event3',
      start: '2018-09-09 12:30:00',
      allDay: false // will make the time show
    }
  ];
  $("#ar").fullCalendar({
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
      list: 'Lista'
    },

    themeSystem: 'bootstrap3',
    height: 550,
    weekNumbers: true,
    selectable: true,
    

    dayClick: function (date, jsEvent, view) {

      console.log('Clicked on: ' + date.format('d/M/Y'));

      // change the day's background color just for fun
      $(this).css('background-color', 'red');

    },
    select: function (start, end, jsEvent, view) {
      console.log('Click desde: ' + start.format() + ' hasta: ' + end.format());

      $(this).css('background-color', 'blue');
    },

    events: datos,

    eventClick: function (event) {
      if (event.id) {
        alert(event.id + ' ' + event.start.format());
        return false;
      }
    },

    editable: true,
    eventDrop: function (event, delta, revertFunc) {

      alert(event.title + " was dropped on " + event.start.format());

      if (!confirm("Are you sure about this change?")) {
        revertFunc();
      }

    },

    eventResize: function (event, delta, revertFunc) {

      alert(event.title + " end is now " + event.end.format());

      if (!confirm("is this okay?")) {
        revertFunc();
      }

    },
    eventLimit: true,
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
      list: 'Lista'
    },

    themeSystem: 'bootstrap3',
    height: 600,
    weekNumbers: true,
    selectable: true,
    editable: true,

    //Acciones
    dayClick: function (date, jsEvent, view) {
      $("#cal-title").text(date.format('DD [de]  MMMM [del]  YYYY'));
      $("#start-date").val(date.format());
      $("#end-date").val(date.format());

      $("#calendar-create").modal('show');
    },
  });

  $("#sel-user").on('change', function () {
    var valor = $("#sel-user").val();
    if (valor == 0) {
      $("#sel-t-user").show();
    } else {
      $("#sel-t-user").hide();
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
      url: '/blissey/public/calendarios',
      data: {
        fecha_inicio: fecha_inicio,
        fecha_final: fecha_final,
        f_usuario: usuario,
        tipo_usuario: tipo_u,
        titulo: titulo,
        descripcion: descripcion
      },
      success: function (r) {
        console.log(r);
        if (r == 1) {
          swal("¡Hecho!", "Acción realizada satisfactoriamente", "success");
          location.reload();
        } else {
          swal("¡Error!", "Algo salio mal", "error");   
        }
      }
    });
  });
});