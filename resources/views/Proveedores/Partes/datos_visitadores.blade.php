<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Visitadores</h5>
    </center>
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-hover table-sm table-striped index-table">
      <thead>
          <th>#</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Teléfono</th>
      </thead>
      <tbody id="body-table">
        @php
        $correlativo = 1;
        @endphp
        @foreach ($proveedor->visitador as $visitador)
          <tr>
            <td>{{ $correlativo }}</td>
            <td>
              <a href={{asset('/visitadores/'.$visitador->id)}}>
                {{ $visitador->nombre }}
              </a>
            </td>
            <td>
              <a href={{asset('/visitadores/'.$visitador->id)}}>
                {{ $visitador->apellido }}
              </a>
            </td>
            <td>{{ $visitador->telefono }}</td>
          </tr>
          @php
          $correlativo++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>
