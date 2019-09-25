@extends('PDF.hoja')
@section('layout')
<div class="row">
    <div>
      <center>
        <h3>REPORTE PRODUCTOS PRÓXIMOS A VENCER</h3>
      </center>
    </div>
    <div>
        <div class="col-xs-5">
            <div class="col-xs-5">
                <span>Localización:</span>
            </div>
            <div class="col-xs-7 subrayar">
                <b>@if(App\Transacion::tipoUsuario())
                        Recepción
                    @else
                        Farmacia
                    @endif
                </b>
            </div>
        </div>
        <div class="col-xs-7">
            <div class="col-xs-5">
                <span>Fecha y hora del informe:</span>
            </div>
            <div class="col-xs-7 subrayar">
                <b>{{ \Carbon\Carbon::now()->format('d/m/Y h:i:s A')}}</b>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <h4><center>Lotes próximos a vencer</center></h4>
        <table class="table-simple">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Lote</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $contador=1;
                    $date = \Carbon\Carbon::now();
                    $date = $date->format('Y-m-d');
                @endphp
                @foreach ($retirados as $retirado)
                @if ($retirado->transaccion->fecha_vencimiento>$date)
                  <tr>
                    <td>
                      {{$contador}}
                    </td>
                    @php
                      $dv=$retirado->transaccion->divisionProducto;//división producto
                    @endphp
                    <td>
                    {{$retirado->transaccion->fecha_vencimiento->formatLocalized('%d/%m/%Y')}}
                    </td>
                    <td>{{$dv->codigo}}</td>
                    <td>{{$dv->producto->nombre." ".$dv->division->nombre." "}}
                    @if ($dv->contenido!=null)
                      {{$dv->cantidad." ".$dv->unidad->nombre}}
                    @else
                      {{$dv->cantidad." ".$dv->producto->Presentacion->nombre}}
                    @endif
                    </td>
                    <td>{{$retirado->cantidad}}</td>
                    <td>{{$retirado->transaccion->lote}}</td>
                  </tr>
                  @php
                    $contador++;
                  @endphp
                  @endif
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection