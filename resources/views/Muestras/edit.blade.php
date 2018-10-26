@extends('principal')
@section('layout')
	@php
		$create = false;
	@endphp
	@include('Muestras.Barra.create')
  {!!Form::model($muestras,['class' =>'form-horizontal form-label-left input_mask','route' =>['muestras.update',$muestras->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Muestras.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
