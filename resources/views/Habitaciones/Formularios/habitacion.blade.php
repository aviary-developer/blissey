<div class="row">
  <center>
    <h4 class="big-text">
      Habitación
    </h4>
  </center>
</div>
<div class="row">
  <center>
    @if (isset($habitaciones))
      @if ($habitaciones->tipo == 0)
        <div class="circulo-div bg-c2" id="fondo"> 
      @elseif($habitaciones->tipo == 1)
        <div class="circulo-div bg-c1" id="fondo"> 
      @else
        <div class="circulo-div bg-c3" id="fondo"> 
      @endif
    @else
      <div class="circulo-div bg-c1" id="fondo"> 
    @endif
      <center>
        <span id="hnumero">{{(!isset($habitaciones))?$count_hi:$habitaciones->numero}}</span>
        <input type="hidden" name="numero" value={{(!isset($habitaciones))?$count_hi:$habitaciones->numero}} id="hnumero_i">
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
      @if (!isset($habitaciones))   
        <div id="radioBtn" class="btn-group col-xs-12">
          <a class="btn btn-primary btn-sm active col-xs-4" data-toggle="tipo" data-title="1">Hospital</a>
          <a class="btn btn-primary btn-sm notActive col-xs-4" data-toggle="tipo" data-title="0">Observación</a>
          <a class="btn btn-primary btn-sm notActive col-xs-4" data-toggle="tipo" data-title="2">Medi Ingreso</a>
        </div>
        <input type="hidden" name="tipo" id="tipo" value="1">
      @else
        <center>
          @if ($habitaciones->tipo == 0)
            <h4 class="label label-primary label-lg">Observación</h4>
          @elseif($habitaciones->tipo == 1)
            <h4 class="label label-success label-lg">Ingreso</h4>
          @else
            <h4 class="label label-purple label-lg">Medi ingreso</h4>  
          @endif
        </center>
        <input type="hidden" id="id" value={{$habitaciones->id}}>
        <input type="hidden" id="tipo" value={{$habitaciones->tipo}}>
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
@if (!$create)
<br>
  <div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-4">
      <button type="button" class="btn btn-sm btn-success col-xs-12" id="show_activo"> Activos <span class="label label-lg label-white green" > {{$count_cama_a}} </span></button>
    </div>
    <div class="col-xs-4">
      <button type="button" class="btn btn-sm btn-danger col-xs-12"  id="show_papelera"> Papelera <span class="label label-lg label-white red"> {{$count_cama_i}} </span></button>
    </div>
  </div>
@endif