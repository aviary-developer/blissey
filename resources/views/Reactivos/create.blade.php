@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now()->addMonths(1);
		$create=true;
		$ruta = '/reactivos';
	@endphp
	@include('Reactivos.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'reactivos.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Reactivos.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
