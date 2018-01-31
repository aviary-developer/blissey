@php
  setlocale(LC_ALL,'es');
@endphp
@extends('dashboard')
@section('layout')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          @if(!$transaccion->tipo)
        <h2>Pedido<small>Confirmado</small></h2>
      @else
        <h2>Venta<small>Realizada</small></h2>
      @endif
        <div class="clearfix"></div>
        <div class="x_content">
          <div class="row">
            Opciones
          </div>
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos del pedido</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Detalle</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              {{-- Datos --}}
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
                <table class="table">
                  <tr>
                      @if(!$transaccion->tipo)
                    <th>Fecha del confirmación</th>
                  @else
                    <th>Fecha de venta</th>
                  @endif
                    <td>{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
                  </tr>
                  <tr>
                    <th>N° de factura</th>
                    <td>{{$transaccion->factura}}</td>
                  </tr>
                  <tr>
                    @if($transaccion->tipo)
                      <th>Cliente</th>
                      @if(count($transaccion->cliente)>0)
                        <td>{{$transaccion->cliente->nombre." ".$transaccion->cliente->apellido}}</td>
                      @else
                        <td>Clientes varios</td>
                      @endif
                    @else
                      <th>Proveedor</th>
                      <td>{{$transaccion->proveedor->nombre}}</td>
                    @endif
                  </tr>
                  <tr>
                    <th>Descuento general</th>
                    <td>{{$transaccion->descuento}}%</td>
                  </tr>
                  <tr>
                    <th>Fecha de creación</th>
                    <td>{{ $transaccion->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                  <tr>
                    <th>Fecha de modificación</th>
                    <td>{{ $transaccion->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                </table>
              </div>
              {{-- Detalles --}}
              <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                <table class="table table-striped">
                  <thead>
                    <th>Cantidad</th>
                    <th colspan='2'>Detalle</th>
                    <th>Descuento</th>
                    @if(!$transaccion->tipo)
                    <th>Fecha de vencimiento</th>
                  @endif
                    <th>Precio</th>
                    @if(!$transaccion->tipo)
                    <th>Lote</th>
                      @endif
                  </thead>
                  @php
                  $detalles=$transaccion->detalleTransaccion;
                  @endphp

                  <tbody>
                  @foreach ($detalles as $detalle)
                    <tr>
                      <td>{{$detalle->cantidad}}</td>
                      @if($detalle->f_servicio==null)
                      <td>
                        @if($detalle->divisionProducto->unidad==null)
                          {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                        @else
                          {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                        @endif
                      </td>
                      <td>{{$detalle->divisionProducto->producto->nombre}}</td>
                    @else
                      <td>{{$detalle->servicio->nombre}}</td>
                      <td></td>
                    @endif
                      <td>{{$detalle->descuento}}%</td>
                      @if(!$transaccion->tipo)
                      <td>{{$detalle->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
                    @endif
                      <td>$ {{number_format($detalle->precio,2,'.','.')}}</td>
                        @if(!$transaccion->tipo)
                      <td>{{$detalle->lote}}</td>
                    @endif
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{!!Form::close()!!}
@endsection
