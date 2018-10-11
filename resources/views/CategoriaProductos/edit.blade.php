<?php $bandera=2;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('CategoriaProductos.Barra.create')
  {!!Form::model($categoria,['class' =>'form-horizontal form-label-left input_mask','route' =>['categoria_productos.update',$categoria->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('CategoriaProductos.Formularios.form')
  </div>
  {!!Html::script('js/scripts/CategoriaProductos.js')!!}
  {!!Form::close()!!}
@endsection
