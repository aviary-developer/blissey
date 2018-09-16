@extends('dashboard')
@section('layout')
  @php
      setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Productos vencidos y
              <small class="label-white badge blue ">próximos a vencer</small>
          </h3>
        </center>
      </div>
      @include('CambioProductos.Formularios.confirm')
    </div>
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
        <table class="table table-striped" id="index-table">
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
                <tr>
                  <td>
                    {{$contador+$pagina}}
                  </td>
                  @php
                    $dv=$retirado->transaccion->divisionProducto;//división producto
                  @endphp
                  <td>
                  {{$retirado->transaccion->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}
                  </td>
                  <td>{{$dv->codigo}}</td>
                  <td>
                    @php
                    $date = \Carbon\Carbon::now();
                    $date = $date->format('Y-m-d');
                    @endphp
                    @if ($retirado->estado==0)
                      @if ($retirado->transaccion->fecha_vencimiento>$date)
                        <span class="label label-warning label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="No retirado">Próximo a vencer</span>
                      @else
                        <span class="label label-danger label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="No retirado">Vencido</span>
                      @endif
                    @elseif($retirado->estado==1)
                      <span class="label label-dark-blue label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="Retirado sin cambio">{{$dv->codigo}}</span>
                    @else
                      <span class="label label-success label-lg col-xs-12" data-toggle="tooltip" data-placement="top" title="Cambiado">{{$dv->codigo}}</span>
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
                  <td><a href={!! asset('/cambio_productos/'.$retirado->id)!!} class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Ver">
                    <i class="fa fa-info-circle"></i>
                    </a>
                    @if (!$retirado->estado)
                      <a href="#" onclick={!! "'individual(".$retirado->id.");'" !!} class="btn btn-sm btn-danger"  data-tooltip="tooltip" title="Confirmar retiro">
                        <i class="fa fa-check"></i>
                        </a>
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
        <div class="ln_solid"></div>
      </div>
    </div>
  </div>
  <!-- /page content -->
  <script type="text/javascript">
    function submitar(){
      $('#cambios').submit();
    }
  </script>
@endsection
