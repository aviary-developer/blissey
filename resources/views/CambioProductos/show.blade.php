@extends('principal')
@section('layout')
  @php
  $dv=$retirado->transaccion->divisionProducto;
  @endphp
  @include('CambioProductos.Barra.show')
  <div class="col-sm-4">
    <div class="x_panel">
      <div class="flex-row">
        <center>
          <h5 class="mb-1">Información General</h5>
        </center>
      </div>

      <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        Código
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
          {{$dv->codigo}}
      </h6>
    </div>

    <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        Nombre
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
        {{$dv->producto->nombre." ".$dv->division->nombre." "}}
        @if ($dv->contenido!=null)
          {{$dv->cantidad." ".$dv->unidad->nombre}}
          @else
            {{$dv->cantidad." ".$dv->producto->Presentacion->nombre}}
          @endif
      </h6>
    </div>

    <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        Cantidad
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
        {{$retirado->cantidad}}
      </h6>
    </div>

    <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        Estado
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
        @if ($retirado->estado==0)
          <span class="badge text-danger border border-danger col-12">Falta retirar del estante</span>
        @elseif($retirado->estado==1)
          <span class="badge text-primary border border-primary col-12">Retirado del estante sin cambio</span>
        @else
        <span class="badge text-successe border border-success col-12">Producto cambiado por el proveedor</span>            
        @endif
      </h6>
    </div>

    <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        @if ($retirado->estado==0)
           Ubicación
        @else
          Retirado de
        @endif
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
        Estante: {{$retirado->transaccion->estante->codigo}} Nivel: {{$retirado->transaccion->nivel}}
      </h6>
    </div>
    
    </div>
  </div>
@endsection