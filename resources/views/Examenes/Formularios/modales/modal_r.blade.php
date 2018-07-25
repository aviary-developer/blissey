<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal3">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Reactivo <span class="label-primary label label-lg">Nuevo</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">

          <div class="form-group col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-flask form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['id'=>'nombreReactivoModal','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo reactivo']) !!}
            </div>
          </div>

          <div class="form-group col-sm-12 col-xs-12">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de vencimiento</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                @php
                  $ahora = Carbon\Carbon::now();
                @endphp
                {!! Form::date('fechaVencimiento',$fecha,['min'=>$ahora->addDay(1)->format('Y-m-d'),'id'=>'fechaVencimientoReactivoModal','class'=>'form-control has-feedback-left']) !!}
              </div>
            </div>

          <div class="form-group col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contenido por envase*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('contenidoPorEnvase',null,['min'=>1,'id'=>'contenidoReactivoModal','class'=>'form-control has-feedback-left','placeholder'=>'Contenido en ml']) !!}
            </div>
          </div>

          <input type="hidden" id="tokenReactivoModal" name="tokenReactivoModal" value="<?php echo csrf_token(); ?>">

        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>

      <div class="modal-footer">
        <button type="button" onclick="agregarReactivoDesdeModal();" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<script>
async function agregarReactivoDesdeModal(){
  var v_nombre = $("#nombreReactivoModal").val();
  var fechaVencimiento = $("#fechaVencimientoReactivoModal").val();
  var contenido = $("#contenidoReactivoModal").val();
  var token = $("#tokenReactivoModal").val();

  await $.ajax({
    url: "/blissey/public/ingresoReactivo",
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    data: {
      nombre: v_nombre,
      fechaVencimiento: fechaVencimiento,
      contenidoPorEnvase: contenido
    },
    success: function () {
      $(".modal").modal('hide');
      swal({
        title: '¡Reactivo registrado!',
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


  rellenarReactivo();
  $("#nombreReactivoModal").val("");
  $("#descripcionReactivoModal").val("");
  $("#contenidoReactivoModal").val("");
}
function rellenarReactivo(){
  var reactivos = $("#reactivo_select");
  var ruta="/blissey/public/llenarReactivosExamenes";
  $.get(ruta,function(res){
    reactivos.empty();
    $(res).each(function(key,value){
      reactivos.append("<option value='"+value.id+"'>"+value.nombre+"</option>");
    });
  });
}
</script>
