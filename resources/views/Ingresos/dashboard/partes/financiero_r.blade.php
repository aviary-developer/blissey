<div class="row">
  <div class="col-xs-8">
    <h5 class="big-text">Estado Financiero</h5>
  </div>
  <div class="col-xs-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-success" id="nuevo_abono"><i class="fa fa-money"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#informe_fin"><i class="fa fa-file"></i></button>
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_finanzas" id="btn_v_f"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <canvas id = "chart_financiero" style="width: 100%;"></canvas>
  </div>
</div>
<div class="row">
  <div class="col-xs-3">
    <div class="row">
      <center><i class="fa fa-calendar"></i> Días hospitalizado</center>
    </div>
    <div class="row bg-gray">
      <center>
        <span class="black big-text">{{($dias+1).(($dias > 1)?' días':' día')}}</span>
      </center>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="row">
      <center><i class="fa fa-money"></i> Total de gastos</center>
    </div>
    <div class="row bg-gray">
      <center><span class="black big-text">
        {{'$ '.number_format($total_gastos,2,'.',',')}}
        </span></center>
    </div>
  </div>
  <div class="col-xs-3">  
    <div class="row">
      <center><i class="fa fa-arrow-up green"></i> Total abonado</center>
    </div>
    <div class="row bg-green">
      <center><span class="big-text">
        {{'$ '.number_format($total_abono,2,'.',',')}}
        </span></center>
    </div>
  </div>
  <div class="col-xs-3">    
    <div class="row">
      <center><i class="fa fa-arrow-down red"></i> Total a pagar</center>
    </div>
    <div class="row bg-danger">
      <center><span class="big-text">
        {{'$ '.number_format($total_deuda,2,'.',',')}}
        </span></center>
    </div>
  </div>
</div>
@include('Ingresos.dashboard.modales.ver_finanzas')
@include('Ingresos.dashboard.modales.informe_fin')