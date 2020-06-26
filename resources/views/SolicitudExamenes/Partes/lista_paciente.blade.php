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
              <th>Muestra</th>
              <th>Fecha</th>
              <th>Evaluación</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              @foreach($solicitudes as $solicitud)
                @if($solicitud->f_paciente == $paciente->f_paciente)
                @if(isset($bacteriologia))
                @if ($solicitud->completo==false)
                <tr class="table-danger" title="No está completamente evaluado">
                @else
                <tr>  
                @endif
              @else
                <tr>
              @endif
                    @php
                      $muestraNoQs= explode(" ", $solicitud->codigo_muestra." siQS");
                  @endphp
                  <td>{{$muestraNoQs[0]}}</td>
                    <td>{{$solicitud->created_at->format('d/m/y')}}
                    <td>{{$solicitud->nombreExamen($solicitud->f_examen)}}
                      @if ($solicitud->enviarClinica==1)
                      <span class="badge badge-pill badge-pink" title="Debe enviarse a clínica">
                          <i class="fa fa-ambulance"></i>
                          </span>
                    @endif
                    @if ($solicitud->paraTac==1)
                    <span class="badge badge-pill badge-info" title="Exámen para TAC">
                        <i class="fa fa-desktop"></i>
                        </span>
                  @endif
                </td>
                    <td id="celda">
                      @include('SolicitudExamenes.Formularios.delete')
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