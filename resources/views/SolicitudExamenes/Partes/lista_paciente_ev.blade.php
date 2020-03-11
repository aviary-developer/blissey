<div id="accordion">
  @foreach ($pacientes as $k => $paciente)
      
    <div class="card">
      <div class="card-header p-0" id={{"heading".$k}}>
        <h5 class="mb-0 w-100">
          <button class="btn btn-link" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}}>
            
            {{$paciente->nombrePaciente($paciente->f_paciente)}}
            
          </button>
          {{-- <button class="btn btn-link float-right" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}} onclick={!! "'imprimirExaEvaPacie(".$solicitudes.",".$paciente->f_paciente.");'" !!}>
            
            <i class="fas fa-print"></i>
            
          </button> --}}
        </h5>
      </div>

      <div id={{"collapse".$k}} class="collapse" aria-labelledby={{"heading".$k}} data-parent="#accordion">
        <div class="card-body">
          <table class="table table-hover table-sm table-striped">
            <thead>
              <th>Código</th>
              <th>Fecha</th>
              <th>Examen</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              @foreach($solicitudes as $solicitud)
                @if($solicitud->f_paciente == $paciente->f_paciente)
                  <tr>
                    <td>{{$solicitud->codigo_muestra}}</td>
                    <td>{{$solicitud->created_at->format('d/m/y')}}</td>
                    <td>{{$solicitud->examen->nombreExamen}}</td>
                    <td>
                      <center>
												<div class="btn-group">
                        	@if (Auth::user()->tipoUsuario == "Laboaratorio")
														<a id="evaluar" href= {!! asset('/editarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-dark btn-sm" title="Editar"/>
															<i class="fa fa-edit"></i>
														</a>
													@endif
                          <a id="" href= {!! asset('/verExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-success btn-sm" title="Ver"/>
                            <i class="fa fa-eye"></i>
                          </a>
                          <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_examen.'/examenes')!!} class="btn btn-primary btn-sm" title="Entregar" target="_blank"/>
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