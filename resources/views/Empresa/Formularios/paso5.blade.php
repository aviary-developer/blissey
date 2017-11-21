<div class="row">
	<div class="col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label class="col-md-12 col-sm-12 col-xs-12">Logo de Hospital *</label>
		</div>
		<div class="">
			<center>
				<output id="list" class="col-sm-12 col-xs-12">
					@if ($create)
					<img src={{asset(Storage::url( 'noImgen.jpg'))}} style="height : 200px; width: 200px; object-fit: contain;"> @else
					<img src={{asset(Storage::url($empresa->logo_hospital))}} style="height : 200px; width: 200px; object-fit: contain;"> @endif
				</output>
			</center>
		</div>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<span class="fa fa-hospital-o form-control-feedback left" aria-hidden="true"></span>
				{!! Form::file('logo_hospital',['id'=>'logo_hospital','class'=>'form-control has-feedback-left']) !!}
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label class="col-md-12 col-sm-12 col-xs-12">Logo de Laboratorio *</label>
		</div>
		<div class="">
			<center>
				<output id="list2">
					@if ($create)
					<img src={{asset(Storage::url( 'noImgen.jpg'))}} style="height : 200px; width: 200px; object-fit: contain;"> @else
					<img src={{asset(Storage::url($empresa->logo_laboratorio))}} style="height : 200px; width: 200px; object-fit: contain;"> @endif
				</output>
			</center>
		</div>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<span class="fa fa-flask form-control-feedback left" aria-hidden="true"></span>
				{!! Form::file('logo_laboratorio',['id'=>'logo_laboratorio','class'=>'form-control has-feedback-left']) !!}
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label class="col-md-12 col-sm-12 col-xs-12">Logo de Clínica *</label>
		</div>
		<div class="">
			<center>
				<output id="list3">
					@if ($create)
					<img src={{asset(Storage::url( 'noImgen.jpg'))}} style="height : 200px; width: 200px; object-fit: contain;"> @else
					<img src={{asset(Storage::url($empresa->logo_clinica))}} style="height : 200px; width: 200px; object-fit: contain;"> @endif
				</output>
			</center>
		</div>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<span class="fa fa-stethoscope form-control-feedback left" aria-hidden="true"></span>
				{!! Form::file('logo_clinica',['id'=>'logo_clinica','class'=>'form-control has-feedback-left']) !!}
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label class="col-md-12 col-sm-12 col-xs-12">Logo de Farmacia *</label>
		</div>
		<div class="">
			<center>
				<output id="list4">
					@if ($create)
					<img src={{asset(Storage::url( 'noImgen.jpg'))}} style="height : 200px; width: 200px; object-fit: contain;"> @else
					<img src={{asset(Storage::url($empresa->logo_farmacia))}} style="height : 200px; width: 200px; object-fit: contain;"> @endif
				</output>
			</center>
		</div>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<span class="fa fa-medkit form-control-feedback left" aria-hidden="true"></span>
				{!! Form::file('logo_farmacia',['id'=>'logo_farmacia','class'=>'form-control has-feedback-left']) !!}
			</div>
		</div>
	</div>
</div>