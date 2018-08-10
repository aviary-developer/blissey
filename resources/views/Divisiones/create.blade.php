@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'divisiones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>División
              <small class="label-white badge blue ">Nueva</small>
          </h3>
        </center>
      </div>
    </div>
    @include('divisiones.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
