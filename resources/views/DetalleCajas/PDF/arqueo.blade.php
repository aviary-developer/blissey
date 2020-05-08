@extends('PDF.hoja')
@section('layout')
@php
  setlocale(LC_ALL,'es');
@endphp
<div class="row">
    <div>
      <center>
        <h3>ARQUEO DE CAJA {{ $detalle->datosCaja->nombre}}</h3>
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
<div class="row">
    <div class="col-xs-12">
        @php
                $contador=3;
                $total=$detalle->importe;
                $c_mov=$movimientos->count();
                $p_t=1;
        @endphp
        @foreach ($movimientos as $movimiento)
        @if(($contador-1)%22==0 || $p_t==1)
        @php
            $p_t=0;
        @endphp
        <div class="page">
        <table class="table table-hover table-sm table-striped index-table">
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
            @if ($detalle->importe>0 && $contador==3)
                <tr>
                    <td>{{$contador-2}}</td>
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
            @endif
                
                    <tr>
                        <td>{{$contador-2}}</td>
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
                @if($tipoArqueo==3 && ($c_mov+4)==$contador)
                    @php
                        $total=$total-$cierre->importe;
                    @endphp
                    <tr>
                        <td>{{$contador-2}}</td>
                        <td></td>
                        <td>Cierre</td>
                        <td>{{date_format($cierre->updated_at,'g:i A')}}</td>
                        <td></td>
                        <td>$ {{number_format($cierre->importe,2,'.',',')}}</td>
                        <td>$ {{number_format($total,2,'.',',')}}</td>
                    </tr>
                @endif
                @if(($contador-1)%22==0)
            </tbody>
        </table>
        </div>
        @endif
        @endforeacH
        
    </div>
</div>
@endsection