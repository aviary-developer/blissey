<div style="height: 300px;">
	<h4>Datos del hospital</h4>
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
        <div class="input-group">
          {!! Form::text('telefono_hospital_input',null,['id'=>'telefono_hospital','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
          <span class="input-group-btn">
            <button type="button" name="button" class="btn btn-primary" id="agregar_telefono_hospital">
              <i class="fa fa-save"></i>
            </button>
          </span>
        </div>
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
    <table class="table" id='tabla_telefono_hospital'>
      <thead>
        <th>Teléfono</th>
        <th style="width : 80px">Acción</th>
      </thead>
      <tbody>
        @if (!$create)
          @foreach ($telefonos as $key => $telefono)
						@if($telefono->tipo == 'hospital')								
							<tr>
								<td>{{$telefono->telefono}}</td>
								<td>
									<input type="hidden" id={{"telefono".$key}} value={{ $telefono->id }}>
									<button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_telefono_antiguo">
										<i class="fa fa-remove"></i>
									</button>
								</td>
							</tr>
						@endif
        	@endforeach
      	@endif
    	</tbody>
  	</table>
	</div>
</div>
<center>
	<p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
</center>
