@php
  setlocale(LC_ALL,'es');
@endphp
@extends('dashboard')
@section('layout')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          @if($transaccion->tipo==1)
            <h2>Pedido<small>Confirmado</small></h2>
          @endif
          @if($transaccion->tipo==2)
        <h2>Venta<small>Realizada</small></h2>
      @endif
    @if($transaccion->tipo==3)
        <h2>Venta<small>Anulada</small></h2>
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
                  <tr style="color: red;">
                    @if ($transaccion->tipo==3)
                      <th>Motivo de la anulación</th>
                      <td>{{$transaccion->comentario}}</td>
                    @endif
                  </tr>
                </table>
              </div>
              {{-- Detalles --}}
              <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                <table class="table table-striped">
                  <thead>
                    <th>Cantidad</th>
                    <th colspan='2'>Detalle</th>
                    @if($transaccion->tipo==1)
                    <th>Fecha de vencimiento</th>
                  @endif
                    @if(!$transaccion->tipo)
                    <th>Lote</th>
                      @endif
                      <th>Precio unitario</th>
                      <th>Descuento</th>
                      <th>Subtotal</th>
                  </thead>
                  @php
                  $detalles=$transaccion->detalleTransaccion;
                  $total=0;
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

                      @if($transaccion->tipo==1)
                      <td>{{$detalle->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
                    @endif
                    @if(!$transaccion->tipo)
                      @php
                        $aux=8;
                      @endphp
                      <td>{{$detalle->lote}}</td>
                    @else
                      @php
                        $aux=7;
                      @endphp
                    @endif
                    @php
                      $descontado=number_format($detalle->precio-($detalle->precio*($detalle->descuento/100)),2,'.','.');
                    @endphp
                    <td>$ {{number_format($detalle->precio,2,'.','.')}}</td>
                    <td>{{$detalle->descuento}}%</td>
                    <td>{{number_format($detalle->cantidad*$descontado,2,'.','.')}}</td>
                    @php
                    $total=$total+($detalle->cantidad*$descontado);
                    @endphp
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan='{{$aux}}'><div style="text-align:right;">
                      @if ($transaccion->descuento>0)(Descuento general {{$transaccion->descuento}}%)
                      @else Total:
                      @endif
                          $ {{number_format($total,2,'.','.')}}</div></td>
                  </tr>
                  @if ($transaccion->descuento>0)
                    <tr>
                      <td colspan='{{$aux}}'><div style="text-align:right;">Total:  $ {{number_format($total-($total*($transaccion->descuento/100)),2,'.','.')}}</div></td>
                    </tr>
                  @endif
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
