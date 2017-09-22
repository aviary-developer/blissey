{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
<a href={!! asset('/pacientes/'.$paciente->id.'/edit')!!} class="btn btn-xs btn-primary">
  <i class="fa fa-edit"></i>
</a>
<button type="button" class="btn btn-success btn-xs" onclick={!! "'alta(".$paciente->id.");'" !!}/>
    <i class="fa fa-check"></i>
</button>
<button type="button" class="btn btn-danger btn-xs" onclick={!! "'eliminar(".$paciente->id.");'" !!}/>
    <i class="fa fa-remove"></i>
</button>
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activatePaciente/'+id);
      $('#formulario').submit();
      swal(
        '¡Hecho!',
        'El registro ha sido activado',
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyPaciente/'+id);
      $('#formulario').submit();
      swal(
        '¡Hecho!',
        'El registro ha sido eliminado',
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
