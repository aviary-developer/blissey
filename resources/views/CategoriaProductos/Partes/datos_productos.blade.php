<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Productos
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-hover table-sm table-striped index-table">
      @php
      $productos=App\CategoriaProducto::productos($categoria->id);
      $contador=1;
      @endphp
      <thead>
        <tr>
          <th>#</th>
          <th>Productos</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($productos as $producto)
          <tr>
            <td>{{$contador}}</td>
            <td>{{$producto->nombre}}</td>
          </tr>
          @php
          $contador++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>
