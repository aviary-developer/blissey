<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="tab_c_ex_1" role="tabpanel" aria-labelledby="tab_ex_1">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Bacteriología</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
            @if($examen->area == "BACTERIOLOGIA")
              <span class="button-checkbox  col-xs-12">
                <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                  <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
                </button>
                <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
              </span>
            @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content2" role="tabpanel" aria-labelledby="tab2">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Exámenes de heces</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
            @if($examen->area == "EXAMENES DE HECES")
              <span class="button-checkbox  col-xs-12">
                <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                  <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
                </button>
                <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
              </span>
            @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content3" role="tabpanel" aria-labelledby="tab3">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Exámenes de orina</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "EXAMENES DE ORINA")
            <span class="button-checkbox  col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content4" role="tabpanel" aria-labelledby="tab4">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Hematología</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "HEMATOLOGIA")
            <span class="button-checkbox col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content5" role="tabpanel" aria-labelledby="tab5">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Inmunología</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "INMUNOLOGIA")
            <span class="button-checkbox col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content6" role="tabpanel" aria-labelledby="tab6">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Química sanguinea</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "QUIMICA SANGUINEA")
            <span class="button-checkbox col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content7" role="tabpanel" aria-labelledby="tab7">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Enzimas</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "ENZIMAS")
            <span class="button-checkbox col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content8" role="tabpanel" aria-labelledby="tab8">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Pruebas especiales</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "PRUEBAS ESPECIALES")
            <span class="button-checkbox col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab_content9" role="tabpanel" aria-labelledby="tab9">
    <div>
      <div class="row">
        <center>
          <h5 class="big-text">Área de Otros exámenes</h5>
        </center>
      </div>
      <br>
      <div class="row">
        @foreach($examenes as $examen)
          @if($examen->area == "OTROS")
            <span class="button-checkbox col-xs-12">
              <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success" onclick="agregarExamenEnSolicitud2(this);">
                <span id="nombre_de_examen">{{ $examen->nombreExamen }}</span> | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
              </button>
              <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
            </span>
          @endif
        @endforeach
      </div>
    </div>
  </div>

</div>