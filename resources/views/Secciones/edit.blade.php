@extends('principal')
@section('layout')
	@php
		$create = false;
	@endphp
	@include('Secciones.Barra.create')
  {!!Form::model($secciones,['class' =>'form-horizontal form-label-left input_mask','route' =>['secciones.update',$secciones->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('Secciones.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
