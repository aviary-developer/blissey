{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
<div class="btn-group">
  <a href={!! asset('/proveedores/'.$proveedor->id)!!} class="btn btn-sm btn-info" title="Ver">
    <i class="fas fa-info-circle"></i>
  </a>
  <a href={!! asset('/proveedores/'.$proveedor->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
    <i class="fas fa-edit"></i>
  </a>
  <a href={!! asset('/visitadores?id='.$proveedor->id)!!} class="btn btn-sm btn-dark" title="Visitadores">
    <i class="fas fa-users"></i>
  </a>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-success btn-sm" onclick={!! "'alta(".$proveedor->id.");'" !!} title="Restaurar"/>
    <i class="fas fa-check"></i>
  </button>
  @php
    $cuenta=App\Proveedor::foraneos($proveedor->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled" title="No se puede eliminar">
      <i class="fas fa-ban"></i>
    </button>
  @else
    <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$proveedor->id.");'" !!} title="Eliminar"/>
      <i class="fas fa-times"></i>
    </button>
  @endif
</div>
@else
<div class="btn-group">
    @if (!$proveedor->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <a href={!! asset('/proveedores'.$regreso)!!} class="btn btn-dark btn-sm">
      <i class="fas fa-arrow-left"></i> Atras
    </a>
    <a href={!! asset('/proveedores/'.$proveedor->id.'/edit')!!} class="btn btn-dark btn-sm">
      <i class="fas fa-edit"></i> Editar
    </a>
    @if ($proveedor->estado)
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'baja(".$proveedor->id.");'" !!}>
        <i class="fas fa-trash"></i> Papelera
      </button>
    @else
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'alta(".$proveedor->id.");'" !!}/>
        <i class="fas fa-check"></i> Restaurar
      </button>
      <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$proveedor->id.");'" !!}/>
        <i class="fas fa-remove"></i> Eliminar
      </button>
    @endif
    <a href={!! asset('#')!!} class="btn btn-primary btn-sm">
      <i class="fas fa-question"></i> Ayuda
    </a>
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
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','activateProveedor/'+id);
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
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      var dominio = window.location.host;
      $('#formulario').attr('action','destroyProveedor/'+id);
      $('#formulario').submit();
    }
  });
}
</script>
