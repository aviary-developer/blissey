@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'examenes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}<small>{{$solicitud->examen->nombreExamen}}</small></h2>
        <div class='col-md-8 col-sm-6 col-xs-6'>
          @foreach ($espr as $variable)
            @php
            $contadorParametros = 1;
            @endphp
          <table class="table">
            <div class="x_title">
              <div class="clearfix">
                <h2>{{$variable->seccion->nombre}}</h2></div>
            </div>
            <thead>
              <th>#</th>
              <th>Parametro</th>
              <th>Resultado</th>
              <th>Valores normales</th>
              <th>Unidades</th>
            </thead>
            <tbody>
              @if (count($espr)>0)
                @foreach ($espr as $esp)
                  @if ($esp->f_seccion==$variable->seccion->id)
                  <tr>
                    <td>{{$contadorParametros}}</td>
                    <td>{{$esp->nombreParametro($esp->f_parametro)}}</th>
                    <th><input type="text" value="{{$esp->parametro->valorPredeterminado}}"></input></td>
                    <th>{{number_format($esp->parametro->valorMinimo, 2, '.', '')." - ".number_format($esp->parametro->valorMaximo, 2, '.', '')}}</td><td>{{$esp->nombreUnidad($esp->parametro->unidad)}}</th>
                  </tr>
                @endif
                  @php
                    $contadorParametros++;
                  @endphp
                @endforeach
              @else
                <tr>
                  <td colspan="4">
                    <center>
                      No hay registros
                    </center>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        @endforeach
        </div>
        <div class="clearfix"></div>
      </div>
      </div>
    </div>
  {!!Form::close()!!}
@endsection
