<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade show active" id="tab_c_ex_1" role="tabpanel" aria-labelledby="tab_ex_1">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Bacteriología</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
            @if($examen->area == "BACTERIOLOGIA")
              <span class="button-checkbox col-4">
                  @php
                  $precio=0;
                  foreach ($servicios as $s) {
                    if($s->f_examen==$examen->id){
                      $precio=$s->precio;
                    }
                  }
              @endphp
              <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                  {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
                </button>
                <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
              </span>
            @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content2" role="tabpanel" aria-labelledby="tab2">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Coprología</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
            @if($examen->area == "EXAMENES DE HECES")
              <span class="button-checkbox col-4">
                  @php
                  $precio=0;
                  foreach ($servicios as $s) {
                    if($s->f_examen==$examen->id){
                      $precio=$s->precio;
                    }
                  }
              @endphp
              <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                  {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
                </button>
                <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
              </span>
            @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content3" role="tabpanel" aria-labelledby="tab3">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Uroanálisis</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "EXAMENES DE ORINA")
            <span class="button-checkbox col-4">
              @php
                  $precio=0;
                  foreach ($servicios as $s) {
                    if($s->f_examen==$examen->id){
                      $precio=$s->precio;
                    }
                  }
              @endphp
              <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content4" role="tabpanel" aria-labelledby="tab4">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Hematología</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "HEMATOLOGIA")
            <span class="button-checkbox col-4">
                @php
                $precio=0;
                foreach ($servicios as $s) {
                  if($s->f_examen==$examen->id){
                    $precio=$s->precio;
                  }
                }
            @endphp
            <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content5" role="tabpanel" aria-labelledby="tab5">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Inmunología</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "INMUNOLOGIA")
            <span class="button-checkbox col-4">
                @php
                $precio=0;
                foreach ($servicios as $s) {
                  if($s->f_examen==$examen->id){
                    $precio=$s->precio;
                  }
                }
            @endphp
            <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content6" role="tabpanel" aria-labelledby="tab6">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Química sanguinea</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "QUIMICA SANGUINEA")
            <span class="button-checkbox col-4">
                @php
                $precio=0;
                foreach ($servicios as $s) {
                  if($s->f_examen==$examen->id){
                    $precio=$s->precio;
                  }
                }
            @endphp
            <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content7" role="tabpanel" aria-labelledby="tab7">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Enzimas</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "ENZIMAS")
            <span class="button-checkbox col-4">
                @php
                $precio=0;
                foreach ($servicios as $s) {
                  if($s->f_examen==$examen->id){
                    $precio=$s->precio;
                  }
                }
            @endphp
            <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content8" role="tabpanel" aria-labelledby="tab8">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Pruebas especiales</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "PRUEBAS ESPECIALES")
            <span class="button-checkbox col-4">
                @php
                $precio=0;
                foreach ($servicios as $s) {
                  if($s->f_examen==$examen->id){
                    $precio=$s->precio;
                  }
                }
            @endphp
            <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content9" role="tabpanel" aria-labelledby="tab9">
    <div>
      <div class="flex-row">
        <center>
          <h5>Área de Otros exámenes</h5>
        </center>
      </div>
      <br>
      <div class="row" style="overflow-x: hidden; overflow-y: scroll; height: 300px">
        @foreach($examenes as $examen)
          @if($examen->area == "OTROS")
            <span class="button-checkbox col-4">
                @php
                $precio=0;
                foreach ($servicios as $s) {
                  if($s->f_examen==$examen->id){
                    $precio=$s->precio;
                  }
                }
            @endphp
            <button type = "button" value="{{ $precio }}" class="btn col-12 btn-sm" data-color="success" onclick="agregarExamenEnSolicitud(this);">
                {{ $examen->nombreExamen }} <br> <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }} <span class="badge badge-success">${{ $precio }}</span></strong>
              </button>
              <input type="checkbox" hidden name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

</div>