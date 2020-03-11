<div class="modal fade" tabindex="-1" role="dialog" id="modal_salida" data-backdrop="static" aria-hidden="true">
    {!!Form::open(['url'=>['salida'],'method'=>'POST','autocomplete'=>'off','id'=>'formulario'])!!}
    <div class="modal-dialog" role="document">
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                Salida del inventario
              </h4>
            </center>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel">
            <div class="ln_solid mb-1 mt-1"></div>
            <div class="row">
  
              <div class="form-group col-sm-12">
                <label class="" for="nombrep">Cantidad *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
                  </div>
                  {!! Form::number('cantidad',null,['id'=>'cantidadModal','class'=>'form-control form-control-sm']) !!}
                </div>
              </div>
              <div class="form-group col-sm-12">
                <label class="" for="nombrep">Justificar *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
                  </div>
                  {!! Form::text('justificar',null,['id'=>'justificarModal','class'=>'form-control form-control-sm']) !!}
                </div>
              </div>
                <input type="hidden" id="idTr" name="idTr" value="">
                <input type="hidden" id="limiteCantidad" name="limite" value="">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="m_panel x_panel bg-transparent" style="border:0px !important">
            <center>
              <button type="button" class="btn btn-sm  col-2 btn-primary" onclick="validarSalida();">Aceptar</button>
              <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!}
</div>
<script>
function validarSalida(){
  if(replica==0){
      limite=parseFloat($("#limiteCantidad").val());
      cantidad=parseFloat($("#cantidadModal").val());
      justificar=$("#justificarModal").val();
      if($("#cantidadModal").val()=="" || justificar==""){
        notaError("Complete los datos solicitados");
      }else if(limite<cantidad){
        notaError("Cantidad supera las existencias");
      }else{
          $("#formulario").submit();
          replica++;

      }
    }

}</script>
  