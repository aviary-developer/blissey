@extends('dashboard')
@section('layout')
  @if(Session::has('mensaje'))
    <?php $mensaje = Session::get('mensaje');
    echo "<script>swal('$mensaje', 'Acción realizada satisfactorimente', 'success')</script>";?>
  @endif
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
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Estantes
          @if ($estadoOpuesto)
            <small>Papelera</small>
          @else
            <small>Activos</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/estantes/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/estantes?codigo='.$codigo.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activos
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12">
            {!!Form::open(['route'=>'estantes.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('codigo',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
              @if ($estadoOpuesto)
                <input type="hidden" name="estado" value="0">
              @endif
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>N° de niveles</th>
              <th>Localización</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($estantes)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($estantes as $estante)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/estantes/'.$estante->id)}}>
                      {{ $estante->codigo}}
                    </a>
                  </td>
                  <td>{{ $estante->cantidad.' niveles'}}</td>
                  <td>
                    @if($estante->localizacion)
                      <span class="label label-primary label-lg col-xs-8">Recepción</span>
                    @else
                      <span class="label label-success label-lg col-xs-8">Farmacia</span>
                    @endif
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Estantes.Formularios.activate')
                    @else
                      @include('Estantes.Formularios.desactivate')
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
            @else
              <tr>
                <td colspan="5">
                  <center>
                    No hay registros que coincidan con los términos de búsqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
          {!! str_replace ('/?', '?', $estantes->appends(Request::only(['codigo','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
