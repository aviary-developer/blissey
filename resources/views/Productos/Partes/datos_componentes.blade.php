<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Componentes</h5>
    </center>
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-hover table-sm table-striped index-table">
      <thead>
        <th>#</th>
        <th>Componente</th>
        <th>Contenido</th>
      </thead>
      @php
        $contador_compoenente = 1;
      @endphp
      <tbody>
          @foreach ($componentes as $componente)
            <tr>
              <td>{{$contador_compoenente}}</td>
              <td>{{$componente->nombreComponente($componente->f_componente)}}</td>
              <td>{{$componente->cantidad.' '.$componente->nombreUnidad($componente->f_unidad)}}</td>
            </tr>
            @php
              $contador_compoenente++;
            @endphp
          @endforeach
      </tbody>
    </table>
  </div>
</div>
