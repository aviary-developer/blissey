<?php $bandera=2;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Presentaciones.Barra.create')
  {!!Form::model($presentacion,['class' =>'form-horizontal form-label-left input_mask','route' =>['presentaciones.update',$presentacion->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Presentaciones.Formularios.form')
  </div>
  {!!Html::script('js/scripts/Presentaciones.js')!!}
  {!!Form::close()!!}
@endsection
