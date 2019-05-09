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
                <th colspan="2">Detalle</th>
            </thead>
            <tbody>
              @php
                  $total=0;
              @endphp
                @foreach($detalles as $detalle)
                    @php
                        $conteo=App\DetalleDevolucion::total_filtro($detalle->id,0);
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
                      @php
                            $descontado=$detalle->precio-($detalle->precio*($detalle->descuento/100));
                            $subtotal=$conteo*$descontado;
                            $total=$total+$subtotal;
                      @endphp 
                    @endif
                @endforeach
                @if($total>0)
                  @php
                    $des=App\DetalleTransacion::descuento($transaccion->id);
                            if($des>0){
                              $total=$total-($total*($des/100));
                            }
                            $iva=App\Transacion::find($transaccion->id)->iva;
                            if(!$iva){
                              $total=$total*1.13;
                            }
                  @endphp
                  <tr>
                    <td colspan="3">
                      <div style="text-align:right;">
                        Total: $ {{number_format($total,2,'.','')}}
                      </div>
                    </td>
                  </tr>
                @endif
            </tbody>
      </table>
    </div>
  </div>