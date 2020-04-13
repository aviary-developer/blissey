<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  @if (!$usuario->estado)
    @php
      $regreso = "?estado=0";
    @endphp
  @else
    @php
      $regreso = '';
    @endphp
  @endif
  <a class="navbar-brand" href={!! asset('/usuarios'.$regreso) !!}>
    Usuarios
    <span class="badge border-info border text-info">
      Información
    </span>  
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active" href={!! asset('/usuarios/'.$usuario->id.'/edit') !!}>Editar</a>
      </li>
      @if (Auth::user()->administrador)
        @if ($usuario->estado)
          <li class="nav-item">
            <a class="nav-link active" href="#" onclick={{"baja(".$usuario->id.")"}}>Papelera</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link active" href="#" onclick={!! "'alta(".$usuario->id.");'"!!}>Activar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#"  onclick={!! "'eliminar(".$usuario->id.");'" !!}>Eliminar</a>
          </li>
        @endif
      @endif
      @if (Auth::user()->id == $id)
        <li class="nav-item">
          <a class="nav-link active" href="#" data-target="#modal-c" data-toggle="modal">
            Contraseña
            @if ($usuario->password_correo())
              <i class="fas fa-exclamation-circle text-danger" title="Modifique la contraseña"></i>
            @endif
          </a>
        </li>
      @endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
<input type="hidden" name="u" id="ubi" value="show">

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
        localStorage.setItem('msg','yes');
        var dominio = window.location.host;
        $('#formulario').attr('action','activateUsuario/'+id);
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
        localStorage.setItem('msg','yes');
        var dominio = window.location.host;
        $('#formulario').attr('action','destroyUsuario/'+id);
        $('#formulario').submit();
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
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        localStorage.setItem('msg','yes');
        var dominio = window.location.host;
        $('#formulario').attr('action','desactivateUsuario/'+id);
        submit();
      }
    });
  }
</script>