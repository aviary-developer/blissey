@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now();
		$create = true;
	@endphp
	@include('Muestras.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'muestras.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Muestras.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
