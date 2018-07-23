<div class="row">
  <div class="col-xs-8">
    <h5 class="big-text">Rayos X</h5>
  </div>
  <div class="col-xs-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#rayosx_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_rayosx" id="btn_v_r"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($count_r24 > 0)    
  <div class="row" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
    <table class="table-basic">
      <thead>
        <tr>
          <th>Detalle</th>
          <th style="width: 50px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach($detalle_r as $solicitud)
          @if ($solicitud->rayox != null)
            @if($solicitud->created_at->between($ultima24, $ultima48))
              <tr>
                <td>
                  <b class="big-text">{{$solicitud->rayox->nombre}}</b></td>
                <td>
                  @if ($solicitud->estado == 0)
                    <span class="label label-lg label-default col-xs-10" data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="fa fa-spinner"></i></span>
                  @elseif($solicitud->estado == 1)
                    <span class="label label-lg label-primary col-xs-10" data-toggle="tooltip" data-placement="top" title="Evaluando"><i class="fa fa-cog"></i></span>
                  @else
                    <span class="label label-lg label-success col-xs-10" data-toggle="tooltip" data-placement="top" title="Listo"><i class="fa fa-check"></i></span>
                  @endif
                </td>
              </tr>
            @endif
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
      <span>No se ha registrado ningun examen de rayos X al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.rayosx')
@include('Ingresos.dashboard.modales.ver_rayox')