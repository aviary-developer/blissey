<div class="x_panel">
    <table class="table table-sm table-striped" id="tablaPromos">
        <thead>
          <th>Promociones</th>
          <th>Cantidad</th>
          @if($create==true)
          <th style="width : 80px">Acción</th>
          @endif
        </thead>
          @if($create==false)
          <tbody>
            @foreach ($servicios->promos as $promo)
            <tr>
              @if($promo->f_divisionproducto!=null)
              <td>
                {{$promo->division->producto->nombre}}
                @if($promo->division->unidad==null)
                                {{$promo->division->division->nombre." ".$promo->division->cantidad." ".$promo->division->producto->presentacion->nombre}}
                              @else
                                {{$promo->division->division->nombre." ".$promo->division->cantidad." ".$promo->division->unidad->nombre}}
                              @endif
              </td>
              @else
              <td>
                {{$promo->servicio->nombre}}
              </td>
              @endif
              <td>{{$promo->cantidad}}</td>
            </tr>
            @endforeach
          @endif
        </tbody>
    </table>
</div>