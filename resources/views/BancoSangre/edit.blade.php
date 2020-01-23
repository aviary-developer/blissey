@extends('principal')
@section('layout')
	@php
		$fecha = $donacion->fechaVencimiento;
		$tipeo= $donacion->tipoSangre;
		$create = false;
	@endphp
	@include('BancoSangre.Barra.create')
  {!!Form::model($donacion,['class' =>'form-horizontal form-label-left input_mask','route' =>['bancosangre.update',$donacion->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="flex-row">
		@include('BancoSangre.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
