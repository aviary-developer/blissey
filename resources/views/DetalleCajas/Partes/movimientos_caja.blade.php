<div class="row mt-2">
        <div class="col">
          <center>
            <h5 class="mt-1">Movimentos de caja
            </center>
        </div>
      </div>
      <div class="ln_solid mt-3"></div>
      <div class="row">
        <div class="col-sm-12">
          <table class="table table-hover table-sm table-striped">
                @php
                  $contador=1;
                  $total=$detalle->importe;
                @endphp
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Número de factura</th>
                    <th>Tipo</th>
                    <th>Hora</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                @if ($detalle->importe>0)
                  <tr>
                    <td>{{$contador}}</td>
                    <td></td>
                    <td>Inicio</td>
                    <td>{{date_format($detalle->updated_at,'g:i A')}}</td>
                    <td>$ {{number_format($detalle->importe,2,'.',',')}}</td>
                    <td></td>
                    <td>$ {{number_format($total,2,'.',',')}}</td>
                  </tr>
                  @php
                    $contador++;
                  @endphp
                @endif
                
                  @foreach ($movimientos as $movimiento)
                    <tr>
                      <td>{{$contador}}</td>
                      <td>{{$movimiento->factura}}</td>
                      <td>{{App\Transacion::tipo($movimiento->tipo)}}</td>
                      <td>{{date_format($movimiento->updated_at,'g:i A')}}</td>
                      <td>
                        @if($movimiento->tipo==2)
                          @php
                          $suma=$movimiento->valorTotal($movimiento->id);
                          $total=$total+$suma;
                          @endphp
                          $ {{number_format($suma,2,'.',',')}}
                        @endif
                        @if($movimiento->tipo==8)
                          @php
                          $suma=number_format($movimiento->devolucion,2,'.',',');
                          $total=$total+$suma;
                          @endphp
                          $ {{number_format($suma,2,'.',',')}}
                        @endif
                        @if($movimiento->tipo==12)
                          @php
                          $suma=$movimiento->devolucion;
                          $total=$total+$movimiento->devolucion;
                          @endphp
                        $ {{number_format($suma,2,'.',',')}}
                        @endif
                      </td>
                      <td>
                        @if($movimiento->tipo==1)
                          @php
                          $resta=$movimiento->valorTotal($movimiento->id);
                          $total=$total-$resta;
                          @endphp
                          $ {{number_format($resta,2,'.',',')}}
                        @endif
                        @if($movimiento->tipo==9)
                          @php
                          $resta=number_format($movimiento->devolucion,2,'.',',');
                          $total=$total-$resta;
                          @endphp
                          $ {{number_format($resta,2,'.',',')}}
                        @endif
                        @if($movimiento->tipo==13)
                          @php
                          $resta=$movimiento->devolucion;
                          $total=$total-$resta;
                          @endphp
                          $ {{number_format($resta,2,'.',',')}}
                        @endif
                      </td>
                      <td>$ {{number_format($total,2,'.',',')}}</td>
                  </tr>
                  @php
                  $contador++;
                  @endphp
                  @endforeach
                  @if($tipoArqueo==3)
                  @php
                      $total=$total-$cierre->importe;
                  @endphp
                  <tr>
                    <td>{{$contador}}</td>
                    <td></td>
                    <td>Cierre</td>
                    <td>{{date_format($cierre->updated_at,'g:i A')}}</td>
                    <td></td>
                    <td>$ {{number_format($cierre->importe,2,'.',',')}}</td>
                    <td>$ {{number_format($total,2,'.',',')}}</td>
                  </tr>
                  @endif
                </tbody>
              </table>
              @php
                  $_GET['total']=$total;
              @endphp
        </div>
      </div>
      