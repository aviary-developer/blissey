<div class="row">
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
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección *</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
				{!! Form::textarea('direccion_hospital',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del hospital','rows'=>'3'])
				!!}
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">

	</div>
</div>