@extends('principal')
@section('layout')
	@include('errors.barra')
	<center class="pt-5">
		<span style="font-size:900%" class="alert-danger bg-transparent fas fa-exclamation-triangle pb-4"></span>
		<h1 class="font-weight-bold text-danger">¡UPPS! Lo sentimos</h1>
		<p class="font-lg col-7 alert-danger bg-transparent">Tal parece que hay un error en la sentencia que se desea ejecutar. Es posible que se ingresara un valor incorrecto, para mayor información contacte con el desarrollador.</p>
		<i>Error QueryException</i>
	</center>
@endsection

