<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Productos.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'productos.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  {{-- <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Producto
              <small class="label-white badge blue ">Nuevo</small>
          </h3>
        </center>
      </div>
      @include('Productos.Formularios.opciones')
    </div>
    @include('Productos.Formularios.form')
  </div> --}}
  <div class="col-sm-12">
    @include('Productos.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Form::close()!!}
@endsection
@section('agregarjs')
{!!Html::script('js/scripts/Proveedores.js')!!}
@endsection
