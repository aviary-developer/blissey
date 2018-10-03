{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
<div class="btn-group">
  <a href={!! asset('/productos/'.$producto->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
    <i class="fas fa-info-circle"></i>
  </a>
  <a href={!! asset('/productos/'.$producto->id.'/edit')!!} class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
    <i class="fas fa-edit"></i>
  </a>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Restaurar" onclick={!! "'alta(".$producto->id.");'" !!}/>
    <i class="fas fa-check"></i>
  </button>
  @php
    $cuenta=App\Transacion::foreanos($producto->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="No se puede eliminar">
      <i class="fas fa-exclamation-triangle"></i>
    </button>
  @else
  <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={!! "'eliminar(".$producto->id.");'" !!}/>
    <i class="fas fa-times"></i>
  </button>
</div>
@endif
@else
    @if (!$producto->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <div class="row">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li>
              <a href={!! asset('/productos'.$regreso)!!}><i class="fas fa2 fa-arrow-left"></i> Atras</a>
            </li>
            <li>
              <a href={!! asset('/productos/'.$producto->id.'/edit')!!}><i class="fas fa2 fa-edit"></i> Editar</a>
            </li>
              @if ($producto->estado)
                <li>
                  <a href="#" onclick={!! "'baja(".$producto->id.");'" !!}><i class="fas fa2 fa-trash"></i> Papelera</a>
                </li>
              @else
                <li>
                  <a href="#" onclick={!! "'alta(".$producto->id.");'" !!}><i class="fas fa2 fa-check"></i> Restaura</a>
                </li>
                <li>
                  <a href="#" onclick={!! "'eliminar(".$producto->id.");'" !!}><i class="fas fa2 fa-times"></i> Eliminar</a>
                </li>
              @endif
            <li>
              <a href="#"><i class="fas fa2 fa-question"></i> Ayuda</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
@endif
{!!Form::close()!!}
<script type="text/javascript">
function alta(id){
  return swal({
    title: 'Restaurar registro',
    text: '¿Está seguro? ¡El registro estará activo nuevamente!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Restaurar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateProducto/'+id);
      $('#formulario').submit();
    }
  });
}
function eliminar(id){
  return swal({
    title: 'Eliminar registro',
    text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Eliminar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyProducto/'+id);
      $('#formulario').submit();
    }
  });
}
</script>
