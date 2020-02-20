<div class="row mt-2">
    <div class="col">
        <center>
            <h5 class="mt-1">Aperturas
    </div>
</div>
      <div class="ln_solid mt-3"></div>
      <div class="row">
        <div class="col-sm-12">
          <table class="table table-hover table-sm table-striped index-table">
            @php
            $aperturas=App\DetalleCaja::where([['f_caja',$caja->id],['tipo',1]])->orderBy('created_at','DESC')->get();
            $contador=1;
            @endphp
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Opción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($aperturas as $apertura)
                <tr>
                    <td>{{$contador}}</td>
                    <td>{{$apertura->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</td>
                <td>{{$apertura->user->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href={!! asset('/buscararqueo/'.$apertura->id.'/1')!!} class="btn btn-sm btn-info"  title="Ver">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                </td>
                </tr>
                @php
                $contador++;
                @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      