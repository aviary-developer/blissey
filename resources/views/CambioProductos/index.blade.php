@extends('principal')
@section('layout')
  @php
      setlocale(LC_ALL,'es');
  @endphp
  @include('CambioProductos.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Código</th>
              <th>Estado</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Lote</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
                $contador=1;
              @endphp
              @foreach ($retirados as $retirado)
              @if($retirado->transaccion->divisionProducto->producto->estado)
                <tr>
                  <td>
                    {{$contador+$pagina}}
                  </td>
                  @php
                    $dv=$retirado->transaccion->divisionProducto;//división producto
                  @endphp
                  <td>
                  {{$retirado->transaccion->fecha_vencimiento->formatLocalized('%d/%m/%Y')}}
                  </td>
                  <td>{{$dv->codigo}}</td>
                  <td>
                    @php
                    $date = \Carbon\Carbon::now();
                    $date = $date->format('Y-m-d');
                    @endphp
                    @if ($retirado->estado==0)
                      @if ($retirado->transaccion->fecha_vencimiento>$date)
                      <span class="badge text-warning border border-warning col-12" title="No retirado">Próximo a vencer</span>
                      @else
                      <span class="badge text-danger border border-danger col-12" title="No retirado">Vencido</span>
                      @endif
                    @elseif($retirado->estado==1)
                    <span class="badge text-primary border border-primary col-12" title="Retirado sin cambio">Retirado</span>
                    @else
                    <span class="badge text-dark-success border border-success col-12" title="Cambiado">Cambiado</span>
                    @endif
                  </td>
                  <td>{{$dv->producto->nombre." ".$dv->division->nombre." "}}
                  @if ($dv->contenido!=null)
                    {{$dv->cantidad." ".$dv->unidad->nombre}}
                  @else
                    {{$dv->cantidad." ".$dv->producto->Presentacion->nombre}}
                  @endif
                  </td>
                  <td>{{$retirado->cantidad}}</td>
                  <td>{{$retirado->transaccion->lote}}</td>
                  <td>
                    <div class="btn-group">
                      <a href={!! asset('/cambio_productos/'.$retirado->id)!!} class="btn btn-sm btn-info" title="Ver">
                      <i class="fas fa-info-circle"></i>
                      </a>
                      @if (!$retirado->estado)
                        <a href="#" onclick={!! "'individual(".$retirado->id.");'" !!} class="btn btn-sm btn-danger" title="Confirmar retiro">
                          <i class="fas fa-check"></i>
                        </a>
                      @endif
                    </div>
                  </td>
                </tr>
                @php
                  $contador++;
                @endphp
              @endif
              @endforeach
          </tbody>
        </table>
      </div>
  </div>
  <!-- /page content -->
  <script type="text/javascript">
    function submitar(){
      $('#cambios').submit();
    }
  </script>
@endsection
