@extends('principal')
@section('layout')
@include('Calendario.barra')
<div class="col-sm-12">
  <div class="x_panel">
    <div id="calendar"></div>
  </div>
  
  @include('Calendario.create')
	@include('Calendario.update')
</div>
{!!Html::script('js/scripts/Calendario.js')!!}
@endsection