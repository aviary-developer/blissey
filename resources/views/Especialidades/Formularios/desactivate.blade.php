{!!Form::open(['url'=>['desactivateEspecialidad',$especialidad->id],'method'=>'POST'])!!}
<div class="btn-group">
  <a href={!! asset('/especialidades/'.$especialidad->id)!!} class="btn btn-sm btn-info" title="Ver">
    <i class="fa fa-info-circle"></i>
  </a>
  <a href={!! asset('/especialidades/'.$especialidad->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
    <i class="fa fa-edit"></i>
  </a>

  @if (App\Especialidad::contar_medicos($especialidad->id))
    <button type="button" class="btn btn-sm btn-danger disabled" title="Especialidad en uso">
      <i class="fas fa-ban"></i>
    </button>
  @else
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
  @endif
</div>
{!!Form::close()!!}
