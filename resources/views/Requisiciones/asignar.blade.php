@extends('dashboard')
@section('layout')
{!! Form::model($transaccion,['route'=>['requisiciones.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','id'=>'formAsignar','autocomplete'=>'off']) !!}
  <div class="col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Requisición<small>Asignar ubicación</small></h2>
          <div class="clearfix"></div>
        </div>
        @include('Requisiciones.Formularios.formAsignar')
      </div>
  <center>
</center>
</div>
{!!Form::close()!!}
@endsection
