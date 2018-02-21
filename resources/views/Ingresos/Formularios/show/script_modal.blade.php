<script>
  function resumen(id, dia){
    var body = $("#cuerpo");
    $.ajax({
      url: "/blissey/public/total_resumen",
      type: "get",
      data: {
        id: id,
        dia: dia
      },
      success: function(respuesta){
        console.log(respuesta.total);
        body.empty();

        html = '<div class = "row">'+
          '<h3>'+
            '<center>'+
              '<i class = "fa fa-calendar"></i>'+" "+
              respuesta.fecha+
            '</center>'+
          '</h3>'+
        '</div>'+
        '<div class="ln_solid"></div>';

        body.append(html);

        html = "<div class='row'>"+
          '<div class="col-xs-6 tile_stats_count">'+
            '<span class="count_top">'+
              '<center>'+
                '<i class="fa fa-money red"></i> &nbsp;Total de gastos'+
              '</center>'+
            '</span>'+
            '<center>'+
              '<h2 class="count red">'+
                '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(respuesta.total)+
              '</h2>'+
            '</center>'+
          '</div>'+
          '<div class="col-xs-6 tile_stats_count">'+
            '<span class="count_top">'+
              '<center>'+
                '<i class="fa fa-money green"></i> &nbsp;Total abonado'+
              '</center>'+
            '</span>'+
            '<center>'+
              '<h2 class="count green">'+
                '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(respuesta.abono)+
              '</h2>'+
            '</center>'+
          '</div>'+
        "</div>";

        body.append(html);
        
        html = '<div class="row">'+
          '<h2>'+
            '<center>'+
              '<small class="red">'+
                '<i class="fa fa-arrow-down"></i>'+' '+
                "Gastos"+
              '</small>'+
            '</center>'+
          '</h2>'+
        '</div>';

        body.append(html);

        html = '<div class = "row">'+
          '<div class="col-xs-12">'+
            '<h4>'+
              '<center><i class="fa fa-hospital-o"></i>'+
                ' Servicios Hospitalarios'+
              '</center>'+
            '</h4>'+
          '</div>'+
        '</div>';

        body.append(html);

        html = '<div class = "row">'+
          '<div class="col-xs-1"></div>'+
          '<div class="col-xs-8">'+
            '<h4><b>'+
              'Habitación'+
            '</b></h4>'+
          '</div>'+
          '<div class="col-xs-2">'+
            '<h4 class="text-right">'+
              '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(respuesta.habitacion)+
            '</h4>'+
          '</div>'+
        '</div>';

        body.append(html);

        if(respuesta.laboratorio != 0){
          html = '<div class = "row">'+
            '<div class="col-xs-1"></div>'+
            '<div class="col-xs-8">'+
              '<h4><b>'+
                'Laboratorio'+
              '</b></h4>'+
            '</div>'+
            '<div class="col-xs-2">'+
              '<h4 class="text-right">'+
                '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(respuesta.laboratorio)+
              '</h4>'+
            '</div>'+
          '</div>';

          $(respuesta.examenes).each(function(key, value){
            html += '<div class = "row">'+
              '<div class="col-xs-2"></div>'+
              '<div class="col-xs-5">'+
                '<h5>'+
                  value.nombre+
                '</h5>'+
              '</div>'+
              '<div class="col-xs-2">'+
                '<h5 class="text-right">'+
                  '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(value.precio)+
                '</h5>'+
              '</div>'+
            '</div>';
          });

          body.append(html);
        }

        if(respuesta.honorarios != 0){
          html = '<div class = "row">'+
            '<div class="col-xs-12">'+
              '<h4>'+
                '<center><i class="fa fa-stethoscope"></i>'+
                  ' Honorarios Médicos'+
                '</center>'+
              '</h4>'+
            '</div>'+
          '</div>';

          body.append(html);

          html = '<div class = "row">'+
            '<div class="col-xs-1"></div>'+
            '<div class="col-xs-8">'+
              '<h4><b>'+
                respuesta.medico+
              '</b></h4>'+
            '</div>'+
            '<div class="col-xs-2">'+
              '<h4 class="text-right">'+
                '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(respuesta.honorarios)+
              '</h4>'+
            '</div>'+
          '</div>';

          body.append(html);
        }

        html = '<div class="row">'+
          '<h2>'+
            '<center>'+
              '<small class="green">'+
                '<i class="fa fa-arrow-up"></i>'+' '+
                "Ingresos"+
              '</small>'+
            '</center>'+
          '</h2>'+
        '</div>';

        body.append(html);

        html = '<div class = "row">'+
          '<div class="col-xs-1"></div>'+
          '<div class="col-xs-8">'+
            '<h4><b>'+
              'Abono'+
            '</b></h4>'+
          '</div>'+
          '<div class="col-xs-2">'+
            '<h4 class="text-right">'+
              '$ '+ new Intl.NumberFormat('mx-MX',{style:"decimal", minimumFractionDigits: 2}).format(respuesta.abono)+
            '</h4>'+
          '</div>'+
        '</div>';

        body.append(html);
      }
    });
  }
</script>