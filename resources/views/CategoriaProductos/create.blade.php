<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('CategoriaProductos.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'categoria_productos.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('CategoriaProductos.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Html::script('js/scripts/CategoriaProductos.js')!!}
  {!!Form::close()!!}
@endsection
