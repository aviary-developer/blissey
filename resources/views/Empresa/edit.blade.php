@extends('dashboard') @section('layout') 
{!! Form::model($empresa, ['class' =>'form-horizontal form-label-left input_mask','route' =>['grupo_promesa.update',$empresa->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data']) !!}

@php 
  $fecha = Carbon\Carbon::now(); 
  $create = false;
@endphp
<div class="col-md-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Grupo Promesa
				<small>Editar</small>
			</h2>
			<div class="clearfix"></div>
		</div>
    <div class="x_content">
      <input type="hidden" name="telefono_eliminados[]" value="ninguno" id="telefono_eliminados">
      @if($seccion==1)
        @include('Empresa.Formularios.paso1')
      @elseif($seccion==2)  
        @include('Empresa.Formularios.paso2')
      @elseif($seccion==3)  
        @include('Empresa.Formularios.paso3')
      @elseif($seccion==4)  
        @include('Empresa.Formularios.paso4')
      @else  
        @include('Empresa.Formularios.paso5')
      @endif
      <div class="ln_solid"></div>
      <div class="form-group">
        <center>
          {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
          <a href={!! asset('/grupo_promesa') !!} class="btn btn-default">Cancelar</a>
        </center>
      </div>
    </div>
	</div>
</div>
{!!Form::close()!!} @endsection