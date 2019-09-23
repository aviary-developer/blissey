<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>

<div class="x_panel">
	<div class="form-group col-sm-6">
    <label class="" for="nombre_examen">Nombre *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
      </div>
      {!! Form::text(
				'nombreExamen',
				null,
				['id'=>'nombre_examen',
				'class'=>'form-control form-control-sm',
				'placeholder'=>'Nombre del nuevo examen']) !!}
    </div>
	</div>
	
	<div class="form-group col-sm-6">
    <label class="" for="area_select">Área del examen *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-tint"></i></div>
      </div>
      <select class="form-control form-control-sm" name="area" id="area_select">
        <option value="HEMATOLOGIA">Hematología</option>
        <option value="EXAMENES DE ORINA">Uroanálisis</option>
        <option value="EXAMENES DE HECES">Coprología</option>
        <option value="BACTERIOLOGIA">Bacteriología</option>
        <option value="QUIMICA SANGUINEA">Química sanguínea</option>
        <option value="INMUNOLOGIA">Inmunología</option>
        <option value="ENZIMAS">Enzimas</option>
        <option value="PRUEBAS ESPECIALES">Pruebas especiales</option>
        <option value="OTROS">Otros</option>
			</select>
    </div>
	</div>
	
	<div class="form-group col-sm-6">
    <label class="" for="tipo_muestra_select">Tipo de muestra *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-tint"></i></div>
      </div>
      <select class="form-control form-control-sm" name="tipoMuestra" id="tipo_muestra_select" >
				@foreach ($muestras as $muestra)
					<option value={{ $muestra->id }}>{{ $muestra->nombre }}</option>
				@endforeach
			</select>
    </div>
	</div>

	<div class="form-group col-sm-6">
    <label class="" for="precio_campo">Precio ($) *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-money-bill-alt"></i></div>
      </div>
      {!! Form::number(
				'precio',
				null,
				['id'=>'precio_campo',
				'class'=>'form-control form-control-sm',
				'placeholder'=>'Precio del examen en dólares',
				'step'=>'0.01']) 
			!!}
    </div>
	</div>

	<center>
		<div class="">
			<label>
				<input type="checkbox" name="checkImagenExamen" id="checkImagenExamen" class="js-switch" unchecked /> ¿Almacenará imagen?
			</label>
		</div>
	</center>
</div>

<div class="x_panel" id="panel_seccion">
	<div class="btn-success col-sm-3 btn" style="height: 130px; margin: 0px;" id="agregar_seccion_x" data-toggle="modal" data-target="#modal1" >
		<center>
			<i class="fa fa-plus-circle" style="font-size: 450%; margin: 15px;"></i>
			<div style="margin-bottom: 10px;">
				<span class="badge badge-light text-success col-sm-12" >
					Agregar sección
				</span>
			</div>
		</center>
	</div>
</div>

<div class="x_panel">
	<center>
		<button type="button" name="" class="btn btn-sm btn-primary" id="guardar_examen">Guardar</button>
		<a href={!! asset('/examenes') !!} class="btn btn-sm btn-light">Cancelar</a>
	</center>
</div>

{{-- Modal --}}
@include('Examenes.Formularios.modales.modal_i')
@include('Examenes.Formularios.modales.modal_p')
@include('Examenes.Formularios.modales.modal_r')
@include('Examenes.Formularios.modales.modal_m')
@include('Examenes.Formularios.modales.modal_s')
