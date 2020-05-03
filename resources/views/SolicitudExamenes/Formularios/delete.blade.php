<input name="id" type="hidden" value={{$solicitud->id}}>
<input name="exa" type="hidden" value={{$solicitud->f_examen}}>
<center>
  <div class="btn-group">

    @if($solicitud->estado == 0)
      @if (Auth::user()->tipoUsuario == "Recepción")
        <button type="button" disabled="disabled" class="btn btn-sm btn-light" title="Pendiente">
          <i class="fas fa-hourglass-half"></i>
        </button>
      @else      
        <a id="activar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-success btn-sm" title="Aceptar"/>
          <i class="fa fa-check"></i>
        </a>
        <button id="eliminar" type="button" class="btn btn-danger btn-sm" title="Eliminar"/>
          <i class="fa fa-times"></i>
        </button>
      @endif
    @elseif($solicitud->estado == 1)
      @if (Auth::user()->tipoUsuario == "Recepción")
        <button type="button" disabled="disabled" class="btn btn-sm btn-warning" title="Evaluando...">
          <i class="fas fa-wrench"></i>
        </button>
      @else
        <a id="evaluar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-dark btn-sm" title="Evaluar"/>
          <i class="fa fa-paste"></i>
        </a>
        <button id="eliminar" type="button" class="btn btn-danger btn-sm" title="Eliminar"/>
          <i class="fa fa-times"></i>
        </button>
      @endif
    @else
      @if (Auth::user()->tipoUsuario != "Recepción")  
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
    @endif    
  </div>
</center>
