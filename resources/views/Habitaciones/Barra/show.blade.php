{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  @if (!$habitacion->estado)
    @php
      $regreso = "?estado=0";
    @endphp
  @else
    @php
      $regreso = '';
    @endphp
  @endif
  <a class="navbar-brand" href={!! asset('/habitaciones'.$regreso) !!}>
    Habitación
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
        <a class="nav-link active" href={!! asset('/habitaciones/'.$habitacion->id.'/edit') !!}>Editar</a>
      </li>
      @if ($habitacion->estado)
        <li class="nav-item">
          <a class="nav-link active" href="#" onclick={{"baja(".$habitacion->id.")"}}>Papelera</a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link active" href="#" onclick={!! "'alta(".$habitacion->id.");'"!!}>Activar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#"  onclick={!! "'eliminar(".$habitacion->id.");'" !!}>Eliminar</a>
        </li>
      @endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
{!!Form::close()!!}
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
        $('#formulario').attr('action',$('#guardarruta').val()+'/activateHabitacion/'+id);
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
        $('#formulario').attr('action',$('#guardarruta').val()+'/destroyHabitacion/'+id);
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
        $('#formulario').attr('action',$('#guardarruta').val()+'/desactivateHabitacion/'+id);
        $('#formulario').submit();
      }
    });
  }
</script>