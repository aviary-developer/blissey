@extends('principal')
@section('layout')
  {!!Form::open(['id'=>'examen_form','class' =>'form-horizontal form-label-left input_mask','route' =>'examenes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
	@endphp
	
	@include('Examenes.Barra.create')
  <div class="col-sm-10">
		@include('Examenes.Formularios.form2')
  </div>
  {!!Form::close()!!}
@endsection