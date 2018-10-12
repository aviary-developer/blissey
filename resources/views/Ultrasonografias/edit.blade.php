@extends('principal')
@section('layout')
  @php
    $create = false;
  @endphp
  @include('Ultrasonografias.Barra.create')
  {!!Form::model($ultrasonografia,['class' =>'form-horizontal form-label-left input_mask','route' =>['ultrasonografias.update',$ultrasonografia->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Ultrasonografias.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
