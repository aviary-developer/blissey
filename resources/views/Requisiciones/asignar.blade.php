@extends('dashboard')
@section('layout')
{!! Form::model($transaccion,['route'=>['requisiciones.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','id'=>'formAsignar','autocomplete'=>'off']) !!}
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Requisición
              <small class="label-white badge green ">Asignar ubicación</small>
          </h3>
        </center>
      </div>
    </div>
    <div class="x_panel">
      @include('Requisiciones.Formularios.formConfirm')
    </div>
</div>
{!!Form::close()!!}
@endsection
