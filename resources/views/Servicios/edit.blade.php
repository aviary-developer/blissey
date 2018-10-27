@extends('principal')
@section('layout')
	@php
		$create = false;
	@endphp
	@include('Servicios.Barra.create')
  {!!Form::model($servicios,['class' =>'form-horizontal form-label-left input_mask','route' =>['servicios.update',$servicios->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Servicios.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
