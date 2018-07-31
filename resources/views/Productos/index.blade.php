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
      <div class="x_title">
        <h2>Productos
          @if ($estadoOpuesto)
            <small>Papelera</small>
          @else
            <small>Activos</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/productos/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_busqueda">
                <i class="fa fa-search"></i>
                Búsqueda
              </button>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/productos?nombre='.$nombre.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activos
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
        </div>
        <br>
        <table class="table table-striped">
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
            @if (count($productos)>0)
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
            @else
              <tr>
                <td colspan="4">
                  <center>
                    No hay registros que coincidan con los términos de búsqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
          {!! str_replace ('/?', '?', $productos->appends(Request::only(['nombre','f_proveedor','f_categoria','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
  {{-- <div class="col-md-5 col-xs-12">

    <div class="form-group col-md-12 col-sm-12 col-xs-12">
      <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
    </div>

  </div> --}}
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
              <label class="control-label col-sm-2 col-xs-12">Nombre </label>
              <div class="col-sm-9 col-xs-12">
                <span class="fa fa-cube form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del producto']) !!}
              </div>
            </div>
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
