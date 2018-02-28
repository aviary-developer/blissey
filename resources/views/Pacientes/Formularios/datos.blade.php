
<tr>
  <th>Nombre</th>
  <td>{{ $paciente->nombre }}</td>
</tr>
<tr>
  <th>Apellido</th>
  <td>{{ $paciente->apellido }}</td>
</tr>
<tr>
  <th>Fecha de nacimiento</th>
  <td>{{ $paciente->fechaNacimiento->formatLocalized('%d de %B de %Y').' ('.$paciente->fechaNacimiento->age.' años)' }}</td>
</tr>
<tr>
  <th>Sexo</th>
  <td>
    @if ($paciente->sexo)
      <span class="label-lg label label-cian col-xs-4">Masculino</span>
    @else
      <span class="label-lg label label-pink col-xs-4">Femenino</span>
    @endif
  </td>
</tr>
@if ($paciente->fechaNacimiento->age >= 18)
  <tr>
    <th>DUI</th>
    <td>
      @if (strlen($paciente->dui) != 10)
        <i style="color:red">Sin DUI</i>
      @else
        {{ $paciente->dui }}
      @endif
    </td>
  </tr>
@endif
<tr>
  <th>Teléfono</th>
  <td>
    @if (strlen($paciente->telefono) != 9)
      <i style="color:red">Sin teléfono</i>
    @else
      {{ $paciente->telefono }}
    @endif
  </td>
</tr>
<tr>
  <th>Residencia</th>
  @if ($paciente->pais == null)
    <td>{{$paciente->municipio.', '.$paciente->departamento}}</td>
  @else
    <td>{{$paciente->pais}}</td>
  @endif
</tr>
<tr>
  <th>Dirección</th>
  <td>
    @if ($paciente->direccion == null)
      <i style="color:red">Sin dirección</i>
    @else
      {{ $paciente->direccion }}
    @endif
  </td>
</tr>