<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('Presentaciones.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'presentaciones.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Presentaciones.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Html::script('js/scripts/Presentaciones.js')!!}
  {!!Form::close()!!}
@endsection
