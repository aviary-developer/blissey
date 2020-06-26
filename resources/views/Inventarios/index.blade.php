@extends('principal')
@section('layout')
  @include('Inventarios.Barra.index')
  <div class="col-10">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Código</th>
            <th>Precio</th>
            <th>Nombre</th>
            <th>Existencias</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $contador=1;

          @endphp
          @foreach ($dp as $div)
            <tr>
              <td>{{$contador + $pagina}}</td>
              <td>{{$div->codigo}}</td>
              <td>$ {{$div->precio}}</td>
              <td>{{$div->nombre}}</td>
              <td>
                @php
                $unidad=App\Unidad::find($div->contenido);
                $division=App\Division::find($div->f_division);
                $presentacion=App\Presentacion::find($div->f_presentacion);
                $invetario=App\DivisionProducto::inventario($div->id,1);
                @endphp
                @if ($unidad==null)
                  {{$invetario."--".$division->nombre." ".$div->cantidad." ".$presentacion->nombre}}
                @else
                  {{$invetario."--".$division->nombre." ".$div->cantidad." ".$unidad->nombre}}
                @endif
              </td>
              <td>
                @if($invetario>0)
                <div class="btn-group">
                  <a href={!! asset('#')!!} class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_inventario" onclick="llenarmodal({{$div->id}});" title="Lotes">
                    <i class="fa fa-info-circle"></i>
                  </a>
                  <a href={!! asset('inventarios/'.$div->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar ubicación">
                    <i class="fa fa-edit"></i>
                  </a>
                </div>
                @else
                  <button type="button" class="btn btn-sm btn-danger disabled"  title="Sin lotes">
                    <i class="fas fa-exclamation-triangle"></i>
                  </button>
                @endif
              </td>
            </tr>
            @php
            $contador++;
            @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('Inventarios.Modales.modal_inventario')
  @include('Inventarios.Modales.modal_salida')
@endsection
