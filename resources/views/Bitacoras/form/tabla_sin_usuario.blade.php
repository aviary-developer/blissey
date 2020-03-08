<table class="table table-striped table-sm table-hover index-table">
  <thead>
    <th>#</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Acción</th>
    <th>Descripción</th>
    {{-- <th>Ver</th> --}}
  </thead>
  <tbody>
    @php
    $correlativo = 1;
    @endphp
    @foreach ($bitacoras as $bitacora)
      <tr>
        <td>{{ $correlativo}}</td>
        <td>{{ $bitacora->created_at->format('d/m/y')}}</td>
        <td>{{ $bitacora->created_at->format('H:i:s')}}</td>
        <td>
          <center>
            @if ($bitacora->tipo == 'store')
              <span class="badge border-success col-sm-12 border text-success">Creación</span>
            @elseif ($bitacora->tipo == 'update')
              <span class="badge border-warning col-sm-12 border text-warning">Edición</span>
            @elseif ($bitacora->tipo == 'destroy')
              <span class="badge border-danger col-sm-12 border text-danger">Eliminar</span>
            @elseif ($bitacora->tipo == 'activate')
              <span class="badge border-info col-sm-12 border text-info">Activar</span>
            @elseif ($bitacora->tipo == 'desactivate')
              <span class="badge border-purple col-sm-12 border text-purple">Papelera</span>
            @elseif ($bitacora->tipo == 'login')
              <span class="badge border-primary col-sm-12 border text-primary">Ingreso</span>
            @elseif ($bitacora->tipo == 'logout')
              <span class="badge border-dark col-sm-12 border">Salida</span>
            @endif
          </center>
        </td>
        <td>
          @php
            if($bitacora->tipo == 'store')
            {
              echo "Se ha creado un registro en ".$bitacora->ruta.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
            }
            else if($bitacora->tipo == 'update')
            {
              echo "Se ha editado un registro en ".$bitacora->ruta.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
            }
            else if($bitacora->tipo == 'destroy')
            {
              echo "Se ha eliminado un registro en ".$bitacora->ruta.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
            }
            else if($bitacora->tipo == 'activate')
            {
              echo "Se ha activado un registro en ".$bitacora->ruta.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
            }
            else if($bitacora->tipo == 'desactivate')
            {
              echo "Se ha enviado a papelera un registro en ".$bitacora->ruta.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
            }
            else if($bitacora->tipo == 'logout')
            {
              echo "Cerró sesión";
            }
            else
            {
              echo "Abrió sesión";
            }
          @endphp
        </td>
        {{-- <td>
          @if ($bitacora->existeRegistro($bitacora->indice,$bitacora->tabla) > 0)
            <a href={!! asset($bitacora->ruta.'/'.$bitacora->indice)!!} class="btn btn-sm btn-primary" title="Ver">
              <i class="fa fa-eye"></i>
            </a>
          @else
            <a href="#" class="btn btn-sm btn-secondary">
              <i class="fa fa-ban"></i>
            </a>
          @endif
        </td> --}}
      </tr>
      @php
      $correlativo++;
      @endphp
    @endforeach
  </tbody>
</table>
