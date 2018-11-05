{!!Form::open(['url'=>['desactivateProveedor',$proveedor->id],'method'=>'POST'])!!}
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
<button type="button" class="btn btn-danger btn-sm" title="Enviar a papelera" onclick="
  return swal({
    title: 'Enviar registro a papelera',
    text: '¿Está seguro? ¡Ya no estara disponible!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Enviar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      submit();
    }
  });"/>
    <i class="fas fa-trash"></i>
</button>
</div>
{!!Form::close()!!}
