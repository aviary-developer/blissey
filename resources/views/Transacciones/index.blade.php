@extends('principal')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  @endphp
  @include('Transacciones.Barra.index')
  <div class="col-8">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Fecha</th>
            @if ($tipo==0 || $tipo==1)
              <th>Proveedor</th>
            @endif
            @if($tipo==1 || $tipo==2 || $tipo==3)
              <th>Factura</th>
            @endif
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $correlativo = 1;
          @endphp
          @foreach ($transacciones as $transaccion)
          @if($transaccion->mostrar_factura)
            @php
                $mostrar=$transaccion->id;
            @endphp
            <a href="#" target="_blank" class="hidden" id="launch"></a>
          @endif
            <tr>
              <td>{{ $correlativo + $pagina}}</td>
              <td>{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
              @if ($tipo==0 || $tipo==1)
                <td>{{$transaccion->proveedor->nombre}}</td>
              @endif
              @if($tipo==1 || $tipo==2 || $tipo==3)
                <td>{{$transaccion->factura}}</td>
              @endif
              @if($tipo==0)
                <td>

                  {!!Form::open(['url'=>['confirmarPedido',$transaccion->id],'method'=>'POST'])!!}
                  <center>
                    <div class="btn-group">
                      <button type="submit" class="btn btn-success btn-sm" title="Confirmar"/>
                      <i class="fas fa-check"></i>
                    </button>
                    @include('Transacciones.Formularios.eliminarPedido')
                  </div>
                </center>
                {!!Form::close()!!}
              </td>
            @endif
            @if ($tipo==1 || $tipo==2 || $tipo==3)
              <td>
                <center>
                  <div class="btn-group">
                    <a href={!! asset('/transacciones/'.$transaccion->id)!!} class="btn btn-sm btn-info" title="Ver">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    @php
                    $fecha=\Carbon\Carbon::now()->subHours(2);
                    @endphp
                    @if ($tipo==2 && $fecha<$transaccion->updated_at)
                      @if(App\Transacion::verDevolucion($transaccion->factura))
                        @include('Transacciones.Formularios.anularVenta')
                      @endif
                    @endif
                  </div>
                </center>
              </td>
            @endif
          </tr>
          @php
          $correlativo++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- /page content -->
@endsection

