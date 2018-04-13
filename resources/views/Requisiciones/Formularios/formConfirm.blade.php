@php
setlocale(LC_ALL,'es');
$detalles=$transaccion->detalleTransaccion;
@endphp
<div class="x_content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-12">
      @foreach ($detalles as $detalle)
      <div class="row bg-blue">
        <div class="col-xs-9">
          <h4>
            <span class="fa fa-barcode"></span> {{$detalle->divisionProducto->codigo}}-{{$detalle->divisionProducto->producto->nombre}}
            @if($detalle->divisionProducto->unidad==null)
              {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
            @else
              {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
            @endif
            <span class="label label-warning">{{$detalle->cantidad}}</span>
          </h4>
        </div>
      </div>
      <table class="table table-striped">
        <tr>
          <td><b>Cantidad</b></td>
          <td><b>Fecha de vencimiento</b></td>
          <td><b>Lote</b></td>
          <td><b>Estante</b></td>
          <td><b>Nivel</b></td>
        </tr>
        <tbody>
            @php
            $inventario=App\DivisionProducto::inventario($detalle->f_producto,2);
              $compras=App\DivisionProducto::compras($detalle->f_producto,2);
              $cuenta=0;
              $i=0;
              $ultimos=[];
              foreach ($compras as $compra) {
                $cuenta=$cuenta+$compra->cantidad;
                $ultimos[$i]=$compra;
                if($cuenta>=$inventario)
                break;
                $i++;
              }
              $diferencia=$cuenta-$inventario;
              if($diferencia!=0){
                $fila=$ultimos[$i];
                $fila->cantidad=$fila->cantidad-$diferencia;
                $ultimos[$i]=$fila;
              }
              $regresivo=$detalle->cantidad;
              for ($b=$i; $b>=0 ; $b--) {
                $fila=$ultimos[$b];
                $inv=App\DetalleTransacion::find($fila->id);
                if($fila->cantidad<$regresivo){
                @endphp
                <tr>
                  <td>
                    {{$fila->cantidad}}
                  </td>
                  <td>{{$inv->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
                  <td>{{$fila->lote}}</td>
                  <td>{{$fila->f_estante}}</td>
                  <td>{{$fila->nivel}}</td>
                </tr>
                @php
                $regresivo=$regresivo-$fila->cantidad;
              }elseif($regresivo!=0){
                @endphp
                <tr>
                  <td>
                    {{$regresivo}}
                  </td>
                  <td>{{$inv->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
                  <td>{{$fila->lote}}</td>
                  <td>{{$fila->f_estante}}</td>
                  <td>{{$fila->nivel}}</td>
                </tr>
                </tr>
                @php
                $regresivo=0;
              }
              }
            @endphp
        </tbody>
      </table>
      @endforeach
      <a href={!! asset('/atenderPeticion/'.$transaccion->id) !!} class="btn btn-primary">Confirmar</a>
    </div>
  </div>
</div>
