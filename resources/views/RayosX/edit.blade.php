@extends('dashboard')
@section('layout')
  {!!Form::model($rayox,['class' =>'form-horizontal form-label-left input_mask','route' =>['rayosx.update',$rayox->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $create = false;
  @endphp
  <div class="col-md-7 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Rayos X<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('RayosX.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
