@extends('principal')
@section('layout')
	@php
		$fecha = $parametros->fechaNacimiento;
		$create=false;
	@endphp
	@include('Parametros.Barra.create')
  {!!Form::model($parametros,['class' =>'form-horizontal form-label-left input_mask','route' =>['parametros.update',$parametros->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Parametros.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
