<input type="text" class="form-control form-control-sm" name="buscadorExamen" id="buscadorExamen" placeholder="Buscar paciente..." onkeyup="buscarEntregado(this);" autofocus>
<div id="accordion">
  @foreach ($pacientes as $k => $paciente)
      
    <div class="card" id="cartas">
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
                    <td>
                      <center>
                        <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_rayox.'/rayosx')!!} class="btn btn-primary btn-sm" title="Entregar" target="_blank"/>
                          <i class="fa fa-envelope"></i>
                        </a>
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