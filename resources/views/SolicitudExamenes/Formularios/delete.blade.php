<input name="id" type="hidden" value={{$solicitud->id}}>
<input name="exa" type="hidden" value={{$solicitud->f_examen}}>
@if($solicitud->estado == 0)
  <a id="activar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-success btn-sm"  data-toggle="tooltip" data-placement="top" title="Aceptar"/>
    <i class="fa fa-check"></i>
  </a>
  <button id="eliminar" type="button" class="btn btn-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Eliminar"/>
    <i class="fa fa-remove"></i>
  </button>
@elseif($solicitud->estado == 1)
  <a id="evaluar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Evaluar"/>
    <i class="fa fa-paste"></i>
  </a>
@else
  <a id="evaluar" href= {!! asset('/editarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Editar"/>
    <i class="fa fa-edit"></i>
  </a>
  <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar" target="_blank"/>
    <i class="fa fa-envelope"></i>
  </a>
@endif
