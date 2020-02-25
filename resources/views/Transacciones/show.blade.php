@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
    $detalles=$transaccion->detalleTransaccion;
    $total=0;
  @endphp
  @include('Transacciones.Barra.show')
<div class="col-sm-8"> 
    <div class="x_panel">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
              Detalle
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
              Devoluciones
            </a>
          </li>
          @if($transaccion->tipo!=2)
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#next" role="tab" aria-controls="profile" aria-selected="false">
              Salidas
            </a>
          </li>
          @endif
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              @include('Transacciones.Partes.datos_productos')
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              @include('Transacciones.Partes.datos_devoluciones')
          </div>
          <div class="tab-pane fade" id="next" role="tabpanel" aria-labelledby="profile-tab">
            @include('Transacciones.Partes.datos_salida')
        </div>
        </div>
    </div>   
</div>
<div class="col-sm-4">
  @include('Transacciones.Partes.datos_transaccion')
</div>
@endsection