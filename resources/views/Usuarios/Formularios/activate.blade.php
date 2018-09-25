{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
  <div class="btn-group">
    <a href={!! asset('/usuarios/'.$usuario->id)!!} class="btn btn-sm btn-info" title="Ver">
      <i class="fas fa-info-circle"></i>
    </a>
    <a href={!! asset('/usuarios/'.$usuario->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
      <i class="fas fa-edit"></i>
    </a>
  </div>

  <div class="btn-group">
    <button type="button" class="btn btn-success btn-sm" onclick={!! "'alta(".$usuario->id.");'" !!} title="Restaurar"/>
      <i class="fas fa-check"></i>
    </button>
    <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$usuario->id.");'" !!} title="Eliminar"/>
      <i class="fas fa-times"></i>
    </button>
  </div>
@else
  <div class="btn-group">
    @if (!$usuario->estado)
      @php
        $regreso = "?estado=0";
      @endphp
    @else
      @php
        $regreso = '';
      @endphp
    @endif
    <a href={!! asset('/usuarios'.$regreso)!!} class="btn btn-dark btn-sm">
      <i class="fa fa-arrow-left"></i> Atras
    </a>
    <a href={!! asset('/usuarios/'.$usuario->id.'/edit')!!} class="btn btn-dark btn-sm">
      <i class="fa fa-edit"></i> Editar
    </a>
    @if($usuario->id != Auth::user()->id)
      @if ($usuario->estado)
        <button type="button" class="btn btn-dark btn-sm" onclick={!! "'baja(".$usuario->id.");'" !!}>
          <i class="fa fa-trash"></i> Papelera
        </button>
      @else
        <button type="button" class="btn btn-dark btn-sm" onclick={!! "'alta(".$usuario->id.");'" !!}/>
          <i class="fa fa-check"></i> Restaurar
        </button>
        <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$usuario->id.");'" !!}/>
          <i class="fa fa-remove"></i> Eliminar
        </button>
      @endif
    @else
      <button type="button" class="{!! "btn btn-sm"." ".(($usuario->password_correo())?"btn-danger":"btn-dark") !!}" data-toggle="modal" data-target=".bs-modal-sm" id="cambiar_contra" >
        <i class="fa fa-lock"></i>
        Contraseña
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
      confirmButtonText: 'Si, ¡Restaurar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        localStorage.setItem('msg','yes');
        var dominio = window.location.host;
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateUsuario/'+id);
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
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        localStorage.setItem('msg','yes');
        var dominio = window.location.host;
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyUsuario/'+id);
      $('#formulario').submit();
      }
    });
  }
</script>
