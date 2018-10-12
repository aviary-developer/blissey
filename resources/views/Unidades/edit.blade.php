<?php $bandera=2;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Unidades.Barra.create')
  {!!Form::model($unidad,['class' =>'form-horizontal form-label-left input_mask','route' =>['unidades.update',$unidad->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Unidades.Formularios.form')
  </div>
  {!!Html::script('js/scripts/Unidades.js')!!}
  {!!Form::close()!!}
@endsection
