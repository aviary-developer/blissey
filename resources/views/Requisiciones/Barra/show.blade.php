<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  @php
      if($transaccion->tipo==6){
        $r=5;
      }else{
        $r=$transaccion->tipo;
      }
  @endphp 
  <a class="navbar-brand" href={!! asset('/requisiciones?tipo='.$r) !!}>
    Requisición
    <span class="badge border-info border text-info">
      Información
    </span>  
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      @if ($transaccion->tipo == 4)
        <li class="nav-item">
          <a class="nav-link active" href="#"  onclick={!! "'eliminarPedido(".$transaccion->id.");'" !!}>Eliminar</a>
        </li>
      @endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>
<input type="hidden" name="u" id="ubi" value="show">

<script type="text/javascript">
  function eliminarPedido(id){
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
				location.href = $('#guardarruta').val() + '/eliminarPedido/'+id+"/4";
				$('#formulario').submit();
			}
		});
	}
</script>