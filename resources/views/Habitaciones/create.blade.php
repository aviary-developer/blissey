@extends('principal')
@section('layout')
	@php
		$create = true;
		$ruta = '/habitaciones';
	@endphp
	@include('Habitaciones.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'habitaciones.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-5">
        <div class="x_panel" style="height:363px">
          @include('Habitaciones.Formularios.habitacion')
        </div>
      </div>
      <div class="col-sm-7">
        <div class="x_panel">
          @include('Habitaciones.Formularios.camas')
        </div>
      </div>
    </div>
    <div class="x_panel">
      <div class="flex-row">
        <center>
          <button type="button" class="btn btn-sm btn-primary" id="save_me">Guardar</button>
          <a href={!! asset($ruta) !!} class="btn btn-light btn-sm">Cancelar</a>
        </center>
      </div>
    </div>
  </div>
  <input type="hidden" id="count_hi" value={{$count_hi}}>
  <input type="hidden" id="count_ho" value={{$count_ho}}>
  <input type="hidden" id="count_hm" value={{$count_hm}}>
  <input type="hidden" id="count_ci" value={{$count_ci}}>
  <input type="hidden" id="count_co" value={{$count_co}}>
  <input type="hidden" id="count_cm" value={{$count_cm}}>
	{!!Form::close()!!}
	{!!Html::script('js/scripts/Habitacion.js')!!}
@endsection
