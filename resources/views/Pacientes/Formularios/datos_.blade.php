
<tr>
  <th>Nombre</th>
  <td>{{ $responsable->nombre }}</td>
</tr>
<tr>
  <th>Apellido</th>
  <td>{{ $responsable->apellido }}</td>
</tr>
<tr>
  <th>Fecha de nacimiento</th>
  <td>{{ $responsable->fechaNacimiento->formatLocalized('%d de %B de %Y').' ('.$responsable->fechaNacimiento->age.' años)' }}</td>
</tr>
<tr>
  <th>Sexo</th>
  <td>
    @if ($responsable->sexo)
      <span class="label-lg label label-cian col-xs-4">Masculino</span>
    @else
      <span class="label-lg label label-pink col-xs-4">Femenino</span>
    @endif
  </td>
</tr>
@if ($responsable->fechaNacimiento->age >= 18)
  <tr>
    <th>DUI</th>
    <td>
      @if (strlen($responsable->dui) != 10)
        <i style="color:red">Sin DUI</i>
      @else
        {{ $responsable->dui }}
      @endif
    </td>
  </tr>
@endif
<tr>
  <th>Teléfono</th>
  <td>
    @if (strlen($responsable->telefono) != 9)
      <i style="color:red">Sin teléfono</i>
    @else
      {{ $responsable->telefono }}
    @endif
  </td>
</tr>
<tr>
  <th>Residencia</th>
  @if ($responsable->pais == null)
    <td>{{$responsable->municipio.', '.$responsable->departamento}}</td>
  @else
    <td>{{$responsable->pais}}</td>
  @endif
</tr>
<tr>
  <th>Dirección</th>
  <td>
    @if ($responsable->direccion == null)
      <i style="color:red">Sin dirección</i>
    @else
      {{ $responsable->direccion }}
    @endif
  </td>
</tr>