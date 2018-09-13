@extends('dashboard')
@section('layout')
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Inventario
              <small class="label-white badge blue ">División</small>
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
              </li>
              <li>
                <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
        <table class="table table-striped" id="index-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
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
                <td>{{$div->nombre}}</td>
                <td>
                  @php
                    $unidad=App\Unidad::find($div->contenido);
                    $division=App\Division::find($div->f_division);
                    $presentacion=App\Presentacion::find($div->f_presentacion);
                  @endphp
                  @if (count($unidad)==0)
                    {{App\DivisionProducto::inventario($div->id,1)."--".$division->nombre." ".$div->cantidad." ".$presentacion->nombre}}
                  @else
                    {{App\DivisionProducto::inventario($div->id,1)."--".$division->nombre." ".$div->cantidad." ".$unidad->nombre}}
                  @endif
                </td>
                <td>
                  <a href={!! asset('#')!!} class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_inventario" onclick="llenarmodal({{$div->id}});">
                    <i class="fa fa-info-circle"></i>
                  </a>
                </td>
              </tr>
              @php
                $contador++;
              @endphp
            @endforeach
          </tbody>
        </table>
      </div>
        <div class="ln_solid"></div>
      </div>
    </div>
  </div>
  @include('Inventarios.Modales.modal_inventario')
  <!-- /page content -->
@endsection
