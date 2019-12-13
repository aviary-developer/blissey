@extends('principal')
@section('layout')
	@include('errors.barra')
	<center class="pt-5">
		<span style="font-size:900%" class="alert-danger bg-transparent fas fa-exclamation-triangle pb-4"></span>
		<h1 class="font-weight-bold text-danger">¡UPPS! Lo sentimos</h1>
		<p class="font-lg col-7 alert-danger bg-transparent">Tal parece que a la página que desea acceder no tiene toda la información necesaría. Es posible que requiera datos que dependan de otros usuarios, para mayor información contacte con el desarrollador.</p>
		<i>Error B001</i>
	</center>
@endsection