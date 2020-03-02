@extends('principal')
@section('layout')
  @php
  $index = true;
  $fecha=Carbon\Carbon::now();
  @endphp
  @include('Respaldos.barra')
  <div class="col-sm-11">
    <div class="x_panel">
      <div class="loaderCargando" id="loaderCargando" style="display:none;"></div>
      {!! Form::open(['id'=>'formCrearRespaldo', 'url'=>'/crearRespaldo', 'method' => 'GET']) !!}
      {!! Form::close() !!}
      
      <?php function formatoPeso($size, $precision = 2)
      {
          if ($size > 0) {
              $size = (int) $size;
              $base = log($size) / log(1024);
              $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

              return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
          } else {
              return $size;
          }
      } ?>
    <table class="table table-hover table-striped table-sm index-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre de archivo</th>
          <th>Tamaño</th>
          <th>Fecha</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
        @if ($respaldos!=null)
          @php
          $correlativo = 1;
          @endphp
          @foreach ($respaldos as $res)
            <tr>
              <td>{{ $correlativo}}</td>
              <td>
                {{$res['nombre']}}
              </td>
              <td>
                {{formatoPeso($res['tamanio'])}}
              </td>
              <td>
                {{(Carbon\Carbon::createFromTimestamp($res['fecha']))->format('d-m-Y')}}
              </td>
              <td class="text-left">
                <center>
                  <div class="btn-group">
                    <a class="btn btn-sm btn-light" href="{{ url('/descargarRespaldo/'.$res['nombre']) }}">
                      <i class="fas fa-cloud-download-alt"></i> 
                      Descargar
                    </a>
                    <a class="btn btn-sm btn-primary" href="{{ url('/restaurarRespaldo/'.$res['nombre']) }}" onclick="cargarRestaurar()">
                      <i class="fas fa-cloud-upload-alt"></i> 
                      Restaurar
                    </a>
                    <a class="btn btn-sm btn-danger" data-button-type="delete" href="{{ url('/eliminarRespaldo/'.$res['nombre']) }}">
                      <i class="fas fa-trash"></i>  
                      Eliminar
                    </a>
                  </div>
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
@endsection
<style>
  .loaderCargando {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('img/cargando.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
  </style>
<script>
  function confirmarRespaldo(){
    swal({
      title: 'Crear nuevo respaldo',
      text: 'Se creará un nuevo respaldo de la base de datos',
      footer: "¡El proceso tarda en realizarse!",
      type: 'question',
      showCancelButton: true,
      confirmButtonText: 'Si, realizar respaldo!',
      cancelButtonText: 'No, cancelar',
      confirmButtonClass: 'btn btn-danger',
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then((result) => {
      if(result.value){
        $("#loaderCargando").show("fast");
        $("#formCrearRespaldo").submit();
      }
    });
  }
  function cargarRestaurar(){
    $("#loaderCargando").show("fast");
  }
</script>

@include('Respaldos.modal')
