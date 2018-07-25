<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal4">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tipo de muestra <span class="label label-lg label-primary">Nuevo</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <div class="form-group">
            <label class="control-label col-sm-3 col-xs-12">Nombre *</label>
            <div class="col-sm-9 col-xs-12">
              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['id'=>'nombreMuestraModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo tipo de muestra']) !!}
            </div>
          </div>

          <input type="hidden" id="tokenMuestraModal" name="tokenMuestraModal" value="<?php echo csrf_token(); ?>">

        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarMuestraModal" onclick="guardarMuestraModal();" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<script>
async function guardarMuestraModal() {
  e.preventDefault();
  var v_nombre = $("#nombreMuestraModal").val();

  var token = $("#tokenMuestraModal").val();

  await $.ajax({
    url: "/blissey/public/ingresoMuestra",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Tipo de muestra registrado!',
        text: 'Cargando información',
        timer: 3000,
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


  rellenarMuestra();
  $("#nombreMuestraModal").val("");

}

  function rellenarMuestra() {
    var muestras = $("#tipo_muestra_select");
    var ruta = "/blissey/public/llenarMuestrasExamenes";
    $.get(ruta, function (res) {
      muestras.empty();
      $(res).each(function (key, value) {
        muestras.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
      });
    });
  }
</script>
