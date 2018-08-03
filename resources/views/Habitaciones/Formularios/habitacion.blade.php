<div class="row">
  <center>
    <h4 class="big-text">
      Habitación
    </h4>
  </center>
</div>
<div class="row">
  <center>
    <div class="circulo-div bg-c1" id="fondo"> 
      <center>
        <span id="hnumero">{{$count_hi}}</span>
        <input type="hidden" name="numero" value={{$count_hi}} id="hnumero_i">
      </center>
    </div>
  </center>
</div>

<div id="grupo_">
  <br>
  <div class="row">
    <center>
      <span class="big-text">Área</span>
    </center>
  </div>
  <div class="row">
    <div class="form-group">
      @if (isset($habitaciones))
        @if ($habitaciones->tipo == 1)
          <div id="radioBtn" class="btn-group">
            <a class="btn btn-primary btn-sm active" data-toggle="tipo" data-title="1">Hospital</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="0">Observación</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="2">Medi Ingreso</a>
          </div>
          <input type="hidden" name="tipo" id="tipo" value="1">  
        @elseif($habitaciones->tipo == 2)
          <div id="radioBtn" class="btn-group">
            <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="1">Hospital</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="0">Observación</a>
            <a class="btn btn-primary btn-sm active" data-toggle="tipo" data-title="2">Medi Ingreso</a>
          </div>
          <input type="hidden" name="tipo" id="tipo" value="2">  
        @else
          <div id="radioBtn" class="btn-group">
            <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="1">Hospital</a>
            <a class="btn btn-primary btn-sm active" data-toggle="tipo" data-title="0">Observación</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="2">Medi Ingreso</a>
          </div>
          <input type="hidden" name="tipo" id="tipo" value="0">
        @endif
      @else    
        <div id="radioBtn" class="btn-group col-xs-12">
          <a class="btn btn-primary btn-sm active col-xs-4" data-toggle="tipo" data-title="1">Hospital</a>
          <a class="btn btn-primary btn-sm notActive col-xs-4" data-toggle="tipo" data-title="0">Observación</a>
          <a class="btn btn-primary btn-sm notActive col-xs-4" data-toggle="tipo" data-title="2">Medi Ingreso</a>
        </div>
        <input type="hidden" name="tipo" id="tipo" value="1">
      @endif
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-xs-3"></div>
  <button type="button" class="btn btn-sm btn-dark col-xs-6" id="cama_nueva">
    <i class="fa fa-plus"></i> Agregar cama
  </button>
</div>