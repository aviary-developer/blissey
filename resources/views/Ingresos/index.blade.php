@extends('principal')
@section('layout')
  @if ($estado != 2 || $estado == null)
    @php
      $estadoOpuesto = 2;
    @endphp
  @else
    @php
      $estadoOpuesto = 0;
    @endphp
  @endif

  @php
    $index = true;
  @endphp

  @include('Ingresos.Barra.index')

  <div class="col-sm-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <table class="table table-striped">
            <thead>
              <th>#</th>
              @if ($tipo != 3)  
                <th>Expediente</th>
              @endif
              <th>Paciente</th>
              <th>Médico</th>
              @if ($tipo != 3)  
                <th>Habitación</th>
              @endif
              <th>Opciones</th>
            </thead>
            <tbody>
              @if ($ingresos!=null)
                @php
                  $correlativo = 1;
                @endphp
                @foreach ($ingresos as $ingreso)
                  <tr>
                    <td>{{$correlativo + $pagina}}</td>
                    @if ($tipo != 3) 
                      <td>
                        <a href={{asset('/ingresos/'.$ingreso->id)}}>
                          {{$ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}
                        </a>
                      </td>
                    @endif
                    <td>
                      <a href={{asset('/pacientes/'.$ingreso->f_paciente)}}>
                        {{$ingreso->paciente->apellido.', '.$ingreso->paciente->nombre}}
                      </a>
                    </td>
                    <td>
                      @if (Auth::user()->administrador)
                        <a href={{asset('/usuarios/'.$ingreso->f_medico)}}>
                          @if ($ingreso->medico->sexo)
                            {{'Dr. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                          @else
                            {{'Dra. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                          @endif
                        </a>
                      @else
                        @if ($ingreso->medico->sexo)
                          {{'Dr. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                        @else
                          {{'Dra. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                        @endif
                      @endif
                      
                    </td>
                    @if ($ingreso->f_habitacion != null)  
                      <td>
                        @if (Auth::user()->tipoUsuario == "Recepción")
                          <a href={{asset('/habitaciones/'.$ingreso->f_habitacion)}}>
                          {{'Habitación '.$ingreso->habitacion->numero}}
                          </a>
                        @else
                          {{'Habitación '.$ingreso->habitacion->numero}}
                        @endif
                      </td>
                    @endif
                    <td>
                      @include('Ingresos.Formularios.desactivate')
                    </td>
                  </tr>
                  @php
                    $correlativo++;
                  @endphp
                @endforeach
              @else
                <tr>
                  <td colspan="6">
                    <center>
                      No hay registros que coincidan con los términos de búsqueda indicados
                    </center>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
          <div class="ln_solid"></div>
          {!!str_replace('/?', '?', $ingresos->appends(Request::only(['estado','tipo']))->render())!!}
        </div>
      </div>
    </div>
  </div>
@endsection
