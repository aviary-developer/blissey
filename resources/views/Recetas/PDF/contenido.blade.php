@extends('PDF.hoja')
@section('layout')
<style>
  div, span, b, p, i{
    font-size: large;
  }
</style>
<div>
  @php
    setlocale(LC_ALL,'es');
  @endphp
  <div class="row" style="margin-top: 10px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
      <center>
        <h2>Tratamiento Médico</h2>
      </center>
    </div>
    <div class="col-xs-3">
      <div class="row">
        <center>
          <img src={{'data:image/png;base64,' . DNS1D::getBarcodePNG($consulta->recetas[0]->barcode, "C128",2,30,array(1,1,1),true)}} alt="barcode"/>
        </center>
      </div>
      <div class="row">
        <center>
          {{$consulta->recetas[0]->barcode}}
        </center>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <div class="col-xs-4" >
        Paciente:
      </div>
      <div class="col-xs-8">
        <b class="">
          {{$consulta->ingreso->hospitalizacion->paciente->nombre.' '.$consulta->ingreso->hospitalizacion->paciente->apellido}}
        </b>
      </div>
    </div>
    
	</div>
	<div class="row">
		<div class="col-xs-8">
      <div class="col-xs-4">
        Fecha de consulta:
      </div>
      <div class="col-xs-6">
        <b>
          {{$consulta->created_at->formatLocalized('%d de %B de %Y')}}
        </b>
      </div>
    </div>
	</div>
  @if ($consulta->recetas->where('nombre_producto','!=',null)->count() > 0)
    <br>
    <div class="row">
      <div class="col-xs-10">
        <h3 class="gray">
          Medicamento
        </h3>
      </div>
    </div>
    @foreach ($consulta->recetas->where('nombre_producto','!=',null) as $receta)
      <div class="row">
        <div class="col-xs-12">
          <p>
            <i class="fa fa-check blue"></i> {{$receta->cantidad_dosis}} 
            @if ($receta->forma_dosis == 0 && $receta->f_producto != null )
              {{$receta->producto->presentacion->nombre}}
            @else
              {{$consulta->dosis($receta->forma_dosis)}}
            @endif
             de <b class="blue">{{$receta->nombre_producto}}</b> cada {{$consulta->tiempos($receta->cantidad_frecuencia,$receta->forma_frecuencia)}} durante 
            {{$consulta->tiempos($receta->cantidad_duracion,$receta->forma_duracion)}}
            @if ($receta->observacion != null)
              <i>Nota: {{$receta->observacion}}</i>
            @endif
          </p>
        </div>
      </div>
    @endforeach
  @endif
  @if ($consulta->recetas->where('f_examen','!=',null)->count() > 0)
    <br>
    <div class="row">
      <div class="col-xs-10">
        <h3 class="gray">
          Laboratorio clínico
        </h3>
      </div>
    </div>
    @foreach ($consulta->recetas->where('f_examen','!=',null) as $receta)
      <div class="row">
        <div class="col-xs-12">
          <p>
            <i class="fa fa-check blue"></i> Realizarse un examen de 
            <b class="blue">
              {{$receta->examen->nombreExamen}}
            </b>
          </p>
        </div>
      </div>
    @endforeach
  @endif
  @if ($consulta->recetas->where('f_ultrasonografia','!=',null)->count() > 0)
    <br>
    <div class="row">
      <div class="col-xs-10">
        <h3 class="gray">
          Ultrasonografía
        </h3>
      </div>
    </div>
    @foreach ($consulta->recetas->where('f_ultrasonografia','!=',null) as $receta)
      <div class="row">
        <div class="col-xs-12">
          <p>
            <i class="fa fa-check blue"></i> Realizarse una ultrasonografía 
            {{$consulta->articulo($receta->ultrasonografia->nombre)}} 
            <b class="blue">
              {{$receta->ultrasonografia->nombre}}
            </b>
          </p>
        </div>
      </div>
    @endforeach
  @endif
  @if ($consulta->recetas->where('f_rayox','!=',null)->count() > 0)
    <br>
    <div class="row">
      <div class="col-xs-10">
        <h3 class="gray">
          Rayos X
        </h3>
      </div>
    </div>
    @foreach ($consulta->recetas->where('f_rayox','!=',null) as $receta)
      <div class="row">
        <div class="col-xs-12">
          <p>
            <i class="fa fa-check blue"></i> Realizarse una radiografía  
            {{$consulta->articulo($receta->rayox->nombre)}} 
            <b class="blue">
              {{$receta->rayox->nombre}}
            </b>
          </p>
        </div>
      </div>
    @endforeach
  @endif
  @if ($consulta->recetas->where('f_tac','!=',null)->count() > 0)
    <br>
    <div class="row">
      <div class="col-xs-10">
        <h3 class="gray">
          {{"Tomografía Axial Computarizada (TAC)"}}
        </h3>
      </div>
    </div>
    @foreach ($consulta->recetas->where('f_tac','!=',null) as $receta)
      <div class="row">
        <div class="col-xs-12">
          <p>
            <i class="fa fa-check blue"></i> Realizarse una tomografía  
            {{$consulta->articulo($receta->tac->nombre)}} 
            <b class="blue">
              {{$receta->tac->nombre}}
            </b>
          </p>
        </div>
      </div>
    @endforeach
  @endif
  @if ($consulta->recetas->detalle->where('Texto','!=',null)->count() > 0)
    <br>
    <div class="row">
      <div class="col-xs-10">
        <h3 class="gray">
          Tratamiento
        </h3>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        @php
          $receta = $consulta->recetas->detalle->where('Texto','!=',null)->first();
        @endphp
        {!! $receta->Texto !!}
      </div>
    </div>
  @endif
  <div class="row">
    <div class="col-xs-5"></div>
    <div class="col-xs-7">
      <div class="alignright">
        <img src={{asset(Storage::url($consulta->medico->firma))}} style="width:180px;">
        <img src={{asset(Storage::url($consulta->medico->sello))}} style="width:180px;">
      </div>
      <div class="alignright">
        <i class="fa fa-stethoscope"></i> 
        <span style="font-family: 'Monotype Corsiva'">
          {{(($consulta->medico->sexo)?"Dr. ":"Dra. ").$consulta->medico->nombre.' '.$consulta->medico->apellido}}
        </span>
      </div>
      <div class="alignright">
        <span style="font-family: 'Monotype Corsiva'">
          {{'JVPM '.$consulta->medico->juntaVigilancia}}
        </span>
      </div>
    </div>
  </div>
</div>
@endsection