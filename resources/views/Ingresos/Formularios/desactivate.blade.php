{!!Form::open(['id' => 'formulario' ,'method'=>'POST'])!!}
@if ($index)
  <div class="btn-group alignright">
		@if (Auth::user()->tipoUsuario == "Recepción" && $ingreso->tipo < 3)  
		  <button type="button" data-toggle="modal" data-target="#acta" class="btn btn-sm btn-dark" title="Acta de consentimiento" data-id="{{$ingreso->hospitalizacion->id}}" data-ingreso="{{$ingreso->id}}" id="generated_acta">
				<i class="fas fa-print"></i>
			</button>
			<!--
      <a href={!! asset('/acta/'.$ingreso->id)!!} class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Acta de consentimiento" target="_blank">
        <i class="fa fa-print"></i>
			</a>
		-->
    @endif
    <a href={!! asset('/ingresos/'.$ingreso->id)!!} class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Ver">
      <i class="fa fa-info-circle"></i>
    </a>
  </div>
@else
  <div class="btn-group col-xs-6">
    @if ($ingreso->estado > 1)
      @php
        $regreso = "?estado=2";
      @endphp
    @else
      @php
        $regreso = "";
      @endphp
    @endif
    <a href={!! asset('/ingresos'.$regreso)!!} class="btn btn-dark btn-sm">
      <i class="fa fa-arrow-left"></i> Atras
    </a>
    @if (Auth::user()->tipoUsuario == "Recepción" && $ingreso->tipo < 3)    
      <a href={!! asset('/acta/'.$ingreso->id)!!} class="btn btn-sm btn-dark" target="_blank">
        <i class="fa fa-print"></i> Acta de consentimiento
      </a>
    @endif
    <a href={!! asset('#')!!} class="btn btn-primary btn-sm">
      <i class="fa fa-question"></i> Ayuda
    </a>
  </div>
  <div class="col-xs-1"></div>
  <div class="btn-group alignright">
    @if ($ingreso->estado == 0 && Auth::user()->tipoUsuario == "Recepción" && $ingreso->tipo != 3)
      <button type="button" class="btn btn-success btn-sm" onclick={!!"'alta(".$ingreso->id.");'"!!}/>
        <i class="fa fa-check"></i> Confrimar ingreso
      </button>
      <button type="button" class="btn btn-danger btn-sm" onclick={!!"'eliminar(".$ingreso->id.");'"!!}/>
        <i class="fa fa-remove"></i> Eliminar
      </button>
    @endif
  </div>
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
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').attr('action','desactivateIngreso/'+id);
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
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').attr('action','activateIngreso/'+id);
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
