@extends('dashboard')
@section('layout')
  {!!Form::model($caja,['class' =>'form-horizontal form-label-left input_mask','route' =>['cajas.update',$caja->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Caja
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Cajas.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
