<div class="row">
  <div class="col-xs-9">
    <h3>Laboratorio Clínico	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)    
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_examen">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
<br>
@if ($ingreso->transaccion->solicitud!=null)
  <div class="row">
    
    <div class="col-xs-12">

      <table class="table">
        <thead>
          <th style="width: 50px">#</th>
          <th style="width: 120px">Fecha</th>
          <th style="width: 110px">Muestra</th>
          <th>Examen</th>
          <th style="width: 110px">Estado</th>
        </thead>
        <tbody>
          @foreach ($ingreso->transaccion->solicitud as $k => $solicitud)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{$solicitud->created_at->format('d / m / Y')}}</td>
              <td>{{$solicitud->codigo_muestra}}</td>
              <td>{{$solicitud->examen->nombreExamen}}</td>
              <td>
                @if ($solicitud->estado == 0)
                  <span class="label label-lg label-default col-xs-10">Pendiente</span>
                @elseif($solicitud->estado == 1)
                  <span class="label label-lg label-warning col-xs-10">Evaluando</span>
                @else
                  <span class="label label-lg label-success col-xs-10">Listo</span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@else
  <div class="row">
    <p>No hay exámenes seleccionados para este paciente</p>
  </div>
@endif