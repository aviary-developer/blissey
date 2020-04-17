<input type="text" class="form-control form-control-sm" name="buscadorExamen" id="buscadorExamen" placeholder="Buscar paciente..." onkeyup="buscarEntregado(this);" autofocus>
<div id="accordion">
  @foreach ($pacientes as $k => $paciente)
      
    <div class="card" id="cartas">
      <div class="card-header p-0" id={{"heading".$k}}>
        <h5 class="mb-0 w-100">
          <button class="btn btn-link" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}}>
            {{$paciente->nombrePaciente($paciente->f_paciente)}}
          </button>
          {{--<button class="btn btn-link float-right" data-toggle="collapse" data-target={{"#collapse".$k}} aria-expanded="true" aria-controls={{"collapse".$k}} onclick={!! "'imprimirExaEvaPacie(".$solicitudes.",".$paciente->f_paciente.");'" !!}>
            
            <i class="fas fa-print"></i>
            
          </button>--}}
        </h5>
      </div>

      <div id={{"collapse".$k}} class="collapse" aria-labelledby={{"heading".$k}} data-parent="#accordion">
        <div class="card-body">
          <table class="table table-hover table-sm table-striped">
            <thead>
              <th>Muestra</th>
              <th>Fecha</th>
              <th>Examen</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              @foreach($solicitudes as $solicitud)
                @if($solicitud->f_paciente == $paciente->f_paciente)
                  <tr>
                    @php
                      $muestraNoQs= explode(" ", $solicitud->codigo_muestra." siQS");
                  @endphp
                  <td>{{$muestraNoQs[0]}}</td>
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
                          <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_examen.'/examenes')!!} class="btn btn-primary btn-sm" title="Imprimir" target="_blank"/>
                            <i class="fa fa-print"></i>
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
<script>
  function buscarEntregado(texto){
    console.clear();
    $("#cartas div h5 button").each(function(){
      let cadena=$(this).text().trim();
      let posicion = cadena.toLowerCase().indexOf(texto.value.toLowerCase());
      if (posicion !== -1){
          $(this).parents("#cartas").attr( "style", "display: block !important;" );
      }else{
          $(this).parents("#cartas").attr( "style", "display: none !important;" );
    }
    });
  }
</script>