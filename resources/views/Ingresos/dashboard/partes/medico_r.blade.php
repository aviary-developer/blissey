<div class="row">
  <div class="col-sm-8">
    <h5 class="text-info">Médicos</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#medico_m" ><i class="fa fa-plus"></i></button>
      @endif
    </div>
  </div>
</div>
@if ($count_m > 0)    
  <div style="overflow-x:hidden; overflow-y:scroll; height: 184px;">
    <table class="table-basic">
      <thead>
        <th colspan="2">Detalle</th>
        <th style="width: 50px">Frec.</th>
      </thead>
      <tbody>
        @foreach ($medico_u as $medico)
          <tr>
            <td>
              <a href="#" data-toggle="modal" data-target="#ver_medico" onclick={{'ver_medico('.$medico['id'].')'}}>
                <img src={{asset(Storage::url($medico['foto']))}} class="img-square-mini borde gray" style="margin-top: 0px;"></td>
              </a>
            <td>{{$medico['nombre']}}</td>
            <td>
              <span class="badge badge-info badge-pill"><i>
                {{'x'.$medico['frec']}}</td>
              </i></span>
          </tr>
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
      <span>No se ha registrado ningún médico al paciente al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.medico')
@include('Ingresos.dashboard.modales.ver_medico')