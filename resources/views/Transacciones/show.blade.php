@extends('dashboard')
@section('layout')
  @php
  $index = false;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-11 col-sm-11 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          @if($transaccion->tipo==1)
            <h3>Pedido
                <small class="label-white badge green ">Confirmado</small>
            </h3>
          @endif
          @if($transaccion->tipo==2)
        <h3>Venta
            <small class="label-white badge green ">Realizada</small>
        </h3>
      @endif
    @if($transaccion->tipo==3)
        <h3>Venta
          <small class="label-white badge red ">Anulada</small>
        </h3>
    @endif
        </center>
              {{-- @include('Productos.Formularios.activate') --}}
    </div>
    <div class="row">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li>
              <a href={!! asset('/transacciones?tipo='.$transaccion->tipo)!!}><i class="fa fa2 fa-arrow-left"></i> Atras</a>
            </li>
            @if($transaccion->tipo==1)
              <li>
                <a href={!! asset('/devoluciones/'.$transaccion->id)!!}><i class="fa fa2 fa-undo"></i> Devoluciones</a>
              </li>
            @endif
            <li>
              <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
          </div>
        </div>
        {{-- Incio de tab --}}
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <div class="col-xs-3">
            <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
              <li role="presentation" class="active">
                <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos del pedido</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Detalle</a>
              </li>
              @if (App\Devolucion::devolucion($transaccion->id)>0)
                <li role="presentation" class="">
                  <a href="#tab_content3" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Devolucines</a>
                </li>
              @endif
            </ul>
          </div>
          {{-- Contenido del tab --}}
          <div class="col-xs-9">
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
                <h3>Datos del pedido</h3>
                <table class="table">
                  <tr>
                      <th>Fecha</th>
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
              {{-- Otra pestaña --}}
              <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                <h3>Detalle</h3>
                <table class="table">
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
                    @php
                      $total=$total-($total*($transaccion->descuento/100));
                    @endphp
                    <tr>
                      <td colspan='{{$aux}}'><div style="text-align:right;">Total:  $ {{number_format($total,2,'.','.')}}</div></td>
                    </tr>
                  @endif
                  @if($transaccion->tipo==1)
                    <tr>
                    @if($transaccion->iva)
                      <td colspan='{{$aux}}'><div style="text-align:right;">IVA incluido:  $ {{number_format(($total*0.13)/1.13,2,'.','.')}}</div></td>
                    @else
                      <td colspan='{{$aux}}'><div style="text-align:right;">IVA no incluido:  $ {{number_format(($total*0.13),2,'.','.')}}</div></td>
                    @endif
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="tab_content3" aria-labelledby="otros-tab2">
                <h3>Devoluciones realizadas</h3>
                <table class="table">
                  <thead>
                    <th>Cantidad</th>
                    <th colspan="2">Detalle</th>
                  </thead>
                  <tbody>
                    @foreach($detalles as $detalle)
                      @php
                        $conteo=App\DetalleDevolucion::where('f_detalle_transaccion',$detalle->id)->sum('cantidad');
                      @endphp
                      @if ($conteo!=0)
                      <tr>
                        <td>{{$conteo}}</td>
                        <td>
                          @if($detalle->divisionProducto->unidad==null)
                            {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                          @else
                            {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                          @endif
                        </td>
                        <td>{{$detalle->divisionProducto->producto->nombre}}</td>
                      </tr>
                      @endif
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
  </div>
@endsection
