<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Examen
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$examen->nombreExamen}}
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Tipo de muestra
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{ $examen->nombreMuestra($examen->tipoMuestra) }}
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Área
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if ($examen->area == "HEMATOLOGIA")
      <span class="badge border border-pink text-pink col-6">Hematológia</span>
    @elseif($examen->area == "EXAMENES DE ORINA")
      <span class="badge border border-warning text-warning col-6">Uroanális</span>
    @elseif($examen->area == "EXAMENES DE HECES")
      <span class="badge border border-dark text-dark col-6">Coprología</span>
    @elseif($examen->area == "BACTERIOLOGIA")
      <span class="badge border border-success text-success col-6">Bactereología</span>
    @elseif($examen->area == "QUIMICA SANGUINEA")
      <span class="badge border border-danger text-danger col-6 borde">Química sanguínea</span>
    @elseif($examen->area == "INMUNOLOGIA")
      <span class="badge border border-primary text-primary col-6">Inmunología</span>
    @elseif($examen->area == "ENZIMAS")
      <span class="badge border border-purple text-purple col-6">Enzimas</span>
    @elseif($examen->area == "PRUEBAS ESPECIALES")
      <span class="badge border border-info text-info col-6">Pruebas especiales</span>
    @elseif($examen->area == "OTROS")
      <span class="badge border border-secondary text-secondary col-6">Otros</span>
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Precio
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{ '$ '.number_format($servicio->precio,2,'.',',') }}
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Estado
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if ($examen->estado)
      <span class="badge text-success border border-success col-6">Activo</span>
    @else
      <span class="badge text-danger border border-danger col-6">En papelera</span>
    @endif
  </h6>
</div>