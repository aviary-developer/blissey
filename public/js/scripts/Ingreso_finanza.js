function resumen(id, dia) {
  var super_body = $("#cuerpo");
  var mini_resumen = $("#mini_resumen");
  $.ajax({
    url: $('#guardarruta').val() + "/total_resumen",
    type: "get",
    data: {
      id: id,
      fecha: dia
    },
    success: function (respuesta) {
      super_body.empty();
      mini_resumen.empty();

      html = '<div class = "flex-row">' +
        '<h4>' +
        '<center>' +
        '<i class = "far fa-calendar"></i>' + " " +
        respuesta.fecha +
        '</center>' +
        '</h4>' +
        '</div>';

      super_body.append(html);

      html = "<div class='flex-row'>" +
        '<div class="col-sm-6 tile_stats_count">' +
        '<span class="count_top text-monospace">' +
        '<center>' +
        'Total de gastos' +
        '</center>' +
        '</span>' +
        '<center>' +
        '<h2 class="count text-danger">' +
        '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.total) +
        '</h2>' +
        '</center>' +
        '</div>' +
        '<div class="col-sm-6 tile_stats_count">' +
        '<span class="count_top text-monospace">' +
        '<center>' +
        'Total abonado' +
        '</center>' +
        '</span>' +
        '<center>' +
        '<h2 class="count text-success">' +
        '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.abono) +
        '</h2>' +
        '</center>' +
        '</div>' +
        "</div>";

      mini_resumen.append(html);

      html = '<div class="row" id="fila_main"><div class="col-sm-12"><div class="x_panel rounded border border-danger" id="gasto_body"></div></div></div>';

      super_body.append(html);

      var body = $("#gasto_body");

      html = '<div class="flex-row">' +
        '<h4 class="text-danger mt-1 mb-1">' +
        '<center>' +
        '<i class="fa fa-arrow-down"></i>' + ' ' +
        "Gastos" +
        '</center>' +
        '</h4>' +
        '</div>';

      body.append(html);

      html = '<div class = "row bg-gray" style="padding: 5px 0px 5px 0px">' +
        '<div class="col-sm-12">' +
        '<span class="black"><b>' +
        '<center><i class="fas fa-hospital"></i>' +
        ' Servicios Hospitalarios' +
        '</center>' +
        '</b></span>' +
        '</div>' +
        '</div>';

      body.append(html);

      html = '<div class = "row">' +
        '<div class="col-sm-9">' +
        '<span><b>' +
        respuesta.habitacion_nombre +
        '</b></span>' +
        '</div>' +
        '<div class="col-sm-3 text-right">' +
        '<span>' +
        '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.habitacion) +
        '</span>' +
        '</div>' +
        '</div>';

      body.append(html);

      if (respuesta.laboratorio != 0) {
        html = '<div class = "row">' +
          '<div class="col-sm-9">' +
          '<span><b>' +
          'Laboratorio' +
          '</b></span>' +
          '</div>' +
          '<div class="col-sm-3 text-right">' +
          '<span>' +
          '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.laboratorio) +
          '</span>' +
          '</div>' +
          '</div>';

        $(respuesta.examenes).each(function (key, value) {
          html += '<div class = "row">' +
            '<div class="col-sm-1"></div>' +
            '<div class="col-sm-7">' +
            '<span><i>' +
            value.nombre +
            '</i></span>' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<span><i>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</i></span>' +
            '</div>' +
            '</div>';
        });

        body.append(html);
      }

      if (respuesta.ultrasonografia != 0) {
        html = '<div class = "row">' +
          '<div class="col-sm-9">' +
          '<span><b>' +
          'Ultrasonografía' +
          '</b></span>' +
          '</div>' +
          '<div class="col-sm-3 text-right">' +
          '<span>' +
          '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.ultrasonografia) +
          '</span>' +
          '</div>' +
          '</div>';

        $(respuesta.ultras).each(function (key, value) {
          html += '<div class = "row">' +
            '<div class="col-sm-1"></div>' +
            '<div class="col-sm-7">' +
            '<span><i>' +
            value.nombre +
            '</i></span>' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<span><i>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</i></span>' +
            '</div>' +
            '</div>';
        });

        body.append(html);
      }

      if (respuesta.rayosx != 0) {
        html = '<div class = "row">' +
          '<div class="col-sm-9">' +
          '<span><b>' +
          'Rayos X' +
          '</b></span>' +
          '</div>' +
          '<div class="col-sm-3 text-right">' +
          '<span>' +
          '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.rayosx) +
          '</span>' +
          '</div>' +
          '</div>';

        $(respuesta.rayos).each(function (key, value) {
          html += '<div class = "row">' +
            '<div class="col-sm-1"></div>' +
            '<div class="col-sm-7">' +
            '<span><i>' +
            value.nombre +
            '</i></span>' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<span><i>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</i></span>' +
            '</div>' +
            '</div>';
        });

        body.append(html);
      }

      if (respuesta.tacs != 0) {
        html = '<div class = "row">' +
          '<div class="col-sm-9">' +
          '<span><b>' +
          'TAC' +
          '</b></span>' +
          '</div>' +
          '<div class="col-sm-3 text-right">' +
          '<span>' +
          '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.tacs) +
          '</span>' +
          '</div>' +
          '</div>';

        $(respuesta.tac).each(function (key, value) {
          html += '<div class = "row">' +
            '<div class="col-sm-1"></div>' +
            '<div class="col-sm-7">' +
            '<span><i>' +
            value.nombre +
            '</i></span>' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<span><i>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</i></span>' +
            '</div>' +
            '</div>';
        });

        body.append(html);
      }

      if (respuesta.total_servicios != 0) {
        $(respuesta.servicios).each(function (key, value) {
          html = '<div class = "row">' +
            '<div class="col-sm-9">' +
            '<span><b>' +
            value.nombre +
            '</b></span>' +
            '</div>' +
            '<div class="col-sm-3 text-right">' +
            '<span>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</span>' +
            '</div>' +
            '</div>';
          body.append(html);
        });
      }


      if (respuesta.honorarios != 0) {
        html = '<br><div class = "row bg-gray" style="padding: 5px 0px 5px 0px">' +
          '<div class="col-sm-12">' +
          '<span class="black"><b>' +
          '<center><i class="fas fa-stethoscope"></i>' +
          ' Honorarios Médicos' +
          '</center>' +
          '</b></span>' +
          '</div>' +
          '</div>';

        body.append(html);

        $(respuesta.medicos).each(function (key, value) {
          html = '<div class = "row">' +
            '<div class="col-sm-9">' +
            '<span><b>' +
            value.nombre +
            '</b></span>' +
            '</div>' +
            '<div class="col-sm-3 text-right">' +
            '<span>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</span>' +
            '</div>' +
            '</div>';
          body.append(html);
        });
      }

      if (respuesta.tratamiento != 0) {
        html = '<br><div class = "row bg-gray" style="padding: 5px 0px 5px 0px">' +
          '<div class="col-sm-12">' +
          '<span class="black"><b>' +
          '<center><i class="fas fa-medkit"></i>' +
          ' Tratamiento' +
          '</center>' +
          '</b></span>' +
          '</div>' +
          '</div>';

        $(respuesta.medicina).each(function (key, value) {
          html += '<div class = "row">' +
            '<div class="col-sm-4">' +
            '<span>' +
            value.cantidad +
            '<small> ' + value.presentacion + '</small> ' +
            '</span>' +
            '</div>' +
            '<div class="col-sm-6">' +
            '<span>' +
            value.nombre +
            '</span>' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<span>' +
            '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(value.precio) +
            '</span>' +
            '</div>' +
            '</div>';
        });

        body.append(html);
      }

      html = '<br><div class = "row bg-gray" style="padding: 5px 0px 5px 0px">' +
        '<div class="col-sm-12">' +
        '<span class="black"><b>' +
        '<center><i class="far fa-money-bill-alt"></i>' +
        ' Impuestos' +
        '</center>' +
        '</b></span>' +
        '</div>' +
        '</div>';

      body.append(html);

      html = '<div class = "row">' +
        '<div class="col-sm-9">' +
        '<span><b>' +
        "IVA" +
        '</b></span>' +
        '</div>' +
        '<div class="col-sm-3 text-right">' +
        '<span>' +
        '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.iva) +
        '</span>' +
        '</div>' +
        '</div>';
      body.append(html);

      html = '<div class="col-sm-12"><div class="x_panel border border-success rounded" id="ingreso_body"></div></div>';

      $("#fila_main").append(html);

      var body = $("#ingreso_body");

      html = '<div class="flex-row">' +
        '<h4 class="text-success">' +
        '<center>' +
        '<i class="fa fa-arrow-up"></i>' + ' ' +
        "Ingresos" +
        '</center>' +
        '</h4>' +
        '</div>';

      body.append(html);

      html = '<div class = "row">' +
        '<div class="col-sm-9">' +
        '<span><b>' +
        'Abono' +
        '</b></span>' +
        '</div>' +
        '<div class="col-sm-3 text-right">' +
        '<span>' +
        '$ ' + new Intl.NumberFormat('mx-MX', { style: "decimal", minimumFractionDigits: 2 }).format(respuesta.abono) +
        '</span>' +
        '</div>' +
        '</div>';

      body.append(html);
    }
  });
}