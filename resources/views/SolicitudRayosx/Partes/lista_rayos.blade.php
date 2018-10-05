<div id="accordion">
  @foreach ($examenes as $k => $examen)
      
    <div class="card">
      <div class="card-header p-0" id={{"heading".$k}}>
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}}>
            
            {{$examen->rayox->nombre}}
            
          </button>
        </h5>
      </div>

      <div id={{"collapse".$k}} class="collapse" aria-labelledby={{"heading".$k}} data-parent="#accordion">
        <div class="card-body">
          
          <table class="table table-hover table-striped table-sm">
            <thead>
              <th>Fecha</th>
              <th>Paciente</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              @foreach($solicitudes as $solicitud)
                @if($solicitud->f_rayox == $examen->f_rayox)
                  <tr>
                    <td>{{$solicitud->created_at->format('d/m/y')}}</td>
                    <td>
                      {{$solicitud->nombrePaciente($solicitud->f_paciente)}}
                    </td>
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