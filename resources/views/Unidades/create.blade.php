<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('Unidades.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'unidades.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Unidades.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Html::script('js/scripts/Unidades.js')!!}
  {!!Form::close()!!}
@endsection
