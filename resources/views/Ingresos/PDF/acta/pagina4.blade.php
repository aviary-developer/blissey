<div class="page">
  <br>
  <div>
    <center>
      <h3>HOJA DE AUTORIZACIÓN DE PROCEDIMIENTOS Y TRATAMIENTOS MÉDICOS EN EL HOSPITAL “DIVINO NIÑO” DE SAN VICENTE.</h3>
    </center>
  </div>
  @php
    setlocale(LC_ALL, 'es');
    $hoy = Carbon\Carbon::now()
  @endphp
  <div class="col-xs-12 text-justify">
    <p class="col-xs-12">
      @if ($ingreso->paciente->fechaNacimiento->age < 18)
        Yo, <b class="subrayar">{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</b> de <b class="subrayar">{{$ingreso->responsable->fechaNacimiento->age}}</b> años, con Documento Único de Identidad número:&nbsp; <b class="subrayar">{{$ingreso->responsable->dui}}</b>, extendido en la ciudad de San Vicente, <b><i>Manifiesto</i></b>:
      @else
        Yo, <b class="subrayar">{{$ingreso->paciente->nombre.' '.$ingreso->paciente->apellido}}</b> de <b class="subrayar">{{$ingreso->paciente->fechaNacimiento->age}}</b> años, con Documento Único de Identidad número:&nbsp; <b class="subrayar">{{$ingreso->paciente->dui}}</b>, extendido en la ciudad de San Vicente, <b><i>Manifiesto</i></b>:
      @endif
    </p>
    <br>
    <p class="col-xs-12">
      @if ($ingreso->paciente->fechaNacimiento->age < 18)
        1 – Que mi pariente es paciente {{($ingreso->medico->sexo)?"del doctor":"de la doctora"}} <b class="subrayar">{{$ingreso->medico->nombre.' '.$ingreso->medico->apellido}}</b>, médico general, acreditado en la Junta de Vigilancia de la Profesión Médica número: <b class="subrayar">{{$ingreso->medico->juntaVigilancia}}</b>.
      @else
        1 – Que mi persona es paciente {{($ingreso->medico->sexo)?"del doctor":"de la doctora"}} <b class="subrayar">{{$ingreso->medico->nombre.' '.$ingreso->medico->apellido}}</b>, médico general, acreditado en la Junta de Vigilancia de la Profesión Médica número: <b class="subrayar">{{$ingreso->medico->juntaVigilancia}}</b>.
      @endif
    </p>
    <p class="col-xs-12">
      2 – Conocedor de que el/la, x no mantiene con el Hospital “Divino Niño” ninguna relación laboral ni salarial; estoy en la disposición de ser atendido en dicho centro, conocer de que Hospital “Divino Niño” reúne las condiciones adecuadas para el (los) procedimiento(s) y tratamiento(s) que se me efectuará(n).
    </p>
    <p class="col-xs-12">
      3 – Que estoy consciente del estado de salud de mi {{($ingreso->paciente->fechaNacimiento->age < 18)?"pariente":"persona"}} y la posibilidad de riesgo que conlleva toda ejecución de procedimientos médicos, por lo que {{($ingreso->medico->sexo)?"el doctor":"la doctora"}} me ha explicado de forma amplia y razonable sobre los mismos.
    </p>
    <p class="col-xs-12">
      4 – Conociendo la responsabilidad de mi médico tratante, mantendrá conmigo y mi familia cercana la información de la evolución de la patología que hoy presento y ante cualquier situación que se presentase nos expondrá el plan a seguir para un tratamiento adecuado.
    </p>
    <p class="col-xs-12">
      5 – Exonero al Hospital “Divino Niño” y a su personal médico y paramédico, así como a la Dirección y Administración de este, de cualquier complicación médica que se sobrevenga como también de cualquier responsabilidad que se acontezca.
    </p>
    <p class="col-xs-12">
      Por lo tanto, me manifiesto conforme y autorizo {{($ingreso->medico->sexo)?"al doctor":"a la doctora"}} que proceda a efectuar lo recomendado hacia la patología clínica de mi {{($ingreso->paciente->fechaNacimiento->age < 18)?"pariente":"persona"}} en el Hospital “Divino Niño”, institución que se encuentra debidamente inscripta en las instancias correspondientes para su operatividad.
    </p>
    <p class="col-xs-12">
      San Vicente, {{$hoy->formatLocalized('%d de %B del %Y')}}
      <br><br>
    </p>
    <b class="subrayar col-xs-4">F.</b>
    @if ($ingreso->paciente->fechaNacimiento->age < 18)
      <p class="col-xs-12">{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</p>
      <p class="col-xs-12">DUI: {{$ingreso->responsable->dui}}</p>  
    @else        
      <p class="col-xs-12">{{$ingreso->paciente->nombre.' '.$ingreso->paciente->apellido}}</p>
      <p class="col-xs-12">DUI: 
        @if ($ingreso->paciente->dui != null)                    {{$ingreso->paciente->dui}}
        @else
          <b><i class="red">Falta DUI</i></b>
        @endif
      </p>
    @endif
    <p class="col-xs-12"><br><br></p>
    <b class="subrayar col-xs-4">F.</b>
  </div>
</div>