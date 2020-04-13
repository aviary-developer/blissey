  @php
    $contador=App\CambioProducto::where('estado',0)->where('localizacion',App\Transacion::tipoUsuario())->count();
  @endphp
  @if ($contador>0)
    <li class="nav-item">
      <a class="nav-link active"href="#" onclick={!! "'retirar();'" !!}>Retirar lotes vencidos</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Reporte
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" target="_blank"href={!! asset('/lotes_pdf/1') !!}>
            Próximos a vencer
        </a>
      </div>
    </li>
  @endif
<script type="text/javascript">
function retirar(id){
  return swal({
    title: 'Confirmar retiro de productos vencidos',
    text: '¿Está seguro? ¡Todos los lotes vencidos debe ser retirados!',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Confirmar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
    $('#formulario').attr('action','confirmarRetiroVencidos');
    $('#formulario').submit();
    }
  });
}
function individual(id){
  return swal({
    title: 'Confirmar retiro de lote vencido',
    text: '¿Está seguro? ¡El lote debe ser retirado de los estantes!',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Confirmar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
    $('#formulario').attr('action','confirmarRetiroIndividual/'+id);
    $('#formulario').submit();
    }
  });
}
</script>
