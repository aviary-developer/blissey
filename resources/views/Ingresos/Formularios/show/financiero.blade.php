<h3>Estado Financiero</h3>
<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
    <span class="count_top">
      <center>
        <i class="fa fa-calendar blue"></i> &nbsp;Días hospitalizado
      </center>
    </span>
    <center>
      <h2 class="count blue">
        {{$dias.(($dias > 1)?' días':' día')}}
      </h2>
    </center>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
    <span class="count_top">
      <center>
        <i class="fa fa-money"></i> &nbsp;Total de gastos
      </center>
    </span>
    <center>
      <h2 class="count black">
        {{'$ '.number_format($total_gastos,2,'.',',')}}
      </h2>
    </center>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
    <span class="count_top">
      <center>
        <i class="fa fa-arrow-up green"></i> &nbsp;Total abonado
      </center>
    </span>
    <center>
      <h2 class="count green">
        {{'$ '.number_format($total_abono,2,'.',',')}}
      </h2>
    </center>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
    <span class="count_top">
      <center>
        <i class="fa fa-arrow-down red"></i> &nbsp;Total a cancelar
      </center>
    </span>
    <center>
      <h2 class="count red">
        {{'$ '.number_format($total_deuda,2,'.',',')}}
      </h2>
    </center>
  </div>
</div>
<br>
<div>
  @for ($i = 0; $i <= $dias; $i++)
    <div class="row x_panel">
      <div class="row">
        <div class="col-xs-9">
          <h4>
            <span class="fa fa-calendar"></span>{{$ingreso->fecha_ingreso->addDays($i)->format(' d / m / Y')}}
          </h4>
        </div>
        <div class="col-xs-2 alignright">
          <button type="button" name="button" class="btn btn-dark btn-xs alignright" data-toggle="modal" data-target="#modal_financiero" onClick={{"resumen(".$ingreso->id.",".$i.");"}}>
            <i class="fa fa-list"></i> Detalle
          </button>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <center>
            <h4 class="red">Gastos</h4>
          </center>
          <table class="table">
            <tr>
              <th>Servicios Hospitalarios</th>
              @php
                $total = $servicio = $ingreso->servicio_gastos($ingreso->id,$i);
                $total += $tratamiento = 0;
                if($i == 0){
                  $total += $honorarios = 50;
                }
                $abono = 0;
              @endphp
              <td class="text-right">{{"$ ".number_format($servicio,2,'.',',')}}</td>
            </tr>
            <tr>
              <th>Tratamiento</th>
              <td class="text-right">{{"$ ".number_format($tratamiento,2,'.',',')}}</td>
            </tr>
            @if ($i==0)
              <tr>
                <th>Honorarios Médicos</th>
                <td class="text-right">{{"$ ".number_format($honorarios,2,'.',',')}}</td>
              </tr>
            @endif
            <tr>
              <th>Total</th>
              <td class="text-right">
                <span class="label label-lg col-xs-12 label-danger text-right">
                  {{"$ ".number_format($total,2,'.',',')}}
                </span>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-sm-6 col-xs-12">
          <center>
            <h4 class="green">Ingresos</h4>
          </center>
          <table class="table">
            <tr>
              <th style="width: 180px">Abono</th>
              <td>
                <span class="label label-lg label-success col-xs-12">
                  {{"$ ".number_format($abono,2,'.',',')}}
                </span>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  @endfor
</div>
@include('Ingresos.Formularios.show.modal_financiero')

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
        html = "<div class='row'>"+
          '<div class="col-xs-6 tile_stats_count">'+
            '<span class="count_top">'+
              '<center>'+
                '<i class="fa fa-money"></i> &nbsp;Total de gastos'+
              '</center>'+
            '</span>'+
            '<center>'+
              '<h2 class="count black">'+
                respuesta.total+
              '</h2>'+
            '</center>'+
          '</div>'+
        "</div>";

        body.append(html);
      }
    });
  }
</script>