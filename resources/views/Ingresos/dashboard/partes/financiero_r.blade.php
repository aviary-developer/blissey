<div class="row">
  <center>
    <h5 class="big-text">Estado Financiero</h5>
  </center>
</div>
<div class="row">
  <div class="col-xs-9">
    <canvas id = "chart_financiero" style="width: 100%;"></canvas>
  </div>
  <div class="col-xs-3">
    <div class="row">
      <center><i class="fa fa-calendar"></i> Días hospitalizado</center>
    </div>
    <div class="row bg-gray">
      <center>
        <span class="black big-text">{{($dias+1).(($dias > 1)?' días':' día')}}</span>
      </center>
    </div>
    <div class="row">
      <center><i class="fa fa-money"></i> Total de gastos</center>
    </div>
    <div class="row bg-gray">
      <center><span class="black big-text">
        {{'$ '.number_format($total_gastos,2,'.',',')}}
        </span></center>
    </div>
    <div class="row">
      <center><i class="fa fa-arrow-up green"></i> Total abonado</center>
    </div>
    <div class="row bg-green">
      <center><span class="big-text">
        {{'$ '.number_format($total_abono,2,'.',',')}}
        </span></center>
    </div>
    <div class="row">
      <center><i class="fa fa-arrow-down red"></i> Total de gastos</center>
    </div>
    <div class="row bg-danger">
      <center><span class="big-text">
        {{'$ '.number_format($total_deuda,2,'.',',')}}
        </span></center>
    </div>
  </div>
</div>