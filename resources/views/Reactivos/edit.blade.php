@extends('dashboard')
@section('layout')
<!-- page content -->
<!--Panel-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Reactivos<small>Editar</small></h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="btn-group">
          <button class="btn btn-success" type="button" data-toggle="modal" data-target=".modal-new">Nuevo</button>
          <button class="btn btn-default" type="button">Pantalla1</button>
          <button class="btn btn-default" type="button">Pantalla2</button>
          <button class="btn btn-default" type="button">Pantalla3</button>
          <button class="btn btn-default" type="button">Reporte</button>
          <button class="btn btn-danger" type="button">Papelera</button>
          <button class="btn btn-info" type="button">Ayuda</button>
        </div>
      </div>
      <br>
      {!! Form::model($reactivos, ['route'=> ['reactivos.update', $reactivos->id],'method'=>'PUT']) !!}
@include('Reactivos.Formularios.reactivo')
{!! Form:: submit('Actualizar reactivo',['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}
    </div>
  </div>
</div>
<!-- /page content -->
@stop
