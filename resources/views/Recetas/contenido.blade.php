@extends('PDF.hoja')
@section('layout')
  <div class="row" style="margin-top: 10px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
      <center>
        <h3>Receta médica</h3>
      </center>
    </div>
    <div class="col-xs-3">
      <div class="row">
        <center>
          <img src={{'data:image/png;base64,' . DNS1D::getBarcodePNG($consulta->recetas[0]->barcode, "C128",2,30,array(1,1,1),true)}} alt="barcode"/>
        </center>
      </div>
      <div class="row">
        <center>
          {{$consulta->recetas[0]->barcode}}
        </center>
      </div>
    </div>
  </div>
@endsection