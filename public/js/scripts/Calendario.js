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
      end: '2018-09-06 02:15:00'
    },
    {
      title: 'event3',
      start: '2018-09-09 12:30:00',
      allDay: false // will make the time show
    }
  ];
  $("#calendar").fullCalendar({
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
    locale: 'es',

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
    
  });
});