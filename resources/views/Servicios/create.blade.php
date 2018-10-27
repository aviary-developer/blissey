@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now();
		$create = true;
	@endphp
	@include('Servicios.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'servicios.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Servicios.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
