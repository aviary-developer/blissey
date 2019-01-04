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

  $("#week_calendar").fullCalendar({
    header: {
      left: '',
      center: '',
      right: ''
    },

    defaultView: 'agendaMini',
    height: 180,

    views: {
      agendaMini: {
        type: 'basic',
        duration: {
          days: 5,
        },
      }
    },

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
  });
})