<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Divisiones</h5>
    </center>
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-hover table-sm table-striped index-table">
      <thead>
        <th>#</th>
        <th>Código</th>
        <th>División</th>
        <th>Cta/Cont</th>
        <th>Precio</th>
        <th>Stock mínimo</th>
        <th>Notificar</th>
      </thead>
      @php
        $contador_division = 1;
      @endphp
      <tbody>
        @foreach ($divisiones as $division)
          <tr>
            <td>{{$contador_division}}</td>
            <td>{{$division->codigo}}</td>
            <td>{{$division->nombreDivision($division->f_division)}}</td>
            <td>
              @if ($division->contenido!=null)
                {{$division->cantidad.' '.$division->unidad->nombre}}
              @else
              {{$division->cantidad.' '.$producto->nombrePresentacion($producto->f_presentacion)}}
            @endif
            </td>
            <td>{{'$ '.number_format($division->precio,2,'.','.')}}</td>
            <td>{{$division->stock}}</td>
            <td>{{$division->num_meses($division->n_meses)}}</td>
          </tr>
          @php
            $contador_division++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>
