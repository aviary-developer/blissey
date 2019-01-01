{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  @if (!$componente->estado)
    @php
      $regreso = "?estado=0";
    @endphp
  @else
    @php
      $regreso = '';
    @endphp
  @endif
  <a class="navbar-brand" href={!! asset('/componentes'.$regreso) !!}>
    Componente
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
        <a class="nav-link" href={!! asset('/componentes/'.$componente->id.'/edit') !!}>Editar</a>
      </li>
      @if ($componente->estado)
        <li class="nav-item">
          <a class="nav-link" href="#" onclick={{"baja(".$componente->id.")"}}>Papelera</a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="#" onclick={!! "'alta(".$componente->id.");'"!!}>Activar</a>
        </li>
        @php
          $cuenta=App\Componente::foraneos($componente->id);
        @endphp
        @if (!$cuenta>0)
          <li class="nav-item">
            <a class="nav-link" href="#"  onclick={!! "'eliminar(".$componente->id.");'" !!}>Eliminar</a>
          </li>
        @endif
			@endif
			<li class="nav-item">
        <a class="nav-link" href={!! asset('/ayuda/general?tipo=componentes') !!} target="_blank">Ayuda</a>
      </li>
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
        $('#formulario').attr('action','http://'+$('#guardarruta').val()+'/activateComponente/'+id);
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
        $('#formulario').attr('action','http://'+$('#guardarruta').val()+'/destroyComponente/'+id);
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
        $('#formulario').attr('action','http://'+$('#guardarruta').val()+'/desactivateComponente/'+id);
        $('#formulario').submit();
      }
    });
  }
</script>
