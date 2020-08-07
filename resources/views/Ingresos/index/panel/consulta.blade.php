<div class="flex-row">
  <div class="col-sm-8">
    <h5 class="text-pink">Consulta Médica</h5>
  </div>
  <div class="col-sm-4">
    @if (Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería")
      <div class="btn-group alignright">
        <button type="button" class="btn btn-sm btn-success alignright" data-toggle="modal" data-target="#n_ingreso" onclick={{'i_activo(0,3)'}}><i class="fa fa-plus"></i></button>
      </div>
    @endif
  </div>
</div>
<div class="clearfix"></div>
<div class="flex-row border border-pink mb-1 mt-1"></div>
@if ($cola_consulta->count() > 0)
  <div class="flex-row">
    <table class="table table-hover table-striped table-sm">
      <thead>
        <th>Paciente</th>
        <th>Opción</th>
      </thead>
      <tbody>
        @foreach ($cola_consulta as $consulta)
          <tr>
            <td>
              {{$consulta->hospitalizacion->paciente->nombre.' '.$consulta->hospitalizacion->paciente->apellido}}
            </td>
            <td>
              <center>
                <a href={!! asset('/ingresos/'.$consulta->id)!!} class="btn btn-sm btn-info" title="Ver">
                  <i class="fas fa-info-circle"></i>
                </a>
              </center>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <div class="flex-row" style="height: 70px;">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No hay ningún paciente en cola para consulta médica</span>
    </center>
  </div>  
@endif