{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
  <a href={!! asset('/servicios/'.$servicio->id)!!} class="btn btn-xs btn-info">
    <i class="fa fa-info-circle"></i>
  </a>
  <a href={!! asset('/servicios/'.$servicio->id.'/edit')!!} class="btn btn-xs btn-primary">
    <i class="fa fa-edit"></i>
  </a>
  <button type="button" class="btn btn-success btn-xs" onclick={!! "'alta(".$servicio->id.");'" !!}/>
    <i class="fa fa-check"></i>
  </button>
  <button type="button" class="btn btn-danger btn-xs" onclick={!! "'eliminar(".$servicio->id.");'" !!}/>
    <i class="fa fa-remove"></i>
  </button>
@else
  <div class="btn-group">
    @if (!$servicio->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <a href={!! asset('/servicios'.$regreso)!!} class="btn btn-dark btn-ms">
      <i class="fa fa-arrow-left"></i> Atras
    </a>
    <a href={!! asset('/servicios/'.$servicio->id.'/edit')!!} class="btn btn-dark btn-ms">
      <i class="fa fa-edit"></i> Editar
    </a>
    @if ($servicio->estado)
      <button type="button" class="btn btn-dark btn-ms" onclick={!! "'baja(".$servicio->id.");'" !!}>
        <i class="fa fa-trash"></i> Papelera
      </button>
    @else
      <button type="button" class="btn btn-dark btn-ms" onclick={!! "'alta(".$servicio->id.");'" !!}/>
        <i class="fa fa-check"></i> Restaurar
      </button>
      <button type="button" class="btn btn-danger btn-ms" onclick={!! "'eliminar(".$servicio->id.");'" !!}/>
        <i class="fa fa-remove"></i> Eliminar
      </button>
    @endif
    <a href={!! asset('#')!!} class="btn btn-primary btn-ms">
      <i class="fa fa-question"></i> Ayuda
    </a>
  </div>
@endif
{!!Form::close()!!}
<script type="text/javascript">
  function alta(id){
    return swal({
      title: 'Activar registro',
      text: '¿Está seguro? ¡El registro estará activo nuevamente!',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Activar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateServicio/'+id);
      $('#formulario').submit();
      swal(
        '¡Activado!',
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyServicio/'+id);
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/desactivateServicio/'+id);
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
