<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Productos</h5>
    </center>
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-hover table-sm table-striped index-table">
      <thead>
          <th>#</th>
          <th>Productos</th>
      </thead>
      <tbody id="body-table">
        @php
        $productos=App\Proveedor::productos($proveedor->id);
        $correlativo = 1;
        @endphp
        @foreach ($productos as $producto)
          <tr>
            <td>{{$correlativo}}</td>
            <td>{{$producto->nombre}}</td>
          </tr>
          @php
          $correlativo++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>
