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
                @foreach($detalles as $detalle)
                    @php
                        $conteo=App\DetalleDevolucion::total($detalle->id);
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