<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">Se recomienda busquedas no mayores a <b>15 días</b>.</p>
  </center>
</div>
{!!Form::open(['id'=>'busquedaHistorial','url' =>'busquedaHistorial','method' =>'GET','autocomplete'=>'off'])!!}
<div class="form-group">
  <div class="row">
    <div class="btn-group col-sm-12">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="busquedaPor" id="inlineRadio1" checked value="nombre" onclick="habilitarBusquedaPor();">
        <label class="form-check-label" for="inlineRadio1">Por nombre</label>
      </div>
      <div class="col-1"></div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="busquedaPor" id="inlineRadio2" value="fechas" onclick="habilitarBusquedaPor();">
        <label class="form-check-label" for="inlineRadio2">Por fechas</label>
      </div>
      <div class="col-1"></div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="busquedaPor" id="inlineRadio3" value="hoy" onclick="habilitarBusquedaPor();">
        <label class="form-check-label" for="inlineRadio3">Este día</label>
      </div>
      <div class="col-1"></div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="busquedaPor" id="inlineRadio4" value="examenes" onclick="habilitarBusquedaPor();">
        <label class="form-check-label" for="inlineRadio4">Por exámenes</label>
      </div>
    </div>
  </div>
  <br>
    <div class="row">
      <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12" id="divNombre">
        <div class="form-group"> 
          <label class="control-label" for="nombre">Nombre</label>
    <input type="text" id="buscarNombre" class="form-control" name="buscarNombre" placeholder="Buscar" value="">
  </div>
  </div>
		 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" id="divFecha1" style="display: none;">
          <div class="form-group"> 
        <label class="control-label" for="date">Fecha inicial</label>
        <input class="form-control" id="fechaInicial" name="fechaInicial"  placeholder="DD/MM/AA" value="" type="date" max="<?php echo date('Y-m-d');?>"/>
      </div>
         </div>
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" id="divFecha2" style="display: none;">
          <div class="form-group"> 
        <label class="control-label" for="date">Fecha final</label>
        <input class="form-control" id="fechaFinal" name="fechaFinal" placeholder="DD/MM/AA" value="" type="date" max="<?php echo date('Y-m-d');?>"/>
      </div>
         </div>
         <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12" id="divHoy" style="display: none;" >
          <div class="form-group"> 
            <label class="control-label" for="nombre">Fecha actual</label>
            @php
                $hoy = Carbon\Carbon::now();
                $hoy = $hoy->format('d/m/Y')
            @endphp
      <input type="text" class="form-control" name="hoy" value="{{$hoy}}" disabled>
    </div>
    </div>
    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12" id="divBusquedaExamenes" style="display: none;">
      <div class="form-group"> 
        <label class="control-label" for="nombre">Exámenes</label>
        @php
            $exams=App\Examen::orderBy('nombreExamen')->get();
        @endphp
        <select class="form-control form-control-sm" name="examenBuscar">
          @foreach($exams as $item)
            <option value="{{$item->id}}">{{$item->nombreExamen}}</option>
          @endforeach
        </select>
</div>
</div>
		<span class="input-group-btn"><br><button type="button" onclick="verificar();" class="btn btn-primary">Buscar</button></span>
  </div>
</div>
{!!Form::close()!!}
<script>
  function verificar(){
    let fechaInicial=$("#fechaInicial").val();
    let fechaFinal=$("#fechaFinal").val();
    if($("#inlineRadio1").prop('checked')){
      if($("#buscarNombre").val()==""){
        swal({
          type: 'error',
          toast: true,
          title: '¡Error!',
          text: 'Ingrese nombre de paciente',
          position: 'center',
          showConfirmButton: false,
          timer: 4000
        });
      }else{
        $("#busquedaHistorial").submit();
      }
    }else if($("#inlineRadio2").prop('checked')){
      if(fechaInicial==""){
        swal({
          type: 'error',
          toast: true,
          title: '¡Error!',
          text: 'Ingrese fecha inicial',
          position: 'center',
          showConfirmButton: false,
          timer: 4000
        });
    }else if(fechaFinal==""){
      swal({
          type: 'error',
          toast: true,
          title: '¡Error!',
          text: 'Ingrese fecha final',
          position: 'center',
          showConfirmButton: false,
          timer: 4000
        });
    }else if(Date.parse(fechaFinal) < Date.parse(fechaInicial)){
      swal({
          type: 'error',
          toast: true,
          title: '¡Error!',
          text: 'Fecha final es menor que fecha inicial',
          position: 'center',
          showConfirmButton: false,
          timer: 4000
        });
    }else{
      $("#busquedaHistorial").submit();
    }
  }else{
    $("#busquedaHistorial").submit();
  }
  }
  function habilitarBusquedaPor(){
    if($("#inlineRadio1").prop('checked')){
      $("#divNombre").show();
      $("#divFecha1").hide();
      $("#divFecha2").hide();
      $("#divHoy").hide();
      $("#divBusquedaExamenes").hide();
    }else if($("#inlineRadio2").prop('checked')){
      $("#divFecha1").show();
      $("#divFecha2").show();
      $("#divNombre").hide();
      $("#divHoy").hide();
      $("#divBusquedaExamenes").hide();
    }else if($("#inlineRadio3").prop('checked')){
      $("#divFecha1").hide();
      $("#divFecha2").hide();
      $("#divNombre").hide();
      $("#divBusquedaExamenes").hide();
      $("#divHoy").show();
    }else if($("#inlineRadio4").prop('checked')){
      $("#divFecha1").hide();
      $("#divFecha2").hide();
      $("#divNombre").hide();
      $("#divBusquedaExamenes").show();
      $("#divHoy").hide();
    }
  }
</script>