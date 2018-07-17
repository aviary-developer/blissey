<div class="row">
  <div class="col-xs-8">
    <h5 class="big-text">Servicios</h5>
  </div>
  <div class="col-xs-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#servicios_m" onclick="cambioRadio(3)"><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_servicios" id="btn_v_s"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($count_s24 > 0)    
  <div class="row" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
    <table class="table-basic">
      <thead>
        <tr>
          <th>Detalle</th>
          <th style="width: 50px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detalle_s as $detalle)
          @if ($detalle->created_at->between($ultima24,$ultima48))
            <tr>
              <td>
                <small>
                  {{$detalle->cantidad.' '}}
                </small>
                &nbsp;
                <b class="big-text">
                  {{$detalle->servicio->nombre}}
                </b>
              </td>
              <td>
                <center>
                   @if ($ingreso->estado == 2)
                    <button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-ban"></i></button>
                  @else
                    <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={{"accion24(0,".$detalle->id.")"}}><i class="fa fa-remove" ></i></button>
                  @endif
                </center>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <div class="row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningun servicio al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.servicios')
@include('Ingresos.dashboard.modales.ver_servicios')