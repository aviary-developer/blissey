<div class="row">
  <div class="col-sm-8">
    <h5 class="text-success">Estado Financiero</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-success" id="nuevo_abono" title="Nuevo Abono"><i class="far fa-money-bill-alt"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#informe_fin" title="Informe financiero"><i class="fa fa-file"></i></button>
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_finanzas" id="btn_v_f" title="Ver"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <canvas id = "chart_financiero" style="width: 100%;"></canvas>
  </div>
</div>
<div class="row">
  <div class="col-sm-3">
    <div class="flex-row text-monospace">
      <center><i class="far fa-calendar"></i> Días hospitalizado</center>
    </div>
    <div class="flex-row">
      <span class="badge badge-secondary col-12 font-sm">{{($dias+1).(($dias > 1)?' días':' día')}}</span>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="flex-row text-monospace">
      <center><i class="far fa-money-bill-alt"></i> Total de gastos</center>
    </div>
    <div class="flex-row">
      <center><span class="badge badge-secondary col-12 font-sm">
        {{'$ '.number_format($total_gastos,2,'.',',')}}
        </span></center>
    </div>
  </div>
  <div class="col-sm-3">  
    <div class="flex-row text-monospace">
      <center><i class="fa fa-arrow-up text-success"></i> Total abonado</center>
    </div>
    <div class="flex-row">
      <center><span class="badge badge-success font-sm col-12">
        {{'$ '.number_format($total_abono,2,'.',',')}}
        </span></center>
    </div>
  </div>
  <div class="col-sm-3">    
    <div class="flex-row text-monospace">
      <center><i class="fa fa-arrow-down text-danger"></i> Total a pagar</center>
    </div>
    <div class="flex-row">
      <center><span class="badge badge-danger font-sm col-12">
        {{'$ '.number_format($total_deuda,2,'.',',')}}
        </span></center>
    </div>
  </div>
</div>
@include('Ingresos.dashboard.modales.ver_finanzas')
@include('Ingresos.dashboard.modales.informe_fin')