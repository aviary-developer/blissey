@extends('principal')
@section('layout')
  @php
    $apertura=App\DetalleCaja::cajaApertura();
  @endphp
    @include('DetalleCajas.Barra.detalle')
  <div class="col-8">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Localización</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($cajas as $caja)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/cajas/'.$caja->id)}}>
                      Caja {{ $caja->nombre}}
                    </a>
                  </td>
                  <td>
                    @if($caja->localizacion)
                    <span class="badge border border-danger  col-12 text-danger">Recepción</span>
                  @else
                    <span class="badge border border-dark  col-12">Farmacia</span>
                  @endif
                  </td>
                  <td>
                    <center>
                    @if (App\DetalleCaja::verificacionCaja($caja->id))
                      @if (App\DetalleCaja::usuario($caja->id)->f_usuario==Auth::user()->id)
                        <a href={!! asset('/cerrar/'.$caja->id)!!} class="btn btn-warning btn-sm" title="Efectuar cierre">
                          <i class="fas fa-check-circle" style="color:white"></i>
                        </a>
                      @else
                        <button type="button" class="btn btn-sm btn-danger disabled" title="En uso por otro usuario">
                          <i class="fas fa-exclamation-triangle"></i>
                        </button>
                      @endif
                    @else
                      @if ($apertura)
                        <button type="button" class="btn btn-sm btn-danger disabled" title="No disponible">
                          <i class="fas fa-exclamation-triangle"></i>
                        </button>
                      @else
                        {{-- {!!Form::open(['method'=>'POST','id'=>'formulario'])!!} --}}
                        <a href={!! asset('/aperturar/'.$caja->id)!!} class="btn btn-success btn-sm" title="Aperturar">
                          <i class="fas fa-check"></i>
                        </a>
                        {{-- {!!Form::close()!!} --}}
                      @endif
                    @endif
                    </center>
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
  <!-- /page content -->
@endsection
