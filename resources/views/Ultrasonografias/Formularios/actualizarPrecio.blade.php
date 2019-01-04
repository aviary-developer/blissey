<button value={{ $servicio->id}} id="idServicio" type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalActualizarPrecio">
  <i class="fa fa-refresh"></i> Actualizar precio
</button>
<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalActualizarPrecio">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Actualizar precio de {{$ultrasonografia->nombre}} <span class="label label-lg label-primary">Actualizar</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <center><strong>Precio actual: <span>{{ '$ '.number_format($servicio->precio,2,'.',',') }}</span></strong></center>
                  </div>
            <div class="form-group">
            <label class="control-label col-sm-3 col-xs-12">Nuevo precio</label>
            <div class="col-sm-3 col-xs-12">
              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('precio',null,['id'=>'precio','class'=>'form-control has-feedback-left','placeholder'=>'0.0']) !!}
            </div>
            <br><br>
            </div>
            <!--<div class="form-group">
            <label class="control-label col-sm-3 col-xs-12">Descripción</label>
            <div class="col-sm-9 col-xs-12">
              <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
              {!! Form::textarea('descripcionExistencias',null,['id'=>'descripcionExistencias','class'=>'form-control has-feedback-left','placeholder'=>'Describa el movimiento en la cantidad de reactivos','rows'=>'3']) !!}
            </div>
          </div>-->

          <input type="hidden" id="tokenExistenciaModal" name="tokenExistenciaModal" value="<?php echo csrf_token(); ?>">
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarActualizarPrecio" onclick="comprobacion();" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal" id="cerrar_modalExistencias">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<script>
function comprobacion(){
  var precio=$('#precio').val();
  var idServicio=$('#idServicio').val();
  if(!precio){
    new PNotify({
      title: 'Error!',
      text: 'Ingrese una cantidad',
      type: 'error',
      styling: 'bootstrap3'
    });
  }
  else if(Number.isNaN(precio)){
    new PNotify({
      title: 'Error!',
      text: 'Ingrese una cantidad válida',
      type: 'error',
      styling: 'bootstrap3'
    });
  }
  else if(precio<0){
    new PNotify({
      title: 'Error!',
      text: 'Cantidad negativa',
      type: 'error',
      styling: 'bootstrap3'
    });
  }else if(precio==0){
    swal({
      title: 'Precio $0',
      text: '¿Está seguro? ¡No se cobrará por este examen!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Estoy seguro!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-warning',
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then(function () {
      guardarPrecio(precio);
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal(
          'Cancelado',
          'El registro se mantiene',
          'info'
        )
      }
    });
  }else if(precio>0){
  guardarPrecio(idServicio,precio);
}
}
function guardarPrecio(idServicio,precio){
  var ruta=$('#guardarruta').val() + "/actualizarPrecioUltra";
  var token = $('#tokenExistenciaModal').val();
  $.ajax({
    url:ruta,
    headers:{'X-CSRF-TOKEN':token},
    type:'POST',
    data: {
      idServicio:idServicio,
      precio:precio
    },
    success: function(){
      $(".modal").modal('hide');
      swal({
        title: '¡Precio actualizado!',
        text: 'Cargando...',
        timer: 2500,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () { },
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      );
      location.reload();
    },
    error: function(data){
      if (data.status === 422 ) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (index, value) {
          new PNotify({
            title: 'Error!',
            text: value,
            type: 'error',
            styling: 'bootstrap3'
          });
        });
      }
    }
  });
  $("#precio").val("");
}
</script>
