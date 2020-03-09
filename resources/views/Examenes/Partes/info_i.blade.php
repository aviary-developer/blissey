@if(isset($secciones))
@if($secciones!=null)
  @for ($i=0; $i < count($secciones); $i++)
    <div class="x_panel">
      @php
      $contadorParametros = 1;
      @endphp

      <div class="flex-row">
        <center>
          <h5>
            <i class="fa fa-flask"></i>
            {{$examen->nombreSeccion($secciones[$i])}}
          </h5>
        </center>
      </div>

      <table class="table table-striped table-sm">
        <thead>
          <th>#</th>
          <th>Parametro</th>
          <th>Reactivo</th>
        </thead>
        <tbody>
          @if ($e_s_p!=null)
            @foreach ($e_s_p as $esp)
              @if ($esp->f_seccion==$secciones[$i])
                <tr>
                  <td>{{$contadorParametros}}</td>
                  <td>
                    <a href={{asset('/parametros/'.$esp->f_parametro)}}>
                      {{$esp->nombreParametro($esp->f_parametro)}}
                    </a>
                  </td>
                  @if($esp->reactivo)
                    <td>
                      <a href={{asset('/reactivos/'.$esp->reactivo->id)}}>
                        {{$esp->reactivo->nombre}}
                      </a>
                    </td>
                  @else
                    <td>-</td>
                  @endif
                </tr>
                @php
                  $contadorParametros++;
                @endphp
              @endif
            @endforeach
          @else
            <tr>
              <td colspan="3">
                <center>
                  No hay registros
                </center>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  @endfor
@endif
@endif