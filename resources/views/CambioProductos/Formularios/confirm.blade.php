{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
<div class="row">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li>
          <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
        </li>
        @php
        $contador=App\CambioProducto::where('estado',0)->where('localizacion',App\Transacion::tipoUsuario())->count();
      @endphp
      @if ($contador>0)
        <li>
          <a href="#" onclick={!! "'retirar();'" !!}><i class="fa fa2 fa-archive"></i> Retirar lotes vencidos</a>
        </li>
      @endif
      <li>
        <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
      </li>
    </ul>
  </div>
</nav>
</div>
{!!Form::close()!!}
<script type="text/javascript">
function retirar(){
  return swal({
    title: 'Confirmar retiro de productos vencidos',
    text: '¿Está seguro? ¡Todos los lotes vencidos debe ser retirados!',
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
    $('#formulario').attr('action','http://'+dominio+'/blissey/public/confirmarRetiroVencidos');
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
function individual(id){
  return swal({
    title: 'Confirmar retiro de lote vencido',
    text: '¿Está seguro? ¡El lote debe ser retirado de los estantes!',
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
    $('#formulario').attr('action','http://'+dominio+'/blissey/public/confirmarRetiroIndividual/'+id);
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
