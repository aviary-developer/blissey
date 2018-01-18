@extends('dashboard') 
@section('layout') 
  @if(Auth::check())
      
    <div class="col-md-10 col-sm-10 col-xs-12">
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
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <div class="col-xs-2">
              <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
                <li role="presentation" class="active">
                  <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Hospital</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Laboratorio Clínico</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_content3" id="otros-tab3" role="tab" data-toggle="tab" aria-expanded="false">Clínica Médica</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_content4" id="otros-tab4" role="tab" data-toggle="tab" aria-expanded="false">Farmacia</a>
                </li>
              </ul>
            </div>
            <div class="col-xs-10">
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
                  <div classe="row">
                    <div class="col-xs-9">
                      <h3>Datos del Hospital </h3>
                    </div>
                    <div class="col-xs-2 alignright" style="margin-top: 10px;">     
                      @if(Auth::user()->administrador)
                      <a href={{asset('/grupo_promesa/'.$empresa->id.'-1/edit')}} class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                        Editar
                      </a>
                      @endif
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>

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
                        @if ($count_telefono_h <= 1)  
                          <th style="width: 150px">Télefono</th>
                        @else
                          <th style="width: 150px">Télefonos</th>
                        @endif
                        <td>
                          @if ($count_telefono_h == 0)
                            <i style="color: red">Sin teléfono</i>
                          @else
                            @foreach($telefonos as $telefono)
                              @if($telefono->tipo == 'hospital')
                                &#8226;
                                {{ $telefono->telefono}}
                                <br>
                              @endif
                            @endforeach
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th style="width: 150px">Dirección</th>
                        <td>{{ $empresa->direccion_hospital }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                  <div class="">
                    <div class="col-xs-9">
                      <h3>Datos del Laboratorio Clínico</h3>
                    </div>
                    <div class="col-xs-2 alignright" style="margin-top: 10px;">
                      @if(Auth::user()->administrador)      
                        <a href={{asset('/grupo_promesa/'.$empresa->id.'-2/edit')}} class="btn btn-primary btn-sm">
                          <i class="fa fa-edit"></i>
                          Editar
                        </a>
                      @endif
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
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
                        @if ($count_telefono_l <= 1)  
                          <th style="width: 150px">Télefono</th>
                        @else
                          <th style="width: 150px">Télefonos</th>
                        @endif
                        <td>
                          @if ($count_telefono_l == 0)
                            <i style="color: red">Sin teléfono</i>
                          @else
                            @foreach($telefonos as $telefono)
                              @if($telefono->tipo == 'laboratorio')
                                &#8226;
                                {{ $telefono->telefono}}
                                <br>
                              @endif
                            @endforeach
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th style="width: 150px">Dirección</th>
                        <td>{{ $empresa->direccion_laboratorio }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="tab_content3" aria-labelledby="otros-tab3">
                  <div>
                    <div class="col-xs-9">
                      <h3>Datos de la Clínica Médica </h3>
                    </div>
                    <div class="col-xs-2 alignright" style="margin-top: 10px">
                      @if(Auth::user()->administrador)
                        <a href={{asset('/grupo_promesa/'.$empresa->id.'-3/edit')}} class="btn btn-primary btn-sm">
                          <i class="fa fa-edit"></i>
                          Editar
                        </a>
                      @endif
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
                      
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
                        @if ($count_telefono_c <= 1)  
                          <th style="width: 150px">Télefono</th>
                        @else
                          <th style="width: 150px">Télefonos</th>
                        @endif
                        <td>
                          @if ($count_telefono_c == 0)
                            <i style="color: red">Sin teléfono</i>
                          @else
                            @foreach($telefonos as $telefono)
                              @if($telefono->tipo == 'clinica')
                                &#8226;
                                {{ $telefono->telefono}}
                                <br>
                              @endif
                            @endforeach
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th style="width: 150px">Dirección</th>
                        <td>{{ $empresa->direccion_clinica }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="tab_content4" aria-labelledby="otros-tab4">
                  <div>
                    <div class="col-xs-10">
                      <h3>Datos de la Farmacia </h3>
                    </div>
                    <div class="col-xs-2 alingright" style="margin-top: 10px;">
                      @if(Auth::user()->administrador)
                        <a href={{asset('/grupo_promesa/'.$empresa->id.'-4/edit')}} class="btn btn-primary btn-sm">
                          <i class="fa fa-edit"></i>
                          Editar
                        </a>
                      @endif
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
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
                        @if ($count_telefono_f <= 1)  
                          <th style="width: 150px">Télefono</th>
                        @else
                          <th style="width: 150px">Télefonos</th>
                        @endif
                        <td>
                          @if ($count_telefono_f == 0)
                            <i style="color: red">Sin teléfono</i>
                          @else
                            @foreach($telefonos as $telefono)
                              @if($telefono->tipo == 'farmacia')
                                &#8226;
                                {{ $telefono->telefono}}
                                <br>
                              @endif
                            @endforeach
                          @endif
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
        </div>
      </div>
    </div>
  @endif
@endsection