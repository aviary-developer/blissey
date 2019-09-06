<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Blissey</title>
  <!-- jQuery -->
  <!-- Bootstrap -->
  {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
  <!-- Font Awesome -->
  {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}
  <!-- NProgress -->
  {!!Html::style('assets/nprogress/nprogress.css')!!}
  <!-- iCheck -->
  {!!Html::style('assets/iCheck/skins/flat/green.css')!!}
  <!-- iCheck -->
  {!!Html::style('css/animate.css')!!}

  <!-- bootstrap-progressbar -->
  {!!Html::style('assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')!!}
  <!-- JQVMap -->
  {!!Html::style('assets/jqvmap/dist/jqvmap.min.css')!!}
  <!-- bootstrap-daterangepicker -->
  {!!Html::style('assets/bootstrap-daterangepicker/daterangepicker.css')!!} {!!Html::style('assets/datatables.net-bs/css/dataTables.bootstrap.min.css')!!}
  {!!Html::script('assets/sweetalert2/dist/sweetalert2.js')!!} {!!Html::style('assets/sweetalert2/dist/sweetalert2.css')!!}

  <!-- Css de nitify-->
  {!!Html::style('assets/pnotify/dist/pnotify.css')!!} {!!Html::style('assets/pnotify/dist/pnotify.buttons.css')!!} {!!Html::style('assets/normalize-css/normalize.css')!!}
  {!!Html::style('assets/ion.rangeSlider/css/ion.rangeSlider.css')!!} {!!Html::style('assets/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')!!}

  <!-- Custom Theme Style -->
  {!!Html::style('assets/switchery/dist/switchery.min.css')!!}

  {!!Html::style('assets/build/css/custom.css')!!}

  <style type="text/css">
    div.page
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>
</head>

<body class="bg-white">
  <div class="page">

    @php
      $imagen = App\Empresa::first();
      $telefonos = App\TelefonoEmpresa::where('tipo','laboratorio')->get();
    @endphp
    <div class="row">
      <div class="col-xs-3">
        <img src={{asset(Storage::url($imagen->logo_laboratorio))}} width="140" height="165">
      </div>
      <div class="col-xs-6">
        <center>
          <h2>{{$imagen->nombre_laboratorio}}</h2>
          <h3>
            <i>
              <small>
                {{$imagen->direccion_laboratorio}}
                <br>
                @foreach ($telefonos as $telefono)
                  {{$telefono->telefono.' '}}
                @endforeach
              </small>
            </i>
          </h3>
        </center>
      </div>
      <div class="col-xs-3">
        <img src={{asset(Storage::url($imagen->logo_hospital))}} width="160" height="160">
      </div>
    </div>
    <div style="border: 1px solid black">
	@php
	$fecha = Carbon\Carbon::now();
@endphp
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="">
		<center>
			<h3>{{$solicitud->examen->nombreExamen}}</h3>
		</center>
		<div>
			<span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span>
			<span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span>
		</div>
		<div>
			<span style="float: right">
				Fecha de evaluación: <b><u>{{$resultado->created_at->format('d/m/Y')}}</u></b>
			</span>
			<span> Muestra: <strong><u>{{$solicitud->examen->nombreMuestra($solicitud->examen->tipoMuestra)}}</u></strong></span>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			@php
				$cantidadSecciones=count($secciones);
			@endphp
			@if ($cantidadSecciones==1)
				<div class="col-xs-3"></div>
			@endif
			@foreach ($secciones as $k=>$variable)
				@if($k%2==0)
					<div class="row">
				@endif

				<div class="col-xs-6">
					<center>
						<table class="table-simple">
							<div class="x_title">
								<span><big>{{$espr->first()->nombreSeccion($variable)}}</big></span>
								<div class="clearfix"></div>
							</div>
							<thead>
								<th>Parametro</th>
								<th>Resultado</th>
								<th>Valores normales</th>
								<th>Unidades</th>
							</thead>
							<tbody>
								@if ($espr!=null)
									@foreach ($espr as $esp =>$valor)
										@if ($valor->f_seccion==$variable)
											<tr>
													<td><center>{{$valor->nombreParametro($valor->f_parametro)}}</center></th>
													<td><center>{{$detallesResultado[$esp]->resultado}}</center></td>
													@if ($valor->parametro->valorMinimo!=null)
														@if ($solicitud->paciente->sexo==0)
															<td><center>{{number_format($valor->parametro->valorMinimoFemenino, 2, '.', '')." - ".number_format($valor->parametro->valorMaximoFemenino, 2, '.', '')}}</center></td>
														@else
															<td><center>{{number_format($valor->parametro->valorMinimo, 2, '.', '')." - ".number_format($valor->parametro->valorMaximo, 2, '.', '')}}</center></td>
														@endif
														<td><center>{{$valor->nombreUnidad($valor->parametro->unidad)}}</center></td>
													@else
														<th>-</th><th>-</th>
													@endif
													@if ($detallesResultado[$esp]->dato_controlado!=null)
														<td><center>D.C.={{$detallesResultado[$esp]->dato_controlado}}</center></td>
													@endif
												</tr>
											@endif
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
					</center>
				</div>
				@if($k%2!=0)
					</div>
				@endif
			@endforeach
			@if($resultado->observacion!=null)
				<br>
				<div class="col-xs-12">
					<ul class="list-unstyled timeline widget">
						<li>
							<div class="block">
								<div class="block_content">
									<h2 class="title"><a>OBSERVACIONES:</a></h2>
									<p class="excerpt">{{$resultado->observacion}}</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			@endif
				<div class="col-md-12 col-sm-12 col-12" style="margin-top: 20px">
					<center>
						<div>
							<span> Realizó: <strong><i>{{$resultado->laboratorista->nombre}} {{$resultado->laboratorista->apellido}}</i></strong></span> &nbsp
							<span>
								<img src={{asset(Storage::url($resultado->laboratorista->sello))}} style="width:180px;">
								<img src={{asset(Storage::url($resultado->laboratorista->firma))}} style="width:180px;">
							</span>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
  <div class="row">
    Realizado por:{{Auth::user()->nombre}}   {{Auth::user()->apellido}}</div>
    <div class="col-xs-3">
    FIRMA:  <img src={!! asset(Storage::url((Auth::check())?Auth::user()->firma:"NoImgen.jpg")) !!} alt="..." width="160" height="140">
  </div><div class="col-xs-3">SELLO:  <img src={!! asset(Storage::url((Auth::check())?Auth::user()->sello:"NoImgen.jpg")) !!} alt="..." width="160" height="140">
      </div>
  </div>
  <div class="page">
    HHola
  </div>
  </body>
</html>
