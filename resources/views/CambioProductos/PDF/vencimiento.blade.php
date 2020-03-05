@extends('PDF.hoja')
@section('layout')
<div class="row">
    <div>
      <center>
        <h3>MEDICAMENTOS PRÓXIMOS A VENCER</h3>
      </center>
    </div>
    <div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
      @php
        $contador=1;
        $date = \Carbon\Carbon::now();
        $date = $date->format('Y-m-d');
      @endphp
      @foreach ($retirados as $retirado)
      @if ($retirado->transaccion->fecha_vencimiento>$date && $retirado->transaccion->divisionProducto->producto->estado)
        @if(($contador-1)%22==0)
        <div class="page">
        <table class="table table-hover table-sm table-striped index-table">
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
              @endif
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
                  @if(($contador-1)%22==0)
                </tbody>
            </table>
            </div>
            @endif
            @endforeacH
      </div>
    </div>
</div>
@endsection