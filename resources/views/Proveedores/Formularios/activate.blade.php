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
    <i class="fa fa-users"></i>
  </a>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-success btn-sm" onclick={!! "'alta(".$proveedor->id.");'" !!} title="Restaurar"/>
    <i class="fas fa-check"></i>
  </button>
  @php
    $cuenta=App\Proveedor::foreanos($proveedor->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled" title="No se puede eliminar">
      <i class="fas fa-exclamation-triangle"></i>
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
      <i class="fa fa-arrow-left"></i> Atras
    </a>
    <a href={!! asset('/proveedores/'.$proveedor->id.'/edit')!!} class="btn btn-dark btn-sm">
      <i class="fa fa-edit"></i> Editar
    </a>
    @if ($proveedor->estado)
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'baja(".$proveedor->id.");'" !!}>
        <i class="fa fa-trash"></i> Papelera
      </button>
    @else
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'alta(".$proveedor->id.");'" !!}/>
        <i class="fa fa-check"></i> Restaurar
      </button>
      <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$proveedor->id.");'" !!}/>
        <i class="fa fa-remove"></i> Eliminar
      </button>
    @endif
    <a href={!! asset('#')!!} class="btn btn-primary btn-sm">
      <i class="fa fa-question"></i> Ayuda
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
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateProveedor/'+id);
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyProveedor/'+id);
      $('#formulario').submit();
    }
  });
}

function baja(id){
  return swal({
    title: 'Enviar registro a papelera',
    text: '¿Está seguro? ¡Ya no estara disponible!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Enviar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    var dominio = window.location.host;
    $('#formulario').attr('action','http://'+dominio+'/blissey/public/desactivateProveedor/'+id);
    swal(
      swal({
        title: '¡Desactivado!',
        text: 'Acción realizada satisfactorimente',
        type: 'success',
        showCancelButton: false,
        showConfirmButton: false
      })
    )
    $('#formulario').submit();
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal(
        'Cancelado',
        'El registro se mantiene',
        'info'
      )
    }
  });
}
</script>
