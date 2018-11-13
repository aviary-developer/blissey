@extends('principal')
@section('layout')
	@php
		$create = false;
	@endphp
	@include('Tac.Barra.create')
  {!!Form::model($tac,['class' =>'form-horizontal form-label-left input_mask','route' =>['tacs.update',$tac->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Tac.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
