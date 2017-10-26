@extends('dashboard')
@section('layout')
  {!!Form::model($productos,['class' =>'form-horizontal form-label-left input_mask','route' =>['productos.update',$productos->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $create = false;
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Producto<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Productos.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
