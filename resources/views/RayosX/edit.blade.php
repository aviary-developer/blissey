@extends('dashboard')
@section('layout')
  {!!Form::model($ultrasonografia,['class' =>'form-horizontal form-label-left input_mask','route' =>['ultrasonografias.update',$ultrasonografia->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $create = false;
  @endphp
  <div class="col-md-7 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Donación<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Ultrasonografias.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
