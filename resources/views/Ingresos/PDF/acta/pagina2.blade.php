<div class="page">
  <br>
  <div>
    <center>
      <h3>PAGARÉ SIN PROTESTO</h3>
    </center>
  </div>
  <div class="col-xs-12">
    @php
      setlocale(LC_ALL, 'es');
      $hoy = Carbon\Carbon::now()
    @endphp
    <br>
    <p class="col-xs-12">
      San Vicente, {{$hoy->formatLocalized('%d de %B del %Y')}}
    </p>
    <p class="col-xs-12">
      Por US $ <span class="">_____________</span>
    </p>
  </div>
  <div class="col-xs-12 text-justify">
    <p class="col-xs-12">
      Por este <b><i>Pagaré sin protesto</i></b> , me obligo a pagar incondicionalmente a <b><i>Mauricio Enrique Durán Rodríguez</i></b>, propietario de la empresa salvadoreña y de este domicilio, la suma de <b class=""> $ __________</b>, a más tardar <b class="">____________________</b>, en <b><i>Clínica Hospital Divino Niño</i></b>. si el monto de este <b><i>Pagaré</i></b> no fuera cancelados al vencimiento de este reconoceré en caso de mora el interés del 5% diario sobre la suma adeudada a partir del momento en se inicie la mora y por el tiempo que transcurra hasta el pago total de este <b><i>Pagaré</i></b>. cualquier deducción, compensación o retención que debiere aplicarse al monto del presente pagaré, impuesto por cualquier autoridad con jurisdicción, será a mi cuenta y cargo, de tal forma que <b><i>Mauricio Enrique Durán Rodríguez</i></b>, recibirá íntegramente el monto e interés pactados en este <b><i>Pagaré</b></i>.
    </p>
    <br>
    <p class="col-xs-12">
      El suscriptor de este <b><i>Pagaré</i></b> acuerda según requerimiento a <b><i>Mauricio Enrique Durán Rodríguez</i></b>, todos los gastos y costos en que <b><i>Mauricio Enrique Durán Rodríguez</i></b>, incurra en conexión con la preparación, ejecución, entrega y asesoría legal respecto al <b><i>Pagaré</i></b>, incluyendo, pero limitándose a: a)	Honorarios de abogado(s); b)	Los gastos relacionados con la ejecución del <b><i>Pagaré</i></b>.
    </p>
    <br>
    <p class="col-xs-12">
      La presente obligación mercantil se regirá por la ley salvadoreña aplicable. Para todos los efectos legales de esta obligación, me someto a la competencia de los tribunales de San Vicente, Republica de El Salvador; renuncio al derecho de apelar del decreto de embargo, sentencia de remanente y cualquier providencia apelable que se dictare en el juicio ejecutivo correspondiente y sus incidentes, siendo de mi cuenta y cargo todos los castos que el beneficiario de este titulo valor hiciere para el cobro del mismo, inclusive las llamadas personales, aunque por regla general no hubiera condenación en costas; y faculto al beneficiario de este <b><i>Pagaré</i></b>, para que asigne la persona depositaria de los bienes que se embarguen, quien queda relevada de rendir fianza.
    </p>
    <p class="col-xs-12">
      <br><br>
      <span class="col-xs-3 text-monospace">Nombre del cliente:</span>
      <b class="col-xs-9 subrayar">
        {{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}
      </b>
    </p>
    <br>
    <p class="col-xs-12">
      <span class="col-xs-3 text-monospace">DUI del cliente:</span>
      <b class="col-xs-9 subrayar">
        @if ($ingreso->hospitalizacion->responsable->dui != null)
          {{$ingreso->hospitalizacion->responsable->dui}}
        @else
          <i class="red">Falta DUI</i>
        @endif
      </b>
    </p>
    <br>
    <p class="col-xs-12">
      <span class="col-xs-3 text-monospace">Direccion del cliente:</span>
      <b class="col-xs-9 subrayar">
        @if ($ingreso->hospitalizacion->responsable->direccion != null)
          {{$ingreso->hospitalizacion->responsable->direccion}}  
        @else
          <i class="red">Falta la dirección</i>
        @endif
      </b>
    </p>
    <br>
    <p class="col-xs-12">
      <span class="col-xs-3 text-monospace">Firma del cliente:</span>
      <b class="col-xs-9 subrayar">F.</b>
    </p>
  </div>
</div>