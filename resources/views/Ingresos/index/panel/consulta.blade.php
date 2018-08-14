<div class="row">
  <div class="col-xs-8">
    <h4>Consulta Médica</h4>
  </div>
  <div class="col-xs-4">
    <div class="btn-group alignright">
      <button type="button" class="btn btn-sm btn-success alignright" data-toggle="modal" data-target="#n_ingreso" onclick={{'i_activo(0,3)'}}><i class="fa fa-plus"></i></button>
    </div>
  </div>
</div>
@if ($cola_consulta->count() > 0)
  <div class="row">
    <table class="table">
      <thead>
        <th>Paciente</th>
        <th>Acción</th>
      </thead>
      <tbody>
        @foreach ($cola_consulta as $consulta)
          <tr>
            <td>
              {{$consulta->paciente->nombre.' '.$consulta->paciente->apellido}}
            </td>
            <td>
              <a href={!! asset('/ingresos/'.$consulta->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
                <i class="fa fa-info-circle"></i>
              </a>
            </td>
          </tr>
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
      <span>No hay ningun paciente en cola para consulta médica</span>
    </center>
  </div>  
@endif