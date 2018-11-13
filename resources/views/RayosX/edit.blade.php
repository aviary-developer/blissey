@extends('principal')
@section('layout')
	@php
		$create = false;
	@endphp
	@include('RayosX.Barra.create')
  {!!Form::model($rayox,['class' =>'form-horizontal form-label-left input_mask','route' =>['rayosx.update',$rayox->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('RayosX.Formularios.form')
  </div>
	{!!Form::close()!!}
	<input type="hidden" id="method" value="edit">
@endsection
