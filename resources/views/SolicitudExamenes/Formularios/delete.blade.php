<input name="id" type="hidden" value={{$solicitud->id}}>
@if($solicitud->estado == 0)
  <button id="activar" type="button" class="btn btn-success btn-xs"  data-toggle="tooltip" data-placement="top" title="Aceptar"/>
    <i class="fa fa-check"></i>
  </button>  
  <button id="eliminar" type="button" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Eliminar"/>
    <i class="fa fa-remove"></i>
  </button> 
@elseif($solicitud->estado == 1)
  <button id="evaluar" type="button" class="btn btn-dark btn-xs"  data-toggle="tooltip" data-placement="top" title="Evaluar"/>
    <i class="fa fa-paste"></i>
  </button> 
@else
  <button id="entregar" type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="top" title="Entregar"/>
    <i class="fa fa-envelope"></i>
  </button> 
@endif