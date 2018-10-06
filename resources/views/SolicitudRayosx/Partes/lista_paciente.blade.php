<div id="accordion">
  @foreach ($pacientes as $k => $paciente)
      
    <div class="card">
      <div class="card-header p-0" id={{"heading".$k}}>
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}}>
            
            {{$paciente->nombrePaciente($paciente->f_paciente)}}
            
          </button>
        </h5>
      </div>

      <div id={{"collapse".$k}} class="collapse" aria-labelledby={{"heading".$k}} data-parent="#accordion">
        <div class="card-body">
          
          <table class="table table-hover table-striped table-sm">
            <thead>
              <th>Fecha</th>
              <th>Evaluación</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              @foreach($solicitudes as $solicitud)
                @if($solicitud->f_paciente == $paciente->f_paciente)
                  <tr>
                    <td>{{$solicitud->created_at->format('d/m/y')}}
                    <td>{{$solicitud->rayox->nombre}}</td>
                    <td id="celda">
                      @include('SolicitudRayosx.Formularios.delete')
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  @endforeach
</div>