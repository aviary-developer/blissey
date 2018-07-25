@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-10 col-sm-10 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>
        Arqueo
        <small>
          Movimientos
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          {{-- @include('Componentes.Formularios.activate') --}}
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Movimientos</a>
            </li>
          </ul>
        </div>
        {{-- Contenido del tab --}}
        <div class="col-xs-10">
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
              <h3>Información General</h3>
              <table class="table">
                <tr>
                  <th>Caja</th>
                  <td>{{ $detalle->datosCaja->nombre}}</td>
                </tr>
                <tr>
                  <th>Localización</th>
                  <td>@if($detalle->datosCaja->localizacion)
                    <span class="label label-primary label-lg col-xs-8">Recepción</span>
                  @else
                    <span class="label label-success label-lg col-xs-8">Farmacia</span>
                  @endif</td>
                </tr>
                <tr>
                  <th>Fecha y hora de apertura</th>
                  <td>{{ $detalle->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Valor inicial</th>
                  <td>$ {{$detalle->importe}}</td>
                </tr>
                <tr>
                  <th>Valor actual</th>
                  <td></td>
                </tr>
              </table>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              <h3>Operaciones efectuadas este día</h3>
              <table class="table">
                @php
                  $contador=1;
                @endphp
                @if (count($movimientos)>0)
                <tr>
                  <th>#</th>
                  <th>Número de factura</th>
                  <th>Tipo</th>
                  <th>Hora</th>
                  <th>Entrada</th>
                  <th>Salida</th>
                </tr>
                  @foreach ($movimientos as $movimiento)
                    <tr>
                      <td>{{$contador}}</td>
                      <td>{{$movimiento->factura}}</td>
                      <td>{{App\Transacion::tipo($movimiento->tipo)}}</td>
                      <td>{{date_format($movimiento->created_at,'g:i A')}}</td>
                  </tr>
                  @php
                  $contador++;
                  @endphp
                  @endforeach
                @else
                  <tr><td colspan="2">
                    <center>
                      No hay productos asociados a este componente
                    </center>
                  </td></tr>
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
