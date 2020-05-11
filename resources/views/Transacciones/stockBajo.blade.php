@extends('principal')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  @endphp
  @include('Transacciones.Barra.stockBajo')
   <div class="col-12">
      {{-- <div class="x_panel">
          {!!Form::open(['url'=>'stockTodos','method'=>'GET','role'=>'search','class'=>'form-inline','id'=>'formstockbajo'])!!}
          <div class="form-group col-sm-12">
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                {!!Form::select('f_proveedor',
                App\Transacion::arrayProveedores()
                ,null, ['class'=>'form-control form-control-sm','id'=>'f_proveedor','placeholder'=>'Filtrar por proveedor','onChange'=>'submitar();'])!!}
              </div>
            </div>
          {!! Form::close() !!}
      </div> --}}
      <div class="x_panel">
          <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Catidad/Contenido</th>
                  <th>Existencias</th>
                  <th>Stock</th>
                </tr>
              </thead>
              <tbody>
                @if ($divisiones!=null)
                @php
                  $correlativo=1;
                @endphp
                @foreach ($divisiones as $division)
                @php
                $unidad=App\Unidad::find($division->contenido);
                $div=App\Division::find($division->f_division);
                $presentacion=App\Presentacion::find($division->f_presentacion);
                @endphp
                  <tr>
                  <td>{{$correlativo}}</td>
                  <td>{{$division->codigo}}</td>
                <td>{{$division->nombre}}</td>
                <td>
                  @if ($unidad==null)
                      {{$div->nombre." ".$division->cantidad." ".$presentacion->nombre}}
                    @else
                      {{$div->nombre." ".$division->cantidad." ".$unidad->nombre}}
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
              @else
                <tr>
                  <td colspan="7">
                    <center>
                      No hay registros que coincidan con los términos de búsqueda indicados
                    </center>
                  </td>
                </tr>
              @endif
              </tbody>
          </table>
      </div>
   </div>
<script type="text/javascript">
  function submitar(){
    $('#formstockbajo').submit();
  }
</script>
@endsection
