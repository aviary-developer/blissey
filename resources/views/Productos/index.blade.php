@extends('dashboard')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  <div class="col-md-9 col-sm-9 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Productos
            @if ($estadoOpuesto)
              <small class="label-white badge red ">Papelera</small>
            @else
              <small class="label-white badge green ">Activos</small>
            @endif
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/productos/create') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
              </li>
              <li>
                <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa2 fa-eye"></i> Ver
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a data-toggle="modal" data-target="#modal_busqueda">Buscar por</a></li>
                  <li class="divider"></li>
                  <li>
                    <a href={!! asset('/productos?estado='.$estadoOpuesto) !!}>
                      @if ($estadoOpuesto)
                        Activos
                        <span class="label label-success">{{ $activos }}</span>
                      @else
                        Papelera
                        <span class="label label-warning">{{ $inactivos }}</span>
                      @endif
                    </a>
                  </li>
                </ul>
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
              <th>Nombre</th>
              <th>Proveedor</th>
              <th>Categoría</th>
              <th style="width: 200px">Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($productos as $producto)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/productos/'.$producto->id)}}>
                      {{ $producto->nombre }}
                    </a>
                  </td>
                  <td>
                    <a href={{asset('/proveedores/'.$producto->f_proveedor)}}></a>
                    {{ $producto->nombreProveedor($producto->f_proveedor) }}
                  </td>
                  <td>{{$producto->categoriaProducto->nombre}}</td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Productos.Formularios.activate')
                    @else
                      @include('Productos.Formularios.desactivate')
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
          </tbody>
        </table>
      </div>
        <div class="ln_solid"></div>
      </div>
    </div>
  </div>
  {{--Inicio modal  --}}
  <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_busqueda">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Búsqueda</h4>
        </div>

        {!!Form::open(['route'=>'productos.index','method'=>'GET','role'=>'search'])!!}
        <div class="modal-body">
          <div class="x_panel">
          <div class="form-group col-sm-12 col-xs-12">
            <label class="control-label col-sm-2 col-xs-12">Proveedor </label>
            <div class="col-sm-9 col-xs-12">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              {!!Form::select('f_proveedor',App\Proveedor::arrayProveedores(),null, ['class'=>'form-control has-feedback-left','id'=>'f_proveedor','placeholder'=>'Todos los proveedores'])!!}
            </div>
          </div>
          <div class="form-group col-sm-12 col-xs-12">
            <label class="control-label col-sm-2 col-xs-12">Categoría </label>
            <div class="col-sm-9 col-xs-12">
              <span class="fa fa-cog form-control-feedback left" aria-hidden="true"></span>
              {!!Form::select('f_categoria',App\CategoriaProducto::arrayCategorias(),null, ['class'=>'form-control has-feedback-left','id'=>'f_categoria','placeholder'=>'Todos las categorías'])!!}
            </div>
          </div>
          @if ($estadoOpuesto)
            <input type="hidden" name="estado" value="0">
          @endif
        </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit('Buscar',['class'=>'btn btn-primary']) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  {{--Final modal--}}
@endsection
