@php
if($especialidades!=null){
  $total_especialidad = count($especialidades);

}else{
  $total_especialidad =0;
}
@endphp
<div role="tabpanel">
  <div class="col-xs-2">
    <ul id="tab_med" class="nav nav-tabs tabs-left" role="tablist">
      @for ($i = 0; $i <= $total_especialidad; $i++)
        @if ($i == 0)
          <li role="presentation" class="active">
            <a href={{"#medCont".$i}} id={{"tab_med".$i}} role="tab" data-toggle="tab" aria-expanded="true">{{"Médicina General"}}</a>
          </li>
        @else
          <li role="presentation">
            <a href={{"#medCont".$i}} id={{"tab_med".$i}} role="tab" data-toggle="tab" aria-expanded="true">{{$especialidades[($i-1)]->nombre}}</a>
          </li>
        @endif
      @endfor
    </ul>
  </div>
  <div class="col-xs-10">
    <div id="tab_medContent" class="tab-content">
      @for ($i = 0; $i <= $total_especialidad; $i++)
        @if ($i == 0)
          <div role="tabpanel" class="tab-pane fade active in" id={{"medCont".$i}} aria-labelledby={{"tab_med".$i}}>
            <div>
              <div class="row">
                <h3>{{"Médicina General"}}</h3>
              </div>
              <div class="row">
                @foreach ($medicos_general as $medico)
                  <div class="col-xs-3">
                    <center>
                      <div class="checkbox-img" id="check-img">
                        <img src={{asset(Storage::url($medico->foto))}} class="img-circle perfil-2 borde">
                        <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->id)}} class="hidden">
                      </div>
                      <span>{{(($medico->sexo)?"Dr. ":"Dra. ").$medico->nombre.' '.$medico->apellido}}</span>
                    </center>
                  </div>
                @endforeach
              </div>
        @else
          <div role="tabpanel" class="tab-pane fade" id={{"medCont".$i}} aria-labelledby={{"tab_med".$i}}>
            <div>
              <div class="row">
                <h3>{{$especialidades[($i-1)]->nombre}}</h3>
              </div>
              <div class="row">
                <h4 class="blue">Especialidad Principal</h4>
              </div>
              <div class="row">
                @foreach ($especialidades[($i-1)]->usuario_especialidad as $medico)
                  @if ($medico->principal)
                    <div class="col-xs-3">
                      <center>
                        <div class="checkbox-img" id="check-img">
                          <img src={{asset(Storage::url($medico->usuario->foto))}} class="img-circle perfil-2 borde">
                          <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->usuario->id)}} class="hidden">
                        </div>
                        <span>{{(($medico->usuario->sexo)?"Dr. ":"Dra. ").$medico->usuario->nombre.' '.$medico->usuario->apellido}}</span>
                      </center>
                    </div>
                  @endif
                @endforeach
              </div>
              <br>
              <div class="row">
                <h4 class="blue">Subespecialidad</h4>
              </div>
              <div class="row">
                @foreach ($especialidades[($i-1)]->usuario_especialidad as $medico)
                  @if (!$medico->principal)
                    <div class="col-xs-3">
                      <center>
                        <div class="checkbox-img" id="check-img">
                          <img src={{asset(Storage::url($medico->usuario->foto))}} class="img-circle perfil-2 borde">
                          <input type="checkbox" name="medicos[]" value={{App\User::buscar_servicio($medico->usuario->id)}} class="hidden">
                        </div>
                        <span>{{(($medico->usuario->sexo)?"Dr. ":"Dra. ").$medico->usuario->nombre.' '.$medico->usuario->apellido}}</span>
                      </center>
                    </div>
                  @endif
                @endforeach
              </div>
        @endif
          </div>
        </div>
      @endfor
    </div>
  </div>
</div>