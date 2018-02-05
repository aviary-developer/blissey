<div class="page">

  <div>
    <center>
      <h3>HOJA DE CONFORMIDAD DE GASTOS HOSPITALARIOS</h3>
      <br>
      <h4>GENERALES DEL CLIENTE</h4>
    </center>
  </div>
  <div>
    <div class="col-xs-9">
      <div class="col-xs-2">
        <span>PACIENTE:</span>
      </div>
      <div class="col-xs-10 subrayar">
        <b>{{' '.$ingreso->paciente->nombre.' '.$ingreso->paciente->apellido}}</b>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="col-xs-6">
        <span>EDAD:</span>
      </div>
      <div class="col-xs-6 subrayar">
        <b>
          {{' '.$ingreso->paciente->fechaNacimiento->age.' años'}}
        </b>
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-9">
      <div class="col-xs-2">
        <span>DIRECCIÓN:</span>
      </div>
      <div class="col-xs-10 subrayar">
        @if ($ingreso->paciente->direccion != null)
          <b>{{$ingreso->paciente->direccion}}</b>
        @else
          <i><b class="red">Falta la dirección</b></i>
        @endif
      </div>
    </div>
    <div class="col-xs-3">
      <div class="col-xs-6">
        <span>TELÉFONO:</span>
      </div>
      <div class="col-xs-6 subrayar">
        @if ($ingreso->paciente->telefono != null)  
          <b>{{' '.$ingreso->paciente->telefono}}</b>
        @else
          <i><b class="red">Falta el tel.</b></i>
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-7">
      <div class="col-xs-5 row">
        <div class="col-xs-5">
          FECHA:
        </div>
        <div class="col-xs-7 subrayar">
          <b>{{' '.$ingreso->fecha_ingreso->format('d / m / Y')}}</b>
        </div>
      </div>
      <div class="col-xs-4 row">
        <div class="col-xs-5">
          <span>
            HORA:
          </span>
        </div>
        <div class="col-xs-7 subrayar">
          <b>{{' '.$ingreso->fecha_ingreso->format('g:i a')}}</b>
        </div>
      </div>
      <div class="col-xs-4 row">
        <div class="col-xs-8">
          <span>
            HABITACIÓN:
          </span>
        </div>
        <div class="col-xs-3 subrayar">
          <b>{{' '.$ingreso->habitacion->numero}}</b>
        </div>
      </div>
    </div>
    <div class="col-xs-5">
      <div class="col-xs-5">
        <span>
          EXPEDIENTE NO.:
        </span>
      </div>
      <div class="col-xs-7 subrayar">
        <b>{{$ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}</b>
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-12">
      <div class="col-xs-4">
        <span>
          MÉDICO QUE AUTORIZA EL INGRESO:
        </span>
      </div>
      <div class="col-xs-8  subrayar">
        <b>
          @if ($ingreso->medico->sexo)
            {{" Dr. "}}
          @else
            {{" Dra. "}}
          @endif
          {{$ingreso->medico->nombre.' '.$ingreso->medico->apellido}}
        </b>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-2">
        <span>
          RECEPCIONISTA:
        </span>
      </div>
      <div class="col-xs-10 subrayar">
        <b>{{$ingreso->recepcion->nombre.' '.$ingreso->recepcion->apellido}}</b>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <br>
    <center>
      <h4>CONSENTIMIENTO DEL REPRESENTANTE LEGAL O RESPONSABLE DEL PACIENTE</h4>
    </center>
  </div>
  <div class="col-xs-12 text-justify">
    <p class="col-xs-12">
      Yo, <b class="subrayar">{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido.', '}}</b>&nbsp; mayor de edad con Documento Único de Identidad, número &nbsp;<b class="subrayar">{{$ingreso->responsable->dui}}</b>, &nbsp;actuando en calidad de responsable del paciente de generales antes expresadas, estoy conforme y enterado de los costos hospitalarios que implica el tratamiento y la enfermedad por lo cual esta {{($ingreso->paciente->sexo)?"ingresado":"ingresada"}} y acepto que diariamente se me informe el estado de cuenta al que me comprometo cancelar.
    </p>
    <br>
    <div class="col-xs-12">
      <table class="">
        <thead>
          <th style="width: 120px;">FECHA</th>
          <th style="width: 90px;">HORA</th>
          <th style="width: 100px;">ESTIMADO POR 24 HORAS</th>
          <th style="width: 150px;">ESTADO DE CUENTA</th>
          <th>NOMBRE</th>
          <th>FIRMA</th>
        </thead>
        <tbody>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>