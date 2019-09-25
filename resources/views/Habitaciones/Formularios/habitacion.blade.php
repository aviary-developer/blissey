<div class="flex-row">
  <center>
    <h5 class="">
      Habitación
    </h5>
  </center>
</div>
<div class="flex-row">
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
  <div class="flex-row">
    <center>
      <h5 class="">Área</h5>
    </center>
  </div>
  <div class="flex-row">
		@if (!isset($habitaciones))   
			<div id="radioBtn" class="btn-group col-12">
				<a class="btn btn-primary btn-sm active col-6" data-toggle="tipo" data-title="1">Hospital</a>
				<a class="btn btn-primary btn-sm notActive col-6" data-toggle="tipo" data-title="0">Observación</a>
				{{--  <a class="btn btn-primary btn-sm notActive col-4" data-toggle="tipo" data-title="2">Medio Ingreso</a>  --}}
			</div>
			<input type="hidden" name="tipo" id="tipo" value="1">
		@else
			<center>
				@if ($habitaciones->tipo == 0)
					<h4 class="badge badge-primary font-sm">Observación</h4>
				@elseif($habitaciones->tipo == 1)
					<h4 class="badge badge-success font-sm">Ingreso</h4>
				@else
					<h4 class="badge badge-purple font-sm">Medio ingreso</h4>  
				@endif
			</center>
			<input type="hidden" id="id" value={{$habitaciones->id}}>
			<input type="hidden" id="tipo" value={{$habitaciones->tipo}}>
		@endif
  </div>
</div>
<br>
<div class="flex-row">
	<center>
		<button type="button" class="btn btn-sm btn-dark col-6" id="cama_nueva">
			<i class="fa fa-plus"></i> Agregar cama
		</button>
	</center>
</div>
@if (!$create)
<br>
  <div class="flex-row">
    <center>
			<button type="button" class="btn btn-sm btn-success col-4" id="show_activo"> Activos <span class="badge badge-light text-success" > {{$count_cama_a}} </span></button>
			<button type="button" class="btn btn-sm btn-danger col-4"  id="show_papelera"> Papelera <span class="badge badge-light text-danger"> {{$count_cama_i}} </span></button>
		</center>
  </div>
@endif