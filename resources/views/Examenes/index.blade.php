@extends('principal')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  @include('Examenes.Barra.index')
  <div class="col-sm-10">
    <div class="x_panel">
      <table class="table index-table table-hover table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Área</th>
            <th>Tipo de muestra</th>
            <th style="">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @if ($examenes!=null)
            @php
            $correlativo = 1;
            @endphp
            @foreach ($examenes as $examen)
              <tr>
                <td>{{ $correlativo + $pagina }}</td>
                <td>
                  <a href={{asset('/examenes/'.$examen->id)}}>
                    {{ $examen->nombreExamen }}
                  </a>
                </td>
                <td>
                  @if ($examen->area == "HEMATOLOGIA")
                    <span class="badge font-sm border border-pink text-pink col-10">Hematológia</span>
                  @elseif($examen->area == "EXAMENES DE ORINA")
                    <span class="badge font-sm border border-warning text-warning col-10">Uroanálisis</span>
                  @elseif($examen->area == "EXAMENES DE HECES")
                    <span class="badge font-sm border border-dark text-dark col-10">Coprología</span>
                  @elseif($examen->area == "BACTERIOLOGIA")
                    <span class="badge font-sm border border-success text-success col-10">Bactereología</span>
                  @elseif($examen->area == "QUIMICA SANGUINEA")
                    <span class="badge font-sm border border-danger text-danger col-10 borde">Química sanguínea</span>
                  @elseif($examen->area == "INMUNOLOGIA")
                    <span class="badge font-sm border border-primary text-primary col-10">Inmunología</span>
                  @elseif($examen->area == "ENZIMAS")
                    <span class="badge font-sm border border-purple text-purple col-10">Enzimas</span>
                  @elseif($examen->area == "PRUEBAS ESPECIALES")
                    <span class="badge font-sm border border-info text-info col-10">Pruebas especiales</span>
                  @elseif($examen->area == "OTROS")
                    <span class="badge font-sm border border-secondary text-secondary col-10">Otros</span>
                  @endif
                </td>
                <td>
                  {{ $examen->nombreMuestra($examen->tipoMuestra) }}
                </td>
                <td>
                  <center>
                    @if ($estadoOpuesto)
                      @include('Examenes.Formularios.activate')
                    @else
                      @include('Examenes.Formularios.desactivate')
                    @endif
                  </center>
                </td>
              </tr>
              @php
              $correlativo++;
              @endphp
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <!-- /page content -->
@endsection
