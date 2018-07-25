<div class="row">
  <div class="col-xs-8">
    <h5 class="big-text">Médicos</h5>
  </div>
  <div class="col-xs-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#medico_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_laboratorio" id="btn_v_l"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($count_m24 > 0)    
  <div style="overflow-x:scroll; overflow-y:hidden; height: 184px;">
    <table>
      <tr>
        @foreach($detalle_m as $detalle)
          <td style="width: 125px; margin-right:5px;">
            <div>
              <img src={{asset(Storage::url($detalle->servicio->medico->foto))}} class="img-circle perfil-2 borde" style="margin-top: 0px;">
            </div>
            <center>
              <span>{{(($detalle->servicio->medico->sexo)?"Dr. ":"Dra. ").$detalle->servicio->medico->nombre.' '.$detalle->servicio->medico->apellido}}</span>
            </center>
          </td>
        @endforeach
        </tr>
    </table>
  </div>
@else
  <div class="row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningun médico al paciente al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.medico')
@include('Ingresos.dashboard.modales.ver_laboratorio')