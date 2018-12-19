{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
  <div class="btn-group">
    <a href={!! asset('/categoria_productos/'.$categoria->id)!!} class="btn btn-sm btn-info"  title="Ver">
      <i class="fas fa-info-circle"></i>
    </a>
    <a href={!! asset('/categoria_productos/'.$categoria->id.'/edit')!!} class="btn btn-sm btn-primary"  title="Editar">
      <i class="fas fa-edit"></i>
    </a>
  </div>
  <div class="btn-group">
  <button type="button" class="btn btn-success btn-sm" onclick={!! "'alta(".$categoria->id.");'" !!}  title="Restaurar"/>
    <i class="fas fa-check"></i>
  </button>
  @php
  $cuenta=App\CategoriaProducto::foraneos($categoria->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled"  title="No se puede eliminar">
      <i class="fas fa-ban"></i>
    </button>
  @else
    <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$categoria->id.");'" !!}  title="Eliminar"/>
      <i class="fas fa-times"></i>
    </button>
  @endif
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
      var dominio = $('#guardarruta').val();
      $('#formulario').attr('action','activateCategoriaProducto/'+id);
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
      var dominio = $('#guardarruta').val();
      $('#formulario').attr('action','destroyCategoriaProducto/'+id);
      $('#formulario').submit();
    }
  });
}
</script>
