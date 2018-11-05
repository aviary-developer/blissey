<div class="row">
  <h5 class="text-success">Consulta médica</h5>
</div>
<div class="col-sm-12" style="min-height: 480px;">
  <div id="div_previo" class="flex-row">
    <center style="margin-top: 200px;">
      <button type="button" id="cambio_div_consulta" class="btn btn-primary btn-lg">Nueva Consulta</button>
    </center>
  </div>
  <div id="div_consulta" style="display: none">
    <form action="" class="form-horizontal input_mask">
      <div class="form-group col-sm-12">
        <label class="" for="motivo">Consulta por *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-edit"></i></div>
          </div>
          {!! Form::textarea(
            'motivo',
            null,
            ['class'=>'form-control form-control-sm',
            'placeholder'=>'Motivo por el que pasa consulta',
            'rows'=>'2', 
            'id' => 'motivo']) !!}
        </div>
      </div>

      <div class="form-group col-sm-12">
        <label class="" for="historia">Historia clínica *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-edit"></i></div>
          </div>
          {!! Form::textarea(
            'historia',
            null,
            ['class'=>'form-control form-control-sm',
            'placeholder'=>'Signos y sintomas',
            'rows'=>'3', 
            'id'=> 'historia']) !!}
        </div>
      </div>

      <div class="form-group col-sm-12">
        <label class="" for="historia">Examen físico *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-edit"></i></div>
          </div>
          {!! Form::textarea(
            'examen_fisico',
            null,
            ['class'=>'form-control form-control-sm',
            'placeholder'=>'Examen físico y signos vitales',
            'rows'=>'3', 
            'id'=> 'ex_fisico']) !!}
        </div>
      </div>

      <div class="form-group col-sm-12">
        <label class="" for="diagnostico">Diagnostico *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-edit"></i></div>
          </div>
          {!! Form::textarea(
            'diagnostico',
            null,
            ['class'=>'form-control form-control-sm',
            'placeholder'=>'Diagnostico clínico',
            'rows'=>'2', 
            'id'=> 'diagnostico']) !!}
        </div>
      </div>

      <div class="col-sm-12">
        <center style="margin-top: 10px">
          <button type="button" class="btn-sm btn-primary btn" id="ver_crear_receta">Tratamiento</button>
          <button type="button" class="btn-sm btn-light btn" id="cancelar_consulta">Cancelar</button>
        </center>
      </div>
    </form>
  </div>
</div>
@include('Ingresos.dashboard.modales.receta')