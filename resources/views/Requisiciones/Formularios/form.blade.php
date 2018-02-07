<div class="x_content">
  <div class="row">
  <label class="col-md-2 col-sm-12 col-xs-12 form-group">Fecha *</label>
  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::date('fecha',$fecha,['class'=>'form-control has-feedback-left']) !!}
  </div>
  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
  <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-default">
    Buscar
  </button>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
    <h4 class="StepTitle">Detalles *</h4>
    <table class="table" id="tablaDetalle">
      <thead>
        <tr>
          <th>Cantidad</th>
          <th>Código</th>
          <th colspan="2">Producto</th>
          <th>Opciones</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@include('Requisiciones.Formularios.modalRequisicion')
  <center>
    <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
