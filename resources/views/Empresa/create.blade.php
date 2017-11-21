@extends('dashboard') @section('layout') {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'grupo_promesa.store','method'
=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!} @php $fecha = Carbon\Carbon::now(); $create = true;
@endphp
<div class="col-md-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Grupo Promesa
				<small>Datos</small>
			</h2>
			<div class="clearfix"></div>
		</div>
		@include('Empresa.Formularios.form')
	</div>
</div>
{!!Form::close()!!} @endsection