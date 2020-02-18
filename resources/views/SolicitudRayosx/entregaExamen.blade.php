<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>
    <!-- Bootstrap -->
    {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
    <!-- Font Awesome -->
    {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}


    {!!Html::style('assets/build/css/custom.css')!!}
    {!!Html::style('css/pdfexamenes.css')!!}

    <style type="text/css">
      div.page
      {
          page-break-after: always;
          page-break-inside: avoid;
      }
    </style>
  </head>

  <body class="bg-white">
	@php
  $fecha = Carbon\Carbon::now();
@endphp
<div class="col-xs-12">
	<div>
		<center>
			<h3>
				{{$solicitud->rayox->nombre}}
			</h3>
		</center>
		<div>
			<span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span>
			<span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span>
		</div>
		<div>
			<span style="float: right">
				Fecha de evaluación: <b><u>{{$resultado->created_at->format('d/m/Y')}}</u></b>
			</span>
		</div>
		<div class="clearfix"></div>
		<center>
			<div class="row">
				<center>
					<br>
					@php
						echo $resultado->observacion;
					@endphp
				</center>
				<div class="col-xs-12" style="margin-top: 20px">
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
		</center>
	</div>
</div>
</body>
</html>
