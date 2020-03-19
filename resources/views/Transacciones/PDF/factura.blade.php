<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>
    <!-- Bootstrap -->
    {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
    <!-- Font Awesome -->
    {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}


    {!!Html::style('assets/build/css/custom.css')!!}
    {!!Html::style('css/pdffactura.css')!!}

    <style type="text/css">
      div.page
      {
          page-break-after: always;
          page-break-inside: avoid;
      }
    </style>
  </head>

  <body class="bg-white">
@php
    $detalles=$transaccion->detalleTransaccion;
    $total=0;
    if($transaccion->descuento==0){
        $contador=0;
    }else{
        $contador=1;
    }
@endphp
  <div class="row">
    <div class="col-xs-12">
        <table class="table-simple">
            <tbody>
                <tr>
                    <td style="width: 15%;"></td>
                    <td>@if($transaccion->cliente!=null)
                        {{$transaccion->cliente->nombre." ".$transaccion->cliente->apellido}}
                      @else
                        Clientes varios
                      @endif</td>
                    <td colspan="2" style="text-align:center;">{{$transaccion->fecha->formatLocalized('%d/%m/%Y')}}</td>
                </tr>
            </tbody>
        </table>
        <div style="height: 57px;">
        </div>
        <table class="table-simple">
                    <tbody>
                    @foreach ($detalles as $detalle)
                    @php
                        $contador++;
                    @endphp
                      <tr>
                        <td style="width: 16%;text-align:center;">{{$detalle->cantidad}}</td>
                        @if($detalle->f_servicio==null)
                        <td style="width: 51%">
                          @if($detalle->divisionProducto->unidad==null)
                            {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                          @else
                            {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                          @endif
                          -
                        {{$detalle->divisionProducto->producto->nombre}}
                          @if($detalle->descuento!=0)
                            (Descuento{{$detalle->descuento}}%)
                          @endif
                    </td>
                      @else
                        <td style="width: 51%">
                          @if($detalle->servicio->categoria->nombre=="Ultrasonografía" || $detalle->servicio->categoria->nombre=="TAC" || $detalle->servicio->categoria->nombre=="Rayos X")
                            {{$detalle->servicio->categoria->nombre." "}}
                          @endif
                          {{$detalle->servicio->nombre}}
                        </td>
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
                      <td style="width: 23%">$ {{number_format($detalle->precio,2,'.','.')}}</td>
                      <td>$ {{number_format($detalle->cantidad*$descontado,2,'.','.')}}</td>
                      @php
                      $total=$total+($detalle->cantidad*$descontado);
                      @endphp
                      </tr>
                    @endforeach
                    @for($i=1;$i<=(8-$contador);$i++)
                    <tr>
                    <td colspan="4" style="color:white">{{$i}}</td>
                    </tr>
                    @endfor
                      </tbody>
                    </table>
                    <div style="height: 4px;">
                    </div>
                    <table class="table-simple">
                        <tbody>
                          @if($transaccion->descuento==0 || $transaccion->detalleTransaccion->count()<8)
                                <tr>
                                  <td colspan="4" style="color:white">Espacio</td>
                                </tr>
                          @endif
                            <tr>
                              <td colspan='2'></td>
                                <td><div style="text-align:right;">
                                  @if ($transaccion->descuento>0)(Descuento general {{$transaccion->descuento}}%)
                                  @else
                                  @endif
                                      $ {{number_format($total,2,'.','.')}}</div></td>
                          <td style="width: 5%;"></td>
                              </tr>
                              @if ($transaccion->descuento>0)
                                @php
                                  $total=$total-($total*($transaccion->descuento/100));
                                @endphp
                                <tr>
                                  <td colspan='3'><div style="text-align:right;">
                                    $ {{number_format($total,2,'.','.')}}
                                  </div></td>
                                  <td style="width: 5%;"></td>
                                </tr>
                              @endif
                              <tr>
                                    <td style="width: 15%;"></td>
                                  <td colspan="3">{{App\Caja::convertir((int)$total)}} y {{number_format($total-((int)$total),2,'.','.')*100}}/100 US DOLARES</td>
                              </tr>
                        </tbody>
                    </table>
                    <div style="height: 1px;">
                    </div>
                    <table class="table-simple">
                      <tbody>

                        <tr>
                          <td colspan="2"></td>
                          <td style="text-align:right;">
                          $ {{number_format($total,2,'.','.')}}

                          </td>
                          <td style="width: 5%;"></td>
                        </tr>
                        <tr>
                          <td colspan="2"></td>

                          <td style="text-align:right;">
                          VENTA TOTAL $ {{number_format($total,2,'.','.')}}

                          </td>
                          <td style="width: 5%;"></td>
                        </tr>
                      </tbody>
                    </table>
                    {{-- <div style="text-align:right;">
                    </div>
                    {{-- <div style="height: 50px;">
                    </div> --}}
                    {{-- <div style="text-align:right;">
                    </div> --}}
    </div>
  </div>
</body>
</html>