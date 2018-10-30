<div class="x_panel">
        <div class="flex-row">
          <center>
            <h5 class="mb-1">Información General</h5>
          </center>
        </div>
      
        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Caja
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
            {{ $detalle->datosCaja->nombre}}
          </h6>
        </div>

        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Localización
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
                @if($detalle->datosCaja->localizacion)
                <span class="badge text-success border border-success col-12">Recepción</span>
                @else
                <span class="badge text-dark border border-dark col-12">Farmacia</span>
                @endif
          </h6>
        </div>

        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Fecha y hora de apertura
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
                {{ $detalle->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}
          </h6>
        </div>

        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Valor inicial
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
            $ {{number_format($detalle->importe,2,'.',',')}}
          </h6>
        </div>

        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Valor actual
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
                $ {{number_format(App\DetalleCaja::arqueo(\Carbon\Carbon::now()->toDateString()),2,'.',',')}}
          </h6>
        </div>
      
        {{-- <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Estado
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
            @if ($categoria->estado)
              <span class="badge text-success border border-success col-4">Activo</span>
            @else
              <span class="badge text-danger border border-danger col-4">En papelera</span>
            @endif
          </h6>
        </div> --}}
      </div>
      