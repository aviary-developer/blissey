<div id="informacion__" class="row">
  <div class="row">
    <center>
      <img src={{asset((($paciente->sexo)?'img/hombre.png':'img/mujer.png'))}} class="img-circle perfil-2" style="width: 80px; height: 80px;">
    </center>
  </div>
  <div class="row">
    <center>
      <h3>{{$paciente->nombre.' '.$paciente->apellido}}</h3>
    </center>
  </div>
  <div class="row">
    <center>
      <h5>{{$paciente->fechaNacimiento->age.' años'}}</h5>
    </center>
  </div>
  <div class="ln_solid" style="margin: 5px 20px;"></div>
  <div class="row">
    <center>
      @if ($paciente->alergia == null)
        <span class="label label-lg label-gray" style="padding-left: 30px; padding-right:30px;">Alergias</span>
        @else
        <span class="label label-lg label-warning" style="padding-left: 30px; padding-right:30px;">Alergias</span>  
      @endif
    </center>
  </div>
  <br>
  <br>
  <div class="row">
    <center>
      @if ($paciente->alergia == null)
        <p><i>El paciente no tiene ninguna alegia</i></p>  
      @else                            
        <p>{{$paciente->alergia}}</p>
      @endif
    </center>
  </div>
  <div class="row">
    <center>
      <input type="hidden" id="f__paciente" value={{$paciente->id}}>
      <input type="hidden" id="alergia_" value="{{$paciente->alergia}}">
      <button type="button" class="btn btn-xs btn-link" id="alergia_btn">Editar</button>
    </center>
  </div>
</div>