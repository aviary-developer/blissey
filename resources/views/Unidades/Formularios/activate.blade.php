{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
  <a href={!! asset('/unidades/'.$unidad->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
    <i class="fa fa-info-circle"></i>
  </a>
  <a href={!! asset('/unidades/'.$unidad->id.'/edit')!!} class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
    <i class="fa fa-edit"></i>
  </a>
  <button type="button" class="btn btn-success btn-sm" onclick={!! "'alta(".$unidad->id.");'" !!} data-toggle="tooltip" data-placement="top" title="Restaurar"/>
    <i class="fa fa-check"></i>
  </button>
  @php
    $cuenta=App\Unidad::foreanos($unidad->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="No se puede eliminar">
      <i class="fa fa-warning"></i>
    </button>
  @else
  <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$unidad->id.");'" !!} data-toggle="tooltip" data-placement="top" title="Eliminar"/>
    <i class="fa fa-remove"></i>
  </button>
  @endif
@else
  <div class="btn-group">
    @if (!$unidad->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <a href={!! asset('/unidades'.$regreso)!!} class="btn btn-dark btn-sm">
      <i class="fa fa-arrow-left"></i> Atras
    </a>
    <a href={!! asset('/unidades/'.$unidad->id.'/edit')!!} class="btn btn-dark btn-sm">
      <i class="fa fa-edit"></i> Editar
    </a>
    @if ($unidad->estado)
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'baja(".$unidad->id.");'" !!}>
        <i class="fa fa-trash"></i> Papelera
      </button>
    @else
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'alta(".$unidad->id.");'" !!}/>
        <i class="fa fa-check"></i> Restaurar
      </button>
      <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$unidad->id.");'" !!}/>
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
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Restaurar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateUnidad/'+id);
      $('#formulario').submit();
      swal(
        '¡Restaurado!',
        'Acción realizada satisfactorimente',
        'success'
      )
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
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyUnidad/'+id);
      $('#formulario').submit();
      swal(
        '¡Eliminado!',
        'Acción realizada satisfactorimente',
        'success'
      )
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/desactivateUnidad/'+id);
      $('#formulario').submit();
      swal(
        '¡Desactivado!',
        'Acción realizada satisfactorimente',
        'success'
      )
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
