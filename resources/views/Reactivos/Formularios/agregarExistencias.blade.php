<td><button value={{ $reactivo->contenidoPorEnvase}}  onclick="botonExistencias(this,'{{$reactivo->nombre}}','{{$reactivo->id}}');" type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalExistencias">
  <i class="fa fa-unsorted"></i>
</button></td>
<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalExistencias">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Existencias de Reactivos <span class="label label-lg label-primary">Agregar/Quitar</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <div class="form-group">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                    Actualmente tiene: <strong><span id="spanExistenciasActuales"></span> <span id="spanNomReac"></span> en existencias</strong>
                  </div>
            <label class="control-label col-sm-3 col-xs-12">Cantidad</label>
            <div class="col-sm-9 col-xs-12">
              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('cantidadExistencias',null,['id'=>'cantidadExistencias','class'=>'form-control has-feedback-left','placeholder'=>'0']) !!}
            </div>
          </div>

          <input type="hidden" id="tokenExistenciaModal" name="tokenExistenciaModal" value="<?php echo csrf_token(); ?>">
<input type="hidden" id="idReactivo" name="idReactivo" value="">
        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarCantidadExistencias" onclick="comprobacionTemporal();" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modalExistencias">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<script>
function botonExistencias(existencias,nombre,id) {
  $("#spanExistenciasActuales").text(existencias.value);
  $("#spanNomReac").text(nombre);
  $("#idReactivo").val(id);
$("#cerrar_modalExistencias").on('click', function () {
  $("#cantidadExistencias").val("");
});
}

function comprobacionTemporal(){
  var total;
  var actual= parseInt($("#spanExistenciasActuales").text());
  var cantidad= parseInt($("#cantidadExistencias").val());
  total=actual+cantidad;
  if(Number.isNaN(cantidad)){
    new PNotify({
      title: 'Error!',
      text: 'Ingrese una cantidad válida',
      type: 'error',
      styling: 'bootstrap3'
    });
  }
  else if(total<0){
    new PNotify({
      title: 'Error!',
      text: 'Cantidad total menor a 0',
      type: 'error',
      styling: 'bootstrap3'
    });
  }else if(total==0){
    swal({
      title: 'Existencias igual a 0',
      text: '¿Está seguro? ¡No se realizarán examenes con este reactivo!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Estoy seguro!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-warning',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then(function () {
      guardarExistencias(total);
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal(
          'Cancelado',
          'El registro se mantiene',
          'info'
        )
      }
    });
  }
  else if(total>0){
  guardarExistencias(total);
}
}
function guardarExistencias(total){
  var ruta="/blissey/public/actualizarExistenciaReactivos";
  var token = $('#tokenExistenciaModal').val();
  var id = $('#idReactivo').val();
  $.ajax({
    url:ruta,
    headers:{'X-CSRF-TOKEN':token},
    type:'POST',
    data: {
      id:id,
      contenidoPorEnvase:total
    },
    success: function(){
      $(".modal").modal('hide');
      swal({
        title: '¡Cantidad registrada!',
        text: 'Actualizando existencias',
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
  $("#cantidadExistencias").val("");
}
</script>
