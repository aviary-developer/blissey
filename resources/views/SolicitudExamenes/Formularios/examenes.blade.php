<div role="tabpanel" data-example-id="togglable-tabs">
  <div class="col-xs-2">
    <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
      <li role="presentation" class="active">
        <a href="#tab_c_ex_1" id="tab_ex_1" role="tab" data-toggle="tab" aria-expanded="true">
          Bacteriología
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content2" id="tab2" role="tab" data-toggle="tab" aria-expanded="true">
          Exámenes de heces
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content3" id="tab3" role="tab" data-toggle="tab" aria-expanded="true">
          Exámenes de orina
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content4" id="tab4" role="tab" data-toggle="tab" aria-expanded="true">
          Hematología
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content5" id="tab5" role="tab" data-toggle="tab" aria-expanded="true">
          Inmunología
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content6" id="tab6" role="tab" data-toggle="tab" aria-expanded="true">
          Química sanguinea
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content7" id="tab7" role="tab" data-toggle="tab" aria-expanded="true">
          Enzimas
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content8" id="tab8" role="tab" data-toggle="tab" aria-expanded="true">
          Pruebas especiales
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content9" id="tab9" role="tab" data-toggle="tab" aria-expanded="true">
          Otros
        </a>
      </li>
    </ul>
  </div>
  <div class="col-xs-10">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="tab_c_ex_1" role="tabpanel" aria-labelledby="tab_ex_1">
        <div>
          <div class="row">
            <h3>Área de Bacteriología</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
                @if($examen->area == "BACTERIOLOGIA")
                  <span class="button-checkbox col-md-4 col-sm-4 col-xs-12">
                    <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                      {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Exámenes de heces</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
                @if($examen->area == "EXAMENES DE HECES")
                  <span class="button-checkbox col-md-4 col-sm-4 col-xs-12">
                    <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                      {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Exámenes de orina</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "EXAMENES DE ORINA")
                <span class="button-checkbox col-md-4 col-sm-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Hematología</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "HEMATOLOGIA")
                <span class="button-checkbox col-md-4 col-xs-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Inmunología</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "INMUNOLOGIA")
                <span class="button-checkbox col-md-4 col-xs-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Química sanguinea</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "QUIMICA SANGUINEA")
                <span class="button-checkbox col-md-4 col-xs-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Enzimas</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "ENZIMAS")
                <span class="button-checkbox col-md-4 col-xs-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Pruebas especiales</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "PRUEBAS ESPECIALES")
                <span class="button-checkbox col-md-4 col-xs-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
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
            <h3>Área de Otros exámenes</h3>
          </div>
          <br>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "OTROS")
                <span class="button-checkbox col-md-4 col-xs-4 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }} | <strong>{{ $examen->nombreMuestra($examen->tipoMuestra) }}</strong>
                  </button>
                  <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                </span>
              @endif
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
