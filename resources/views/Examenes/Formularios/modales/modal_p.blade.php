<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Parametro <span class="label label-primary label-lg">Nuevo</span></h4>
      </div>
      <div class="modal-body">
        <div class="x_content">
          <br />
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombreParametro',null,['id'=>'nombreParametro','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo parametro','required']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="">
            <label>
              <input type="checkbox"name="checkValores" id="checkValores" class="js-switch" unchecked /> Información avanzada
            </label>
          </div>
          </div>
          </div>
          <div id="divValoresNormales" style="display:none;">
          <div class="form-group" id="grupoUnidadParametro">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad de medición</label>
            <div class="col-md-9 col-sm-9 col-xs-12" id="unidadParametro">
              <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                <select class="form-control has-feedback-left" id="selectUnidadParametro" name="unidad" required disabled>
                  <option value=""></option>
                  @foreach ($unidades as $unidad)
                    <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2 col-sm-2 col-xs-2">
            </div>
            <span class="label-lg label label-cian col-xs-4">Masculino</span>
            <div class="col-md-2 col-sm-2 col-xs-2">
            </div>
            <span class="label-lg label label-pink col-xs-4">Femenino</span>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mínimo</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('valorMinimo',null,['id'=>'valorMinimo','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
            </div>
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mínimo</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('valorMinimoFemenino',null,['id'=>'valorMinimoFemenino','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Máximo</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('valorMaximo',null,['id'=>'valorMaximo','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
            </div>
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Máximo</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
              {!! Form::number('valorMaximoFemenino',null,['id'=>'valorMaximoFemenino','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
            </div>
          </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor predeterminado</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('valorPredeterminado',null,['id'=>'valorPredeterminado','class'=>'form-control has-feedback-left','placeholder'=>'']) !!}
            </div>
        </div>
            <center>
            <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
          </center>
          <div class="ln_solid"></div>
          <div class="form-group">
            <center>
<input type="hidden" id="tokenParametroModal" name="tokenParametroModal" value="<?php echo csrf_token(); ?>">
            </center>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <center>
          <button type="button" class="btn btn-primary" id="" onclick="agregarParametroDesdeModal()">Guardar</button>
          <button type="reset" name="button" class="btn btn-default">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </center>
      </div>

    </div>
  </div>
</div>
<script>

async function agregarParametroDesdeModal(){
  var nombre = $("#nombreParametro").val();
  var unidad = $("#selectUnidadParametro").val();
  var valorMinimo= $('#valorMinimo').val();
  var valorMaximo= $('#valorMaximo').val();
  var valorMinimoF= $('#valorMinimoFemenino').val();
  var valorMaximoF= $('#valorMaximoFemenino').val();
  var valorPredeterminado= $('#valorPredeterminado').val();
  var ruta="/blissey/public/ingresoParametro";
  var token = $('#tokenParametroModal').val();

  await $.ajax({
    url:ruta,
    headers:{'X-CSRF-TOKEN':token},
    type:'POST',
    data: {
      nombreParametro: nombre,
      unidad: unidad,
      valorMinimo: valorMinimo,
      valorMaximo: valorMaximo,
      valorMinimoFemenino: valorMinimoF,
      valorMaximoFemenino: valorMaximoF,
      valorPredeterminado: valorPredeterminado
    },
    success: function(){
      $(".modal").modal('hide');
      swal({
        title: '¡Parametro registrado!',
        text: 'Cargando información',
        timer: 3000,
        onOpen: function () {
          swal.showLoading()
        }
      }).then(
        function () {},
        function (dismiss) {
          if (dismiss === 'timer') {
          }
        }
      )
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
  var paso=-1;
  // for (paso = -1; paso < contadorSelectsParametros; paso++) {
  //   rellenarCombosParametros(paso);
  // }
  rellenarCombosParametros();
  $("#nombreParametro").val("");
  $('#valorMinimo').val("");
  $('#valorMaximo').val("");
  $('#selectUnidadParametro').val("");
  $('#valorMinimoFemenino').val("");
  $('#valorMaximoFemenino').val("");
  $('#valorPredeterminado').val("");
}
function rellenarCombosParametros(){
  var parametros = $("#parametro_select");
  var ruta="/blissey/public/llenarParametrosExamenes";
  $.get(ruta,function(res){
    parametros.empty();
    $(res).each(function(key,value){
      parametros.append("<option value='"+value.id+"'>"+value.nombreParametro+"</option>");
    });
  });
}
</script>
