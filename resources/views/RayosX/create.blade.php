@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now();
		$create = true;
	@endphp
	@include('RayosX.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'rayosx.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('RayosX.Formularios.form')
  </div>
	{!!Form::close()!!}
	<input type="hidden" id="method" value="create">
@endsection
