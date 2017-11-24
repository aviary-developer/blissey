@extends('dashboard') 
@section('layout') 
  @if(Auth::check())
      
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>
            Grupo Promesa
            <small>
              Divino Niño
            </small>
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <h4>Datos del Hospital &nbsp;
              @if(Auth::user()->administrador)
                <small>
                  <a href={{asset('/grupo_promesa/'.$empresa->id.'-1/edit')}} class="link">
                    Editar
                    <i class="fa fa-edit"></i>
                  </a>
                </small>
              @endif
            </h4>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="image view view-first">
                <center>
                  <img src={{asset(Storage::url($empresa->logo_hospital))}} class="img-responsive miniperfil">
                  <div class="mask" style="height:100%">
                    <div class="tools tools-bottom" style="margin-top: 105px;">
                      <a href={{asset('/grupo_promesa/'.$empresa->id.'-5/edit')}}>
                        <i class="fa fa-edit"></i>
                      </a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table">
                <tr>
                  <th style="width: 150px">Código</th>
                  <td>{{ $empresa->codigo_hospital }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Nombre</th>
                  <td>{{ $empresa->nombre_hospital }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Télefono</th>
                  <td>
                    @foreach($telefonos as $telefono)
                        @if($telefono->tipo == 'hospital')
                            {{ $telefono->telefono}}
                            &#8226;
                        @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th style="width: 150px">Dirección</th>
                  <td>{{ $empresa->direccion_hospital }}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <h4>Datos del Laboratorio clínico &nbsp;
              @if(Auth::user()->administrador)      
                <small>
                  <a href={{asset('/grupo_promesa/'.$empresa->id.'-2/edit')}} class="link">
                    Editar
                    <i class="fa fa-edit"></i>
                  </a>
                </small>
              @endif
            </h4>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="image view view-first">
                <center>
                  <img src={{asset(Storage::url($empresa->logo_laboratorio))}} class="img-responsive miniperfil">
                  <div class="mask" style="height:100%">
                    <div class="tools tools-bottom" style="margin-top: 105px;">
                      <a href={{asset('/grupo_promesa/'.$empresa->id.'-5/edit')}}>
                        <i class="fa fa-edit"></i>
                      </a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table">
                <tr>
                  <th style="width: 150px">Código</th>
                  <td>{{ $empresa->codigo_laboratorio }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Nombre</th>
                  <td>{{ $empresa->nombre_laboratorio }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Télefono</th>
                  <td>
                     @foreach($telefonos as $telefono)
                        @if($telefono->tipo == 'laboratorio')
                            {{ $telefono->telefono}}
                            &#8226;
                        @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th style="width: 150px">Dirección</th>
                  <td>{{ $empresa->direccion_laboratorio }}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <h4>Datos de la clínica médica &nbsp;
              @if(Auth::user()->administrador)
                <small>
                  <a href={{asset('/grupo_promesa/'.$empresa->id.'-3/edit')}} class="link">
                    Editar
                    <i class="fa fa-edit"></i>
                  </a>
                </small>
              @endif
            </h4>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="image view view-first">
                <center>
                  <img src={{asset(Storage::url($empresa->logo_clinica))}} class="img-responsive miniperfil">
                  <div class="mask" style="height:100%">
                    <div class="tools tools-bottom" style="margin-top: 105px;">
                      <a href={{asset('/grupo_promesa/'.$empresa->id.'-5/edit')}}>
                        <i class="fa fa-edit"></i>
                      </a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table">
                <tr>
                  <th style="width: 150px">Código</th>
                  <td>{{ $empresa->codigo_clinica }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Nombre</th>
                  <td>{{ $empresa->nombre_clinica }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Télefono</th>
                  <td>
                     @foreach($telefonos as $telefono)
                        @if($telefono->tipo == 'clinica')
                            {{ $telefono->telefono}}
                            &#8226;
                        @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th style="width: 150px">Dirección</th>
                  <td>{{ $empresa->direccion_clinica }}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <h4>Datos de la farmacia &nbsp;
              @if(Auth::user()->administrador)
                <small>
                  <a href={{asset('/grupo_promesa/'.$empresa->id.'-4/edit')}} class="link">
                    Editar
                    <i class="fa fa-edit"></i>
                  </a>
                </small>
              @endif
            </h4>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="image view view-first">
                <center>
                  <img src={{asset(Storage::url($empresa->logo_farmacia))}} class="img-responsive miniperfil">
                  <div class="mask" style="height:100%">
                    <div class="tools tools-bottom" style="margin-top: 105px;">
                      <a href={{asset('/grupo_promesa/'.$empresa->id.'-5/edit')}}>
                        <i class="fa fa-edit"></i>
                      </a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table">
                <tr>
                  <th style="width: 150px">Código</th>
                  <td>{{ $empresa->codigo_farmacia }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Nombre</th>
                  <td>{{ $empresa->nombre_farmacia }}</td>
                </tr>
                <tr>
                  <th style="width: 150px">Télefono</th>
                  <td>
                     @foreach($telefonos as $telefono)
                        @if($telefono->tipo == 'farmacia')
                            {{ $telefono->telefono}}
                            &#8226;
                        @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th style="width: 150px">Dirección</th>
                  <td>{{ $empresa->direccion_farmacia }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection