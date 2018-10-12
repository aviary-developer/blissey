<?php $bandera=2;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Componentes.Barra.create')
  {!!Form::model($componente,['class' =>'form-horizontal form-label-left input_mask','route' =>['componentes.update',$componente->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Componentes.Formularios.form')
  </div>
  {!!Html::script('js/scripts/Componentes.js')!!}
  {!!Form::close()!!}
@endsection
