@extends('principal')
@section('layout')
	@include('Requisiciones.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'requisiciones.store','method' =>'POST','id'=>'form'])!!}
	@php
		if(!isset($fecha)){
		$fecha = Carbon\Carbon::now();
		}
		$pantalla=1;//Crear
	@endphp
  <div class="col-sm-12">
		@include('Requisiciones.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
