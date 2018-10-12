<?php $bandera=2;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Divisiones.Barra.create')
  {!!Form::model($division,['class' =>'form-horizontal form-label-left input_mask','route' =>['divisiones.update',$division->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Divisiones.Formularios.form')
  </div>
  {!!Html::script('js/scripts/Divisiones.js')!!}
  {!!Form::close()!!}
@endsection
