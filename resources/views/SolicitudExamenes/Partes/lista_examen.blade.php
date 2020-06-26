<div id="accordion">
  @foreach ($examenes as $k => $examen)
  @php
      $examenIndividual=App\Examen::find($examen->f_examen);
  @endphp
  @if ($examenIndividual->area=='QUIMICA SANGUINEA')
  <div class="card">
    <div class="card-header p-0" id={{"heading".$k}}>
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}}>
          
        {{$examen->nombreExamen($examen->f_examen)}}
          
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
              @if($solicitud->f_examen == $examen->f_examen)
                <tr>
                  @php
                      $muestraNoQs= explode(" ", $solicitud->codigo_muestra." siQS");
                  @endphp
                  <td>{{$muestraNoQs[0]}}</td>
                  <td>{{$solicitud->created_at->format('d/m/y')}}</td>
                  <td>
                    {{$solicitud->nombrePaciente($solicitud->f_paciente)}}
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
  @else
    <div class="card">
      <div class="card-header p-0" id={{"heading".$k}}>
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}}>
            
            {{$examen->nombreExamen($examen->f_examen)}}
            
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
                @if($solicitud->f_examen == $examen->f_examen)
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
                    <td>{{$solicitud->created_at->format('d/m/y')}}</td>
                    <td>
                      {{$solicitud->nombrePaciente($solicitud->f_paciente)}}
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
    @endif
  @endforeach
</div>