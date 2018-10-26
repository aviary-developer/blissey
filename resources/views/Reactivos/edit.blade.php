@extends('principal')
@section('layout')
	@php
		$fecha = $reactivos->fechaNacimiento;
		$create=false;
		$ruta = '/reactivos';
	@endphp
	@include('Reactivos.Barra.create')
  {!!Form::model($reactivos,['class' =>'form-horizontal form-label-left input_mask','route' =>['reactivos.update',$reactivos->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Reactivos.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
