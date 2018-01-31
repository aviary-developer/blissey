{!!Form::open(['id' => 'formulario' ,'method'=>'POST'])!!}
<a href={!! asset('/acta/'.$ingreso->id)!!} class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Acta de consentimiento">
  <i class="fa fa-print"></i>
</a>
@if ($ingreso->estado == 0)
  <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Confirmar ingreso" onclick={!!"'alta(".$ingreso->id.");'"!!}/>
    <i class="fa fa-check"></i>
  </button>
  <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={!!"'eliminar(".$ingreso->id.");'"!!}/>
    <i class="fa fa-remove"></i>
  </button>
@endif
{!!Form::close()!!}

<script type="text/javascript">
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/desactivateIngreso/'+id);
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

  function alta(id){
    return swal({
      title: 'Confirmar ingreso',
      text: '¡El paciente estará ingresado!',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Confirmar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateIngreso/'+id);
      $('#formulario').submit();
      swal(
        '¡Ingresado!',
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
