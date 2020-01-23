@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now()->addMonths(1);
		$tipeo= null;
		$create = true;
	@endphp
	@include('BancoSangre.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'bancosangre.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="flex-row">
		@include('BancoSangre.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
