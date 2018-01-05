<div class="form-group">
  <label class="control-label">Contraseña actual</label>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
    {!! Form::password('current_pass',['id'=>'current_pass','class'=>'form-control has-feedback-left','placeholder'=>'Contraseña actual']) !!}
  </div>
</div>
<br>
<div class="form-group">
  <label class="control-label">Contraseña nueva</label>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
    {!! Form::password('new_pass',['id'=>'new_pass','class'=>'form-control has-feedback-left','placeholder'=>'Contraseña nueva']) !!}
  </div>
</div>
<div class="form-group">
  <label class="control-label">Repita la contraseña nueva</label>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
    {!! Form::password('new_pass_r',['id'=>'new_pass_r','class'=>'form-control has-feedback-left','placeholder'=>'Contraseña nueva']) !!}
  </div>
</div>