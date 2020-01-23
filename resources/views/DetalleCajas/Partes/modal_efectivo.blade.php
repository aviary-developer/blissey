<div class="modal fade" tabindex="-1" role="dialog" id="modal_efectivo" data-backdrop="static" aria-hidden="true">
    {!!Form::open(['url'=>['efectivo'],'method'=>'POST','autocomplete'=>'off','id'=>'formulario'])!!}
    <div class="modal-dialog" role="document">
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1" id="titulo">
                Efectivo
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
                <input type="hidden" id="tipoModal" name="tipo" value="">
                <input type="hidden" id="actualModal" name="actual" value="{{$_GET['total']}}">
                <input type="hidden" id="tokenEfectivonModal" name="tokenEfectivoModal" value="<?php echo csrf_token(); ?>">  
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="m_panel x_panel bg-transparent" style="border:0px !important">
            <center>
              <button type="button" class="btn btn-sm  col-2 btn-primary" onclick="validarEfectivo();">Aceptar</button>
              <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!}
</div>
<script>
function validarEfectivo(){
      console.log($("#actualModal").val());
      actual=parseFloat($("#actualModal").val());
      cantidad=parseFloat($("#cantidadModal").val());
      justificar=$("#justificarModal").val();
      tipo=$("#tipoModal").val();
      console.log(actual);
      if(actual<cantidad && tipo=='2'){
        notaError("Cantidad supera el valor en caja");
      }else if($("#cantidadModal").val()=="" || justificar==""){
        notaError("Complete los datos solicitados");
      }else{
          $("#formulario").submit();
      }

}</script>
  