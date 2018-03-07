<div role="tabpanel" data-example-id="togglable-tabs">
  <div class="col-xs-2">
    <ul class="nav nav-tabs tabs-left" id="medicoTab" role="tablist">
      <li class="active" role="presentation">
        <a href="#tab_contenido_medico_x" role="tab" id="tab_medico_x" data-toogle="tab" aria-expanded="true">
          Médico General
        </a>
      </li>
      @foreach ($especialidades as $i => $especialidad)
        <li role="presentation">
          <a href={{"#tab_contenido_medico_".$i}} role="tab" id={{"tab_medico_".$i}} data-toogle="tab" aria-expanded="true">{{$especialidad->nombre}}</a>
        </li>
      @endforeach
    </ul>
  </div>
  <div class="col-xs-10">
    <div class="tab-content" id="medicoTabContent">
      <div class="tab-pane fade active in" id="tab_contenido_medico_x" role="tabpanel" aria-labelledby="tab_medico_x">
        <div>
          <div class="row">
            <h3>Médico General</h3>
          </div>
          <br>
          <div class="row"></div>
        </div>
      </div>
      @foreach ($especialidades as $i => $especialidad)
        <div class="tab-pane fade" id={{"tab_contenido_medico_".$i}} role="tabpanel" aria-labelledby={{"tab_medico_".$i}}>
          <div>
            <div class="row">
              <h3>{{$especialidad->nombre}}</h3>
            </div>
            <br>
            <div class="row"></div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>