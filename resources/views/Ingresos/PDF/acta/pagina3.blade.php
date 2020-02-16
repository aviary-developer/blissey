<div class="page">
  <br>
  <div>
    <center>
      <h3>HOJA DE AUTORIZACIÓN PARA TRATAMIENTO</h3>
    </center>
  </div>
  <div class="col-xs-12">
    @php
      setlocale(LC_ALL, 'es');
      $hoy = Carbon\Carbon::now()
    @endphp
    <div class="col-xs-12 text-justify">
      <p class="col-xs-12">
        @if ($ingreso->hospitalizacion->f_paciente != $ingreso->hospitalizacion->f_responsable)  
          Yo, <b>{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}</b> con Documento Único de Identidad personal número:&nbsp;
          @if ($ingreso->hospitalizacion->responsable->dui != null)
            <b>{{$ingreso->hospitalizacion->responsable->dui}}</b>    
          @else
            <b><i class="red">Falta DUI</i></b>
          @endif
          en mi carácter como Representante Legal de mi pariente, <b>{{$ingreso->hospitalizacion->paciente->nombre.' '.$ingreso->hospitalizacion->paciente->apellido}}</b> , <b><i>doy mi consentimiento</i></b>, al Personal Médico, Cirujano y de Enfermería de este Centro Hospitalario, para que traten la enfermedad de mi Representado, en la forma Técnica que ellos crean convenientes, a fin de recuperar la salud de mi Representado.
        @else
          Yo, <b>{{$ingreso->hospitalizacion->paciente->nombre.' '.$ingreso->hospitalizacion->paciente->apellido}}</b>&nbsp;  con Documento Único de Identidad personal número &nbsp;
          @if ($ingreso->hospitalizacion->paciente->dui != null)
            <b>{{$ingreso->hospitalizacion->paciente->dui}}</b>    
          @else
            <b><i class="red">Falta DUI</i></b>
          @endif
          en mi carácter personal, <b><i>doy mi consentimiento</i></b>, al Personal Médico, Cirujano y de Enfermería de este Centro Hospitalario, para que traten mi enfermedad, en la forma Técnica que ellos crean convenientes, a fin de recuperar mi salud.
        @endif
      </p>
      <br>
      <p class="col-xs-12">
        <b><i>Eximo</b></i>, al Hospital Divino Niño y a su Personal Técnico de toda responsabilidad que pudiera derivarse del o de los tratamientos hechos a mi persona o a en la persona de mi representado, tantos a los servicios de consultoría como en los servicios internos de este centro hospitalario.
      </p>
      <br>
      <p class="col-xs-12">
        Con base a las leyes penales, faculto a las autoridades correspondientes y al Centro Hospitalario para que puedan practicar en caso de fallecimiento, las <b><i>“Autopsias de ley”</i></b>.
      </p>
      <br>
      <p class="col-xs-12">
        San Vicente, {{$hoy->formatLocalized('%d del mes de %B del año %Y')}}
        <br><br><br>
      </p>
      <p class="col-xs-6 subrayar">F.</p>
      <p class="col-xs-12">Firma o Huella del {{($ingreso->hospitalizacion->paciente->fechaNacimiento->age < 18)?"Representante Legal":"Paciente"}}</p>
      <p class="col-xs-6 subrayar">F.</p>
      <p class="col-xs-12">Nombre y firma del tesitigo, del acompañante o del que firma a ruego</p>
      <p class="col-xs-6 subrayar">DUI No.</p>
    </div>
  </div>
</div>