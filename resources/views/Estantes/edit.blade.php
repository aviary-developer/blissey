<?php $bandera=2;?>
@extends('principal')
@section('layout')
  @include('Estantes.Barra.create')
  {!!Form::model($estante,['class' =>'form-horizontal form-label-left input_mask','route' =>['estantes.update',$estante->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Estantes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
