<div class="row mt-2">
        <div class="col">
          <center>
            <h5 class="mt-1">Detalles</h5>
          </center>
        </div>
      </div>
      <div class="ln_solid mt-3"></div>
      <div class="row">
        <div class="col-sm-12">
          <table class="table table-hover table-sm table-striped">
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
                            @if($transaccion->tipo==1)
                            <th>Descuento</th>
                            @endif
                            <th>Subtotal</th>
                        </thead>      
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
                            <td>
                              @if($detalle->servicio->categoria->nombre=="Ultrasonografía" || $detalle->servicio->categoria->nombre=="TAC" || $detalle->servicio->categoria->nombre=="Rayos X")
                            {{$detalle->servicio->categoria->nombre." "}}
                          @endif
                              {{$detalle->servicio->nombre}}</td>
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
                            $descontado=$detalle->precio-($detalle->precio*($detalle->descuento/100));
                          @endphp
                          <td>$ {{number_format($detalle->precio,2,'.','.')}}</td>
                          @if($transaccion->tipo==1)
                          <td>{{$detalle->descuento}}%</td>
                          @endif
                          <td>$ {{number_format($detalle->cantidad*$descontado,2,'.','.')}}</td>
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
      </div>