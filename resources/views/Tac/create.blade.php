@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now();
		$create = true;
	@endphp
	@include('Tac.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'tacs.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-md-7 col-xs-12">
		@include('Tac.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
