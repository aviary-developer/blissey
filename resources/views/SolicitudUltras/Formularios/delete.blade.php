<input name="id" type="hidden" value={{$solicitud->id}}>
<input name="exa" type="hidden" value={{$solicitud->f_ultrasonografia}}>
@if($solicitud->estado == 1)
  <a id="evaluar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_ultrasonografia)!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Evaluar"/>
    <i class="fa fa-paste"></i>
  </a>
@else
  <a id="evaluar" href= {!! asset('/editarExamen/'.$solicitud->id.'/'.$solicitud->f_ultrasonografia)!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Editar"/>
    <i class="fa fa-edit"></i>
  </a>
  <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_ultrasonografia)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar"/>
    <i class="fa fa-envelope"></i>
  </a>
@endif
