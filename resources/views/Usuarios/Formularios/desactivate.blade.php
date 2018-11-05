{!!Form::open(['url'=>['desactivateUsuario',$usuario->id],'method'=>'POST'])!!}
<div class="btn-group">

  <a href={!! asset('/usuarios/'.$usuario->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
    <i class="fa fa-info-circle"></i>
  </a>
  <a href={!! asset('/usuarios/'.$usuario->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
    <i class="fa fa-edit"></i>
  </a>
  @if($usuario->id != Auth::user()->id)    
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
        <i class="fa fa-trash"></i>
    </button>
  @else
    <a href="#" class="btn btn-sm btn-danger disabled" title="No puedes desactivarte a ti mismo">
      <i class="fas fa-ban"></i>
    </a>
  @endif
</div>
{!!Form::close()!!}
