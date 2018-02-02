@extends('PDF.hoja')
@section('layout')
  @include('Ingresos.PDF.acta.pagina1')
  @include('Ingresos.PDF.acta.pagina2')
  @include('Ingresos.PDF.acta.pagina3')
  @include('Ingresos.PDF.acta.pagina4')
@endsection