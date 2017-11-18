<div class="x_content">
  <div class="form_wizard wizard_horizontal" id="wizard">
    <ul class="wizard_steps">
      <li>
        <a href="#step-1">
          <span class="step_no">
            <i class="fa fa-hospital-o"></i>
          </span>
          <span class="step_descr">
            Paso 1 <br>
            <small>Datos del hospital</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-2">
          <span class="step_no">
            <i class="fa fa-flask"></i>
          </span>
          <span class="step_descr">
            Paso 2 <br>
            <small>Datos del laboratorio clínico</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-3">
          <span class="step_no">
            <i class="fa fa-stethoscope"></i>
          </span>
          <span class="step_descr">
            Paso 3 <br>
            <small>Datos de la clínica</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-4">
          <span class="step_no">
            <i class="fa fa-medkit"></i>
          </span>
          <span class="step_descr">
            Paso 4 <br>
            <small>Datos de la farmacia</small>
          </span>
        </a>
      </li>
    </ul>
    <div id="step-1">
      <h4 class="StepTitle">Datos del hospital</h4>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Código *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('codigo_hospital',null,['class'=>'form-control has-feedback-left','placeholder'=>'Código del hospital']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('nombre_hospital',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del hospital']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('telefono_hospital',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
            {!! Form::textarea('direccion_hospital',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del hospital','rows'=>'3']) !!}
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Logo *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-camera form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('foto',['id'=>'foto','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="">
          <center>
            <output id="list">
              @if ($create)
                <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 200px">
              @else
                <img src={{asset(Storage::url($usuarios->foto))}} style="height : 200px">
              @endif
            </output>
          </center>
        </div>
      </div>
    </div>
    <div id="step-2">

    </div>
    <div id="step-3">

    </div>
    <div id="step-4">

    </div>
  </div>
</div>
