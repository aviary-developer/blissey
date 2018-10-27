@extends('principal')
@section('layout')
	@php
		$create = false;
	@endphp
	@include('CategoriaServicios.Barra.create')
  {!!Form::model($categoria_servicios,['class' =>'form-horizontal form-label-left input_mask','route' =>['categoria_servicios.update',$categoria_servicios->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('CategoriaServicios.Formularios.form')
	</div>
	<input type="hidden" id="method" value="edit">
  {!!Form::close()!!}
@endsection
