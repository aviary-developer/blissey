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
                    <td>{{$solicitud->ultrasonografia->nombre}}</td>
                    <td>
                      <center>
												<div class="btn-group">
													@if (Auth::user()->tipoUsuario == "Ultrasonografía")
														<a id="editar" href= {!! asset('/solicitudex/'.$solicitud->id.'/edit')!!} class="btn btn-dark btn-sm" title="Editar"/>
															<i class="fa fa-edit"></i>
														</a>
													@endif
                          <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_ultrasonografia.'/ultras')!!} class="btn btn-primary btn-sm" title="Entregar" target="_blank"/>
                            <i class="fa fa-envelope"></i>
                          </a>
                        </div>
                      </center>
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