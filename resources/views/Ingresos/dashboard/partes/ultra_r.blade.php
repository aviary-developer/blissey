<div class="row">
  <div class="col-sm-8">
    <h5 class="text-purple">Ultrasonografías</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ultras_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_ultra" id="btn_v_u"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($count_u24 > 0)    
  <div class="flex-row" style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
    <table class="table-basic">
      <thead>
        <tr>
          <th>Detalle</th>
          <th style="width: 50px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach($detalle_u as $solicitud)
          @if ($solicitud->ultrasonografia != null)
            @if($solicitud->created_at->between($ultima24, $ultima48))
              <tr>
                <td>
                  <b class="">{{$solicitud->ultrasonografia->nombre}}</b></td>
                <td>
                  @if ($solicitud->estado == 0)
                    <span class="badge badge-light col-sm-10" title="Pendiente"><i class="fa fa-spinner"></i></span>
                  @elseif($solicitud->estado == 1)
                    <span class="badge badge-primary col-sm-10" title="Evaluando"><i class="fa fa-cog"></i></span>
                  @else
                    <span class="badge badge-success col-sm-10" title="Listo"><i class="fa fa-check"></i></span>
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
  <div class="flex-row" style="height: 184px; padding: 20px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ninguna ultrasonografía al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.ultras')
@include('Ingresos.dashboard.modales.ver_ultras')