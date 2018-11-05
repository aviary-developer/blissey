<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  @if (!$examen->estado)
    @php
      $regreso = "?estado=0";
    @endphp
  @else
    @php
      $regreso = '';
    @endphp
  @endif
  <a class="navbar-brand" href={!! asset('/examenes'.$regreso) !!}>
    Examen
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
        <a class="nav-link" href="#" id="editar">Editar precio</a>
      </li>
      @if ($examen->estado)
        <li class="nav-item">
          <a class="nav-link" href="#" onclick={{"baja(".$examen->id.")"}}>Papelera</a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="#" onclick={!! "'alta(".$examen->id.");'"!!}>Activar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"  onclick={!! "'eliminar(".$examen->id.");'" !!}>Eliminar</a>
        </li>
      @endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
<input type="hidden" name="u" id="ubi" value="show">
<input type="hidden" id="precio" value={{number_format($servicio->precio,2,'.',',')}}>
<input type="hidden" id="id-s" value={{$servicio->id}}>

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
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateExamen/'+id);
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
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyExamen/'+id);
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
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/desactivateExamen/'+id);
        submit();
      }
    });
  }

  $("#editar").click(function(e){
    var servicio = $("#id-s").val();
    var precio = $("#precio").val();
    var html_ = '<p>Ingrese el precio del examen</p><input type="number" class="swal2-input" step="0.10" id="monto" min="0.00" placeholder="Precio del examen" autofocus autocomplete="off" value="'+ precio +'">';

    swal({
    title: 'Editar precio',
    html: html_,
    showCancelButton: true,
    confirmButtonText: '¡Guardar!',
    cancelButtonText: 'Cancelar',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light'
    }).then((result) => {
      if (result.value) {
        console.log($("#monto").val())
        var monto = parseFloat($("#monto").val());
        if(!Number.isNaN(monto)){
          $.ajax({
            url: "/blissey/public/actualizarPrecioExamen",
            type: "POST",
            data: {
              idServicio: servicio,
              precio: monto,
            },
            success: function () {
              localStorage.setItem('msg', 'yes');
              location.reload();
            }
          });
        }else{
          swal({
          type: 'error',
          title: '¡Error!',
          text: 'Ingrese una cantidad valida',
          toast: true,
          timer: 5000,
          showConfirmButton: false,
        });
        }
      }
    });
  });
</script>