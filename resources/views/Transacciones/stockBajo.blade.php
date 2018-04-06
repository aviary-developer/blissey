@extends('dashboard')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Productos
            <small>Con stock bajo</small>
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-5 col-xs-12">
            <div class="btn-group">
                <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
            </div>
          </div>
          <div class="col-md-3 col-xs-12"></div>
          <div class="col-md-4 col-xs-12">
            {!!Form::open(['url'=>'stockTodos','method'=>'GET','role'=>'search','class'=>'form-inline','id'=>'formstockbajo'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!!Form::select('f_proveedor',
                App\Transacion::arrayProveedores()
                ,null, ['class'=>'form-control has-feedback-left','id'=>'f_proveedor','placeholder'=>'Filtrar por proveedor','onChange'=>'submitar();'])!!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Producto</th>
              <th>Catidad/Contenido</th>
              <th>Inventario</th>
              <th>Stock</th>
            </tr>
          </thead>
          <tbody>
            @php
              $correlativo=1;
            @endphp
            @foreach ($divisiones as $division)
              <tr>
              <td>{{$correlativo}}</td>
              <td>{{$division->codigo}}</td>
              <td>{{$division->producto->nombre}}</td>
              <td>
                {{$division->nombreDivision($division->f_division)}}
                @if ($division->contenido!=null)
                  {{$division->cantidad.' '.$division->unidad->nombre}}
                @else
                {{$division->cantidad.' '.$division->producto->nombrePresentacion($division->producto->f_presentacion)}}
              @endif
              </td>
              @if ($division->inventario==0)
                <td style="color:red;">
              @else
                <td>
              @endif
                {{$division->inventario}}</td>
              <td>{{$division->stock}}</td>
              </tr>
              @php
                $correlativo++;
              @endphp
            @endforeach
          </tbody>
      </table>
      <div class="ln_solid"></div>
      <center>
        {{-- {!! str_replace ('/?', '?', $divisiones->appends(Request::only(['buscar']))->render ()) !!} --}}
      </center>
    </div>
  </div>
</div>
<!-- /page content -->
<script type="text/javascript">
  function submitar(){
    $('#formstockbajo').submit();
  }
</script>
@endsection
