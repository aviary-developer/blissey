{!!Form::open(['url'=>['desactivateCaja',$caja->id],'method'=>'POST'])!!}
<div class="btn-group">
    <a href={!! asset('/cajas/'.$caja->id)!!} class="btn btn-sm btn-info"  title="Ver">
      <i class="fas fa-info-circle"></i>
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
