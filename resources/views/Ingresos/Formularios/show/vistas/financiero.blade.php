<div class="row">
  <div class="col-xs-7">
    <h3>Estado Financiero</h3>
  </div>
  <div class="col-xs-4 alignright">
    <div class="btn-group alignright">
      <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modal_informe">
        <i class="fa fa-file"></i> Informe
      </button>
      @if ($ingreso->estado != 2)    
        <button type="button" class="btn btn-primary btn-sm" id="nuevo_abono">
          <i class="fa fa-plus"></i> Abono
        </button>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
    <span class="count_top">
      <center>
        <i class="fa fa-calendar blue"></i> &nbsp;Días hospitalizado
      </center>
    </span>
    <center>
      <h2 class="count blue">
        {{($dias+1).(($dias > 1)?' días':' día')}}
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
    <span class="count_bottom">
      <center>
        IVA incluido
      </center>
    </span>
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
  <div role="tabpanel">
    <div class="col-xs-2">
      <ul id="tab_dia" class="nav nav-tabs tabs-left" role="tablist">
        @for ($i = 0; $i <= $dias; $i++)
          @if ($i==0)
            <li role="presentation" class="active">
              <a href={{"#dia".$i}} id={{"tab_dia_".$i}} role="tab" data-toggle="tab" aria-expanded="true">{{"Día ".($i+1)}}</a>
            </li>
          @else
            <li role="presentation">
              <a href={{"#dia".$i}} id={{"tab_dia_".$i}} role="tab" data-toggle="tab" aria-expanded="true">{{"Día ".($i+1)}}</a>
            </li>
          @endif
        @endfor
      </ul>
    </div>
    <div class="col-xs-10">
      <div id="tab_diaContent" class="tab-content">
        @for ($i = 0; $i <= $dias; $i++)
          @if ($i==0)
            <div role="tabpanel" class="tab-pane fade active in" id={{"dia".$i}} aria-labelledby={{"tab_dia_".$i}}>
          @else
            <div role="tabpanel" class="tab-pane fade" id={{"dia".$i}} aria-labelledby={{"tab_dia_".$i}}>
          @endif
            <div class="row x_panel">
              <div class="row bg-blue">
                <div class="col-xs-9">
                  <h4>
                    <span class="fa fa-calendar"></span>{{$ingreso->fecha_ingreso->addDays($i)->formatLocalized(' %d de %B de %Y')}}
                  </h4>
                </div>
                <div class="col-xs-2 alignright">
                  <button type="button" name="button" class="btn btn-light blue btn-xs alignright" data-toggle="modal" data-target="#modal_financiero" onClick={{"resumen(".$ingreso->id.",".$i.");"}} style="margin-top: 7px;">
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
                        $total += $tratamiento = $ingreso->tratamiento_gastos($ingreso->id, $i);
                        $total += $honorarios = $ingreso->honorario_gastos($ingreso->id, $i);
                        $abono = $ingreso->abonos($ingreso->id,$i);
                      @endphp
                      <td class="text-right">{{"$ ".number_format($servicio,2,'.',',')}}</td>
                    </tr>
                    <tr>
                      <th>Tratamiento</th>
                      <td class="text-right">{{"$ ".number_format($tratamiento,2,'.',',')}}</td>
                    </tr>
                    <tr>
                      <th>Honorarios Médicos</th>
                      <td class="text-right">{{"$ ".number_format($honorarios,2,'.',',')}}</td>
                    </tr>
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
          </div>
        @endfor
      </div>
    </div>
  </div>
</div>
@include('Ingresos.Formularios.show.modal.modal_financiero')
@include('Ingresos.Formularios.show.modal.script_modal')