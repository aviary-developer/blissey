<div class="row">
  <h5 class="big-text">Consulta médica</h5>
</div>
<div class="row" style="height: 450px;">
  <div id="div_previo">
    <center style="margin-top: 200px;">
      <button type="button" id="cambio_div_consulta" class="btn btn-primary btn-lg">Nueva Consulta</button>
    </center>
  </div>
  <div id="div_consulta" style="display: none">
    <form action="" class="form-horizontal input_mask">
      <div class="form-group">
        <label class="col-xs-12">Consulta por *</label>
        <div class="col-xs-12">
          <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
          {!! Form::textarea('motivo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Motivo por el que pasa consulta','rows'=>'2', 'id' => 'motivo']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="col-xs-12">Historia clínica *</label>
        <div class="col-xs-12">
          <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
          {!! Form::textarea('historia',null,['class'=>'form-control has-feedback-left','placeholder'=>'Signos y sintomas','rows'=>'4', 'id'=> 'historia']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="col-xs-12">Examen físico *</label>
        <div class="col-xs-12">
          <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
          {!! Form::textarea('examen_fisico',null,['class'=>'form-control has-feedback-left','placeholder'=>'Examen físico y signos vitales','rows'=>'3', 'id'=> 'ex_fisico']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="col-xs-12">Diagnostico *</label>
        <div class="col-xs-12">
          <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
          {!! Form::textarea('diagnostico',null,['class'=>'form-control has-feedback-left','placeholder'=>'Diagnostico clínico','rows'=>'2', 'id'=> 'diagnostico']) !!}
        </div>
      </div>
      <center style="margin-top: 10px">
        <button type="button" class="btn-sm btn-primary btn" data-toggle="modal" data-target="#receta">Tratamiento</button>
        <button type="button" class="btn-sm btn-default btn" id="cancelar_consulta">Cancelar</button>
      </center>
    </form>
  </div>
</div>
@include('Ingresos.dashboard.modales.receta')