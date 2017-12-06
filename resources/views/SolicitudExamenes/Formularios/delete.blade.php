<input name="id" type="hidden" value={{$solicitud->id}}>
@if($solicitud->estado == 0)
  <a id="activar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-success btn-xs"  data-toggle="tooltip" data-placement="top" title="Aceptar"/>
    <i class="fa fa-check"></i>
  </a>
  <button id="eliminar" type="button" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Eliminar"/>
    <i class="fa fa-remove"></i>
  </button>
@elseif($solicitud->estado == 1)
  <a id="evaluar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-dark btn-xs"  data-toggle="tooltip" data-placement="top" title="Evaluar"/>
    <i class="fa fa-paste"></i>
  </a>
@else
  <button id="entregar" type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="top" title="Entregar"/>
    <i class="fa fa-envelope"></i>
  </button>
@endif
