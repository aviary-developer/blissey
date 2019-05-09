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
            @if($tipoArqueo!=1)
              Valor de cierre
            @else
              Valor actual
            @endif
            @php
            if($tipoArqueo==3){
              $restaCierre=$cierre->importe;
            }else{
              $restaCierre=0;
            }
            @endphp
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
                $ {{number_format($_GET['total'],2,'.',',')}}
          </h6>
        </div>
      
        @if($tipoArqueo==1)
        <div class="ln_solid mb-1 mt-1"></div>
        <div class="flex-row">
          <span class="font-weight-light text-monospace">
            Efectivo
          </span>
        </div>
        <div class="flex-row">
          <h6 class="font-weight-bold">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_efectivo" onclick="cambioModal(1);">
              Entrada
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_efectivo" onclick="cambioModal(2);">
              Salida
            </button>
          </h6>
        </div>
        @endif
      </div>
      <script>
        function cambioModal(tipo){
          if(tipo==1){
            $('#titulo').text("Entrada de efectivo");
          }else{
            $('#titulo').text("Salida de efectivo");
          }
          $('#tipoModal').val(tipo);
        }
      </script>
      