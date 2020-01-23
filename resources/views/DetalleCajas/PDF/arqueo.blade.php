@extends('PDF.hoja')
@section('layout')
@php
  setlocale(LC_ALL,'es');
@endphp
<div class="row">
    <div>
      <center>
        <h3>ARQUEO DE CAJA</h3>
      </center>
    </div>
    <div>
        <div class="col-xs-6">
            <div class="col-xs-2">
                <span>Caja:</span>
            </div>
            <div class="col-xs-10 subrayar">
                <b>{{ $detalle->datosCaja->nombre}}</b>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-3">
                <span>Localización:</span>
            </div>
            <div class="col-xs-9 subrayar">
                <b>@if($detalle->datosCaja->localizacion)
                        Recepción
                    @else
                        Farmacia
                    @endif
                </b>
            </div>
        </div>
    </div>
    <div>
            <div class="col-xs-6">
                <div class="col-xs-5">
                    @if($tipoArqueo==1)
                    <span>Fecha y hora del informe:</span>
                    @else
                    <span>Fecha y hora del apertura:</span>
                    @endif
                </div>
                <div class="col-xs-7 subrayar">
                        @if($tipoArqueo==1)
                            <b>{{ \Carbon\Carbon::now()->format('d/m/Y h:i:s A')}}</b>
                        @else
                            <b>{{ $detalle->created_at->formatLocalized('%d/%m/%Y a las %H:%M:%S') }}</b>
                        @endif
                </div>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <h4><center>Movimientos en caja</center></h4>
        <table class="table-simple">
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
            <tbody>
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
                                    $suma=$movimiento->devolucion;
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
                                    $resta=$movimiento->devolucion;
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
    </div>
</div>
@endsection