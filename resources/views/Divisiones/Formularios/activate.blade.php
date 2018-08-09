{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
  <a href={!! asset('/divisiones/'.$division->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
    <i class="fa fa-info-circle"></i>
  </a>
  <a href={!! asset('/divisiones/'.$division->id.'/edit')!!} class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
    <i class="fa fa-edit"></i>
  </a>
  <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Restaurar" onclick={!! "'alta(".$division->id.");'" !!}/>
    <i class="fa fa-check"></i>
  </button>
  @php
    $cuenta=App\Division::foreanos($division->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="No se puede eliminar">
      <i class="fa fa-warning"></i>
    </button>
  @else
  <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={!! "'eliminar(".$division->id.");'" !!}/>
    <i class="fa fa-remove"></i>
  </button>
  @endif
@else
    @if (!$division->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <div class="row">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li>
              <a href={!! asset('/divisiones'.$regreso)!!}><i class="fa fa2 fa-arrow-left"></i> Atras</a>
            </li>
            <li>
              <a href={!! asset('/divisiones/'.$division->id.'/edit')!!}><i class="fa fa2 fa-edit"></i> Editar</a>
            </li>
              @if ($division->estado)
                <li>
                <a href="#" onclick={!! "'baja(".$division->id.");'" !!}><i class="fa fa2 fa-trash"></i> Papelera</a>
              </li>
              @else
                <li>
                  <a href="#" onclick={!! "'alta(".$division->id.");'" !!}><i class="fa fa2 fa-check"></i> Restaura</a>
                </li>
                <li>
                  <a href="#" onclick={!! "'eliminar(".$division->id.");'" !!}><i class="fa fa2 fa-remove"></i> Eliminar</a>  
                </li>
              @endif
            <li>
              <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
            </li>
          </ul>
        </div>
      </nav>
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateDivision/'+id);
      $('#formulario').submit();
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyDivision/'+id);
      $('#formulario').submit();
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
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/desactivateDivision/'+id);
      $('#formulario').submit();
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
