<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Usuario</th>
      <th colspan="2">Acción</th>
      <th>Ver</th>
    </tr>
  </thead>
  <tbody>
    @if (count($bitacoras)>0)
      @php
      $correlativo = 1;
      @endphp
      @foreach ($bitacoras as $bitacora)
        <tr>
          <td>{{ $correlativo+$pagina }}</td>
          <td>{{ $bitacora->created_at->format('d/m/Y')}}</td>
          <td>{{ $bitacora->created_at->format('H:i:s')}}</td>
          <td>{{ $bitacora->nombreUsuario($bitacora->f_usuario) }}</td>
          <td>
            <center>
              @if ($bitacora->tipo == 'store')
                <span class="label label-success col-md-12 col-sm-12 col-xs-12 label-lg">Creación</span>
              @elseif ($bitacora->tipo == 'update')
                <span class="label label-warning col-md-12 col-sm-12 col-xs-12 label-lg">Edición</span>
              @elseif ($bitacora->tipo == 'destroy')
                <span class="label label-danger col-md-12 col-sm-12 col-xs-12 label-lg">Eliminar</span>
              @elseif ($bitacora->tipo == 'activate')
                <span class="label label-info col-md-12 col-sm-12 col-xs-12 label-lg">Activar</span>
              @elseif ($bitacora->tipo == 'desactivate')
                <span class="label label-purple col-md-12 col-sm-12 col-xs-12 label-lg">Papelara</span>
              @elseif ($bitacora->tipo == 'login')
                <span class="label label-primary col-md-12 col-sm-12 col-xs-12 label-lg">Ingreso</span>
              @elseif ($bitacora->tipo == 'logout')
                <span class="label label-default col-md-12 col-sm-12 col-xs-12 label-lg">Salida</span>
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
          <td>
            @if ($bitacora->existeRegistro($bitacora->indice,$bitacora->tabla) > 0)
              <a href={!! asset($bitacora->ruta.'/'.$bitacora->indice)!!} class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Ver">
                <i class="fa fa-eye"></i>
              </a>
            @else
              <a href="#" class="btn btn-xs btn-default">
                <i class="fa fa-ban"></i>
              </a>
            @endif
          </td>
        </tr>
        @php
        $correlativo++;
        @endphp
      @endforeach
    @else
      <tr>
        <td colspan="7">
          <center>
            No hay registros que coincidan con los terminos de busqueda indicados
          </center>
        </td>
      </tr>
    @endif
  </tbody>
</table>
