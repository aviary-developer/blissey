<div class="x_panel">
        <div class="flex-row">
            <center>
            <h5 class="mb-1">Información General</h5>
            </center>
        </div>
          
        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
            <span class="font-weight-light text-monospace">
                Fecha
            </span>
        </div>
        <div class="flex-row">
            <h6 class="font-weight-bold">
                    {{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}
            </h6>
        </div>
    
        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
            <span class="font-weight-light text-monospace">
                    N° de factura
            </span>
        </div>
        <div class="flex-row">
            <h6 class="font-weight-bold">
                    {{$transaccion->factura}}
            </h6>
        </div>
    
        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
                @if($transaccion->tipo)
                Cliente
              @else
                Proveedor
              @endif
        </div>
        <div class="flex-row">
            <h6 class="font-weight-bold">
                    @if($transaccion->tipo)
                    @if(count($transaccion->cliente)>0)
                      {{$transaccion->cliente->nombre." ".$transaccion->cliente->apellido}}
                    @else
                      Clientes varios
                    @endif
                  @else
                    {{$transaccion->proveedor->nombre}}
                  @endif
            </h6>
        </div>

        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
            <span class="font-weight-light text-monospace">
                    Descuento general
            </span>
        </div>
        <div class="flex-row">
            <h6 class="font-weight-bold">
                    {{$transaccion->descuento}}%
            </h6>
        </div>

        @if ($transaccion->tipo==3)
            <div class="ln_solid mb-1 mt-1"></div>
            <div class="flex-row">
                <span class="font-weight-light text-monospace">
                        Motivo de la anulación
                </span>
            </div>
            <div class="flex-row">
                <h6 class="font-weight-bold">
                        <span class="badge text-danger border border-danger col-12">
                        {{$transaccion->comentario}}
                        </span>
                </h6>
            </div>
        @endif
    </div>