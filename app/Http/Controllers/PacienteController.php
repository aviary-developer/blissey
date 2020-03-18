<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Paciente;
use App\Bitacora;
use App\Ingreso;
use App\DetalleResultado;
use App\Resultado;
use App\ExamenSeccionParametro;
use App\SolicitudExamen;
use Redirect;
use Carbon\Carbon;
use App\Http\Requests\PacienteRequest;
use DB;
use Response;
use Storage;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estado = $request->get('estado');
        if($estado == NULL){
          $estado = 1;
        }
        $nombre = $request->get('nombre');
        $apellido = $request->get('apellido');
        $sexo = $request->get('sexo');
        //Telefono
        $telefono_incompleto = $request->get('telefono');
        $telefono_incompleto = explode('_',$telefono_incompleto);
        $telefono = $telefono_incompleto[0];
        //dui
        $dui_incompleto = $request->get('dui');
        $dui_incompleto = explode('_',$dui_incompleto);
        $dui = $dui_incompleto[0];
        //Direccion
        $direccion = $request->get('direccion');
        //Edad
        $edad = $request->get('edad');
        $inicio = Paciente::where('estado',$estado)->orderBy('fechaNacimiento','asc')->first();
        $fin = Paciente::where('estado',$estado)->orderBy('fechaNacimiento','desc')->first();
        if($edad!=null){
          $edadx = explode(';',$edad);
          $minimo = $edadx[1];
          $maximo = $edadx[0];
          $fecha_minima = Carbon::now();
          $fecha_minima = $fecha_minima->subYears($minimo+1);
          $fecha_minima = $fecha_minima->subDay();
          $fecha_maxima = Carbon::now();
          $fecha_maxima = $fecha_maxima->subYears($maximo);
        }else{
          if($inicio == NULL){
            $fecha_maxima = $fecha_minima = Carbon::tomorrow();
          }else{
            $fecha_minima = $inicio->fechaNacimiento;
            $fecha_maxima = $fin->fechaNacimiento;
          }
        }
        if($inicio == NULL){
          $inicio = $fin = 0;
        }else{
          $inicio = $inicio->fechaNacimiento->age;
          $fin = $fin->fechaNacimiento->age;
        }
        $pacientes = Paciente::buscar($nombre,$apellido,$sexo,$telefono,$dui,$direccion,$fecha_minima,$fecha_maxima,$estado);
        $contador = Paciente::contar($nombre,$apellido,$sexo,$telefono,$dui,$direccion,$fecha_minima,$fecha_maxima,$estado);
        $activos = Paciente::where('estado',true)->count();
        $inactivos = Paciente::where('estado',false)->count();
        $desde = $fecha_maxima->age;
        $hasta = $fecha_minima->age;
        if($hasta != $inicio){
          $hasta--;
        }
        $ruta = "?nombre=".$nombre."&apellido=".$apellido."&sexo=".$sexo."&telefono=".$telefono."&dui=".$dui."&direccion=".$direccion."&edad=".$edad."&estado=".$estado;
        return view('Pacientes.index',compact(
          'pacientes',
          'estado',
          'nombre',
          'activos',
          'inactivos',
          'inicio',
          'fin',
          'desde',
          'hasta',
          'contador',
          'ruta'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {
      DB::beginTransaction();
      try {
        $pacientes = Paciente::create($request->All());
        if($pacientes->pais != null){
          $pacientes->departamento = null;
          $pacientes->municipio = null;
        }
        $pacientes->save();
      } catch (Exception $e) {
        DB::rollback();
        return redirect('/pacientes')->with('mensaje', 'Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','pacientes','pacientes',$pacientes->id);
      return redirect('/pacientes')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
				$hospitalizaciones = $paciente->hospitalizaciones;
        $solicitudes = $paciente->solicitudes;
        return view('Pacientes.show',compact(
          'paciente',
          'hospitalizaciones',
          'solicitudes'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacientes = Paciente::find($id);
        return view('Pacientes.edit',compact('pacientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request, $id)
    {
        $pacientes = Paciente::find($id);
        $pacientes->fill($request->all());
        if($pacientes->pais != null){
          $pacientes->departamento = null;
          $pacientes->municipio = null;
        }
        $pacientes->save();
        Bitacora::bitacora('update','pacientes','pacientes',$id);
        if($pacientes->estado)
        {
          return redirect('/pacientes')->with('mensaje', '¡Editado!');
        }
        else{
          return redirect('/pacientes?estado=0')->with('mensaje', '¡Editado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try{
        $pacientes = Paciente::findOrFail($id);
        $pacientes->delete();
        Bitacora::bitacora('destroy','pacientes','pacientes',$id);
        return redirect('/pacientes?estado=0')->with('mensaje', 'Eliminado');;
      } catch (\Exception $e) {
        return redirect('/pacientes?estado=0')->with('error', 'Algo salio mal');
      }
    }

    public function desactivate($id){
      $pacientes = Paciente::find($id);
      $pacientes->estado = false;
      $pacientes->save();
      Bitacora::bitacora('desactivate','pacientes','pacientes',$id);
      return Redirect::to('/pacientes');
    }

    public function activate($id){
      $pacientes = Paciente::find($id);
      $pacientes->estado = true;
      $pacientes->save();
      Bitacora::bitacora('activate','pacientes','pacientes',$id);
      return Redirect::to('/pacientes?estado=0');
    }

    public function paciente_pdf(Request $request){
      $estado = $request->get('estado');
      if($estado == NULL){
        $estado = 1;
      }
      $nombre = $request->get('nombre');
      $apellido = $request->get('apellido');
      $sexo = $request->get('sexo');
      //Telefono
      $telefono_incompleto = $request->get('telefono');
      $telefono_incompleto = explode('_',$telefono_incompleto);
      $telefono = $telefono_incompleto[0];
      //dui
      $dui_incompleto = $request->get('dui');
      $dui_incompleto = explode('_',$dui_incompleto);
      $dui = $dui_incompleto[0];
      //Direccion
      $direccion = $request->get('direccion');
      //Edad
      $edad = $request->get('edad');
      $inicio = Paciente::where('estado',$estado)->orderBy('fechaNacimiento','asc')->first();
      $fin = Paciente::where('estado',$estado)->orderBy('fechaNacimiento','desc')->first();
      if($edad!=null){
        $edadx = explode(';',$edad);
        $minimo = $edadx[1];
        $maximo = $edadx[0];
        $fecha_minima = Carbon::now();
        $fecha_minima = $fecha_minima->subYears($minimo+1);
        $fecha_minima = $fecha_minima->subDay();
        $fecha_maxima = Carbon::now();
        $fecha_maxima = $fecha_maxima->subYears($maximo);
      }else{
        if($inicio == NULL){
          $fecha_maxima = $fecha_minima = Carbon::tomorrow();
        }else{
          $fecha_minima = $inicio->fechaNacimiento;
          $fecha_maxima = $fin->fechaNacimiento;
        }
      }
      if($inicio == NULL){
        $inicio = $fin = 0;
      }else{
        $inicio = $inicio->fechaNacimiento->age;
        $fin = $fin->fechaNacimiento->age;
      }
      $pacientes = Paciente::buscar($nombre,$apellido,$sexo,$telefono,$dui,$direccion,$fecha_minima,$fecha_maxima,$estado);
      $pdf = \App::make('dompdf.wrapper');
      //$view = view('Pacientes.PDF.pacientes',compact('pacientes'));
      $pdf->loadView('Pacientes.PDF.pacientes',compact('pacientes'));
      //$pdf->output();
      $dompdf = $pdf->getDomPDF();

      $canvas = $dompdf->get_canvas();
      $canvas->page_text(30,755,'Generado: '.date('d/m/Y h:i:s a'),null,10,array(0,0,0));
      $canvas->page_text(500, 755,("Página").": {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
      return $pdf->stream();
    }

    public function filtrar(Request $request){
      $estado = $request->get('estado');
      $nombre = $request->get('nombre');
      $apellido = $request->get('apellido');
      $sexo = $request->get('sexo');
      //Telefono
      $telefono_incompleto = $request->get('telefono');
      $telefono_incompleto = explode('_',$telefono_incompleto);
      $telefono = $telefono_incompleto[0];
      //dui
      $dui_incompleto = $request->get('dui');
      $dui_incompleto = explode('_',$dui_incompleto);
      $dui = $dui_incompleto[0];
      //Direccion
      $direccion = $request->get('direccion');
      //Edad
      $edad = $request->get('edad');
      $inicio = Paciente::where('estado',$estado)->orderBy('fechaNacimiento','asc')->first();
      $fin = Paciente::where('estado',$estado)->orderBy('fechaNacimiento','desc')->first();
      if($edad!=null){
        $edad = explode(';',$edad);
        $minimo = $edad[1];
        $maximo = $edad[0];
        $fecha_minima = Carbon::now();
        $fecha_minima = $fecha_minima->subYears($minimo+1);
        $fecha_minima = $fecha_minima->subDay();
        $fecha_maxima = Carbon::now();
        $fecha_maxima = $fecha_maxima->subYears($maximo);
      }else{
        if($inicio == NULL){
          $fecha_maxima = $fecha_minima = Carbon::tomorrow();
        }else{
          $fecha_minima = $inicio->fechaNacimiento;
          $fecha_maxima = $fin->fechaNacimiento;
        }
      }
      if($inicio == NULL){
        $inicio = $fin = 0;
      }else{
        $inicio = $inicio->fechaNacimiento->age;
        $fin = $fin->fechaNacimiento->age;
      }
      $pacientes = Paciente::contar($nombre,$apellido,$sexo,$telefono,$dui,$direccion,$fecha_minima,$fecha_maxima,$estado);
      return Response::json($pacientes);
    }

  function guardar_externo(Request $request){
    DB::beginTransaction();
    try {
      $pacientes = Paciente::create($request->All());
      if($pacientes->pais != null){
        $pacientes->departamento = null;
        $pacientes->municipio = null;
      }
      $pacientes->save();
    } catch (Exception $e) {
      DB::rollback();
      return false;
    }
    DB::commit();
    Bitacora::bitacora('store','pacientes','pacientes',$pacientes->id);
    $respuesta = [
      'nombre' => $pacientes->nombre,
      'apellido' => $pacientes->apellido,
      'id' => $pacientes->id
    ];
    return $respuesta;
  }

  //Funcion para cargar municipios segun el departamento

  function municipios($departamento){
    if($departamento == "San Salvador"){
      $municipios = [
        "San Salvador",
        "Aguilares",
        "Apopa",
        "Ayutuxtepeque",
        "Ciudad Delgado",
        "Cuscatancingo",
        "El Paisnal",
        "Guazapa",
        "Ilopango",
        "Mejicanos",
        "Nejapa",
        "Panchimalco",
        "Rosario de Mora",
        "San Marcos",
        "San Martín",
        "Santiago Texacuangos",
        "Santo Tomás",
        "Soyapango",
        "Tonacatepeque"
      ];
    }else if($departamento == "Santa Ana"){
      $municipios = [
        "Santa Ana",
        "Candelaria de la Frontera",
        "Chalchuapa",
        "Coatepeque",
        "El Congo",
        "El Porvenir",
        "Masahuat",
        "Metapán",
        "San Antonio Pajonal",
        "San Sebastián Salitrillo",
        "Santa Rosa Guachipilín",
        "Santiago de la Frontera",
        "Texistepeque"
      ];
    }else if($departamento == "San Miguel"){
      $municipios = [
        "San Miguel",
        "Carolina",
        "Chapeltique",
        "Chirilagua",
        "Ciudad Barrios",
        "Comacarán",
        "El Tránsito",
        "Lolotique",
        "Moncagua",
        "Nueva Guadalupe",
        "Nuevo Edén de San Juan",
        "Quelepa",
        "San Antonio del Mosco",
        "San Gerardo",
        "San Jorge",
        "San Luis de la Reina",
        "San Rafael Oriente",
        "Sesori",
        "Uluazapa"
      ];
    }else if($departamento == "La Libertad"){
      $municipios = [
        "Santa Tecla",
        "Antiguo Cuscatlán",
        "Chiltiupán",
        "Ciudad Arce",
        "Colón",
        "Comasagua",
        "Huizúcar",
        "Jayaque",
        "Jicalapa",
        "La Libertad",
        "Nuevo Cuscatlán",
        "San Juan Opico",
        "Quezaltepeque",
        "Sacacoyo",
        "San José Villanueva",
        "San Matías",
        "San Pablo Tacachico",
        "Talnique",
        "Tamanique",
        "Teotepeque",
        "Tepecoyo",
        "Zaragoza"
      ];
    }else if($departamento == "Usulután"){
      $municipios = [
        "Usulután",
        "Alegría",
        "Berlín",
        "California",
        "Concepción Batres",
        "El Triunfo",
        "Ereguayquín",
        "Estanzuelas",
        "Jiquilisco",
        "Jucuapa",
        "Jucuarán",
        "Mercedes Umaña",
        "Nueva Granada",
        "Ozatlán",
        "Puerto El Triunfo",
        "San Agustín",
        "San Buenaventura",
        "San Dionisio",
        "San Francisco Javier",
        "Santa Elena",
        "Santa María",
        "Santiago de María",
        "Tecapán"
      ];
    }else if($departamento == "Sonsonate"){
      $municipios = [
        "Sonsonate",
        "Acajutla",
        "Armenia",
        "Caluco",
        "Cuisnahuat",
        "Izalco",
        "Juayúa",
        "Nahuizalco",
        "Nahulingo",
        "Salcoatitán",
        "San Antonio del Monte",
        "San Julián",
        "Santa Catarina Masahuat",
        "Santa Isabel Ishuatán",
        "Santo Domingo de Guzmán",
        "Sonzacate"
      ];
    }else if($departamento == "La Unión"){
      $municipios = [
        "La Unión",
        "Anamorós",
        "Bolívar",
        "Concepción de Oriente",
        "Conchagua",
        "El Carmen",
        "El Sauce",
        "Intipucá",
        "Lilisque",
        "Meanguera del Golfo",
        "Nueva Esparta",
        "Pasaquina",
        "Polorós",
        "San Alejo",
        "San José",
        "Santa Rosa de Lima",
        "Yayantique",
        "Yucuaiquín"
      ];
    }else if($departamento == "La Paz"){
      $municipios = [
        "Zacatecoluca",
        "Cuyultitán",
        "El Rosario",
        "Jerusalén",
        "Mercedes La Ceiba",
        "Olocuilta",
        "Paraíso de Osorio",
        "San Antonio Masahuat",
        "San Emigdio",
        "San Francisco Chinameca",
        "San Juan Nonualco",
        "San Juan Talpa",
        "San Juan Tepezontes",
        "San Luis La Herradura",
        "San Luis Talpa",
        "San Miguel Tepezontes",
        "San Pedro Masahuat",
        "San Pedro Nonualco",
        "San Rafael Obrajuelo",
        "Santa María Ostuma",
        "Santiago Nonualco",
        "Tapalhuaca"
      ];
    }else if($departamento == "Chalatenango"){
      $municipios = [
        "Chalatenango",
        "Agua Caliente",
        "Arcatao",
        "Azacualpa",
        "Citalá",
        "Comalapa",
        "Concepción Quezaltepeque",
        "Dulce Nombre de María",
        "El Carrizal",
        "El Paraíso",
        "La Laguna",
        "La Palma",
        "Las Vueltas",
        "Nombre de Jesús",
        "Nueva Concepción",
        "Nueva Trinidad",
        "Ojos de Agua",
        "Potonico",
        "San Antonio de la Cruz",
        "San Antonio los Ranchos",
        "San Fernando",
        "San Francisco Lempa",
        "San Francisco Morazán",
        "San Ignacio",
        "San Isidro Labrador",
        "San José Cancasque",
        "San José Las Flores",
        "San Luis del Carmen",
        "San Miguel de Mercedes",
        "San Rafael",
        "Santa Rita",
        "Tejutla"
      ];
    }else if($departamento == "Cuscatlán"){
      $municipios = [
        "Cojutepeque",
        "Candelaria",
        "El Carmen",
        "El Rosario",
        "Monte San Juan",
        "Oratorio de Concepción",
        "San Bartolomé Perulapía",
        "San Cristóbal",
        "San José Guayabal",
        "San Pedro Perulapán",
        "San Rafael Cedros",
        "San Ramón",
        "Santa Cruz Analquito",
        "Santa Cruz Michapa",
        "Suchitoto",
        "Tenancingo"
      ];
    }else if($departamento == "Ahuachapán"){
      $municipios = [
        "Ahuachapán",
        "Apaneca",
        "Atiquizaya",
        "Concepción de Ataco",
        "El Refugio",
        "Guaymango",
        "Jujutla",
        "San Francisco Menéndez",
        "San Lorenzo",
        "San Pedro Puxtla",
        "Tacuba",
        "Turín"
      ];
    }else if ($departamento == "Morazán"){
      $municipios = [
        "San Francisco Gotera",
        "Arambala",
        "Cacaopera",
        "Chilanga",
        "Corinto",
        "Delicias de Concepción",
        "El Divisadero",
        "El Rosario",
        "Gualococti",
        "Guatajiagua",
        "Joateca",
        "Jocoaitique",
        "Jocoro",
        "Lolotiquillo",
        "Meanguera",
        "Osicala",
        "Perquín",
        "San Carlos",
        "San Fernando",
        "San Isidro",
        "San Simón",
        "Sensembra",
        "Sociedad",
        "Torola",
        "Yamabal",
        "Yoloaquín"
      ];
    }else if($departamento == "San Vicente"){
      $municipios = [
        "San Vicente",
        "Apastepeque",
        "Guadalupe",
        "San Cayetano Istepeque",
        "San Esteban Catarina",
        "San Ildefonso",
        "San Lorenzo",
        "San Sebastián",
        "Santa Clara",
        "Santo Domingo",
        "Tecoluca",
        "Tepetitán",
        "Verapaz"
      ];
    }else if($departamento == "Cabañas"){
      $municipios = [
        "Sensuntepeque",
        "Cinquera",
        "Dolores",
        "Guacotecti",
        "Ilobasco",
        "Jutiapa",
        "San Isidro",
        "Tejutepeque",
        "Victoria"
      ];
    }

    return $municipios;
  }

  public function editar_alergia(Request $request){
    $id = $request->id;
    $alergia = $request->alergia;
    $paciente = Paciente::find($id);
    DB::beginTransaction();
    try{
      $paciente->alergia = $alergia;
      $paciente->save();
      DB::commit();
    }catch(Exception $e){
      DB::rollback();
      return 2;
    }
    return $paciente->alergia;
  }

  public function servicio_medico(Request $request){
    if($request->tipo != -1){
      $r = Ingreso::where('tipo',$request->tipo)->where('f_paciente',$request->id)->orderBy('fecha_ingreso','desc')->get();
    }else{
      $r = Ingreso::where('f_paciente',$request->id)->orderBy('fecha_ingreso','desc')->get();
    }
    $count = $r->count();
    return (compact('r','count'));
  }

  public function tipo_evaluacion(Request $request){
    $tipo = $request->tipo;
    $id = $request->id;

    if($tipo == -1){
      $solicitudes = SolicitudExamen::where('f_paciente',$id)->orderBy('created_at','desc')->get();
    }else if($tipo == 0){
      $solicitudes = SolicitudExamen::where('f_paciente',$id)->where('f_examen','!=',null)->orderBy('created_at','desc')->get();
    }else if($tipo == 1){
      $solicitudes = SolicitudExamen::where('f_paciente',$id)->where('f_rayox','!=',null)->orderBy('created_at','desc')->get();
    }else if($tipo == 2){
      $solicitudes = SolicitudExamen::where('f_paciente',$id)->where('f_ultrasonografia','!=',null)->orderBy('created_at','desc')->get();
    }else{
      $solicitudes = SolicitudExamen::where('f_paciente',$id)->where('f_tac','!=',null)->orderBy('created_at','desc')->get();
    }

    $fila = [];
    $html = '';
    setlocale(LC_ALL,'es');

    if($solicitudes != null){
      $i = 0;
      foreach($solicitudes as $solicitud){
        $html = '<tr>';
        $html .= '<td>';
        $html = $fila[$i][0] = ($i + 1);
        $html .= '</td>';
        $html .= '<td>';
				$html .= $fila[$i][1] = $solicitud->created_at->formatLocalized('%d %b %y');
				$html .= '</td>';
				$html .= '<td>';
				$html .= $fila[$i][2] = $solicitud->created_at->formatLocalized('%R');
        if($solicitud->transaccion != null){
          $html .= '<i class="fas fa-check-circle text-success float-right"></i>';
        }
        $html .= '</td>';
        $html .= '<td>';
        if($solicitud->f_examen != null){
          $html .= $fila[$i][3] = $solicitud->examen->nombreExamen;
        }else if($solicitud->f_rayox != null){
          $html .= $fila[$i][3] = $solicitud->rayox->nombre;
        }else if($solicitud->f_ultrasonografia != null){
          $html .= $fila[$i][3] = $solicitud->ultrasonografia->nombre;
        }else if($solicitud->f_tac != null){
          $html .= $fila[$i][3] = $solicitud->tac->nombre;
        }
        $html .= '</td>';
        $html .= '<td>';
        if($solicitud->f_examen != null){
          $html .= $fila[$i][4] = '<span class="badge border border-primary text-primary col-10">LAB</span>';
        }else if($solicitud->f_rayox != null){
          $html .= $fila[$i][4] = '<span class="badge border border-danger text-danger col-10">RYX</span>';
        }else if($solicitud->f_ultrasonografia != null){
          $html .= $fila[$i][4] = '<span class="badge border border-success text-success col-10">ULT</span>';
        }else if($solicitud->f_tac != null){
          $html .= $fila[$i][4] = '<span class="badge border border-warning  text-warning col-10">TAC</span>';
        }
        $html .= '</td>';
        $html .= '<td>';
        if($solicitud->f_examen != null){
          $html .= $fila[$i][5] = '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_examen_pac" title="Ver" data-value={"solicitud_id":"'.$solicitud->id.'","examen_id":"'.$solicitud->f_examen.'","estado":"'.$solicitud->estado.'"} id="ver_examen_f">
            <i class="fas fa-info-circle"></i>
          </button>';
        }else if($solicitud->f_rayox != null){
          $html .= $fila[$i][5] = '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_ev_pac" title="Ver" data-value={"solicitud_id":"'.$solicitud->id.'","tipo":"0","estado":"'.$solicitud->estado.'"} id="ver_evaluacion_f">
            <i class="fas fa-info-circle"></i>
          </button>';
        }else if($solicitud->f_ultrasonografia != null){
          $html .= $fila[$i][5] = '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_ev_pac" title="Ver" data-value={"solicitud_id":"'.$solicitud->id.'","tipo":"1","estado":"'.$solicitud->estado.'"} id="ver_evaluacion_f">
            <i class="fas fa-info-circle"></i>
          </button>';
        }else if($solicitud->f_tac != null){
          $html .= $fila[$i][5] = '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_ev_pac" title="Ver" data-value={"solicitud_id":"'.$solicitud->id.'","tipo":"2","estado":"'.$solicitud->estado.'"} id="ver_evaluacion_f">
            <i class="fas fa-info-circle"></i>
          </button>';
        }
        $html .= '</td>';
        $html .= '</tr>';
        $i++;
      }
    }

    return compact('fila','html');
  }

  public function servicio_paciente (Request $request){
    $ingreso = Ingreso::find($request->id);
    $consultas = $ingreso->consulta;
    $medicos = [];
    if($consultas != null){
      foreach($consultas as $k => $consulta){
        $medicos[$k] = (($consulta->medico->sexo)?'Dr. ':'Dra. ').$consulta->medico->apellido;
      }
    }
    $hoy = Carbon::today()->hour(7);
    $ahora = Carbon::now();
    if($ahora->lt($hoy)){
      $hoy->subDay();
    }
    $dia_ingreso = $ingreso->fecha_ingreso->hour(7)->minute(0);
    if($ingreso->fecha_ingreso->lt($dia_ingreso)){
      $dia_ingreso->subDay();
    }
    $dias = 0;
    if($ingreso->estado == 1){
      $dias = $dia_ingreso->diffInDays($hoy);
    }else if($ingreso->estado == 2){
      $dia_alta = $ingreso->fecha_alta->hour(7)->minute(0);
      $dias_a = $ingreso->fecha_alta->hour(7)->minute(0);
      if($ingreso->fecha_alta->lt($dia_alta)){
        $dia_alta->subDay();
        $dias_a->subDay();
      }
      $dias = $dia_ingreso->diffInDays($dia_alta);
    }

    if($ingreso->tipo == 0){
      $total = Ingreso::servicio_gastos($request->id);
      $total += Ingreso::honorario_gastos($request->id);
      $total += Ingreso::tratamiento_gastos($request->id);
    }elseif($ingreso->tipo == 3){
      $total = $ingreso->hospitalizacion->medico->servicio->precio;
      $total = ($total / 1.13);
    }

    $iva = $total * 0.13;
    $total += $iva;

    return (compact(
      'total',
      'ingreso',
      'dias',
      'consultas',
      'medicos'
    ));
  }

  public function ver_evaluacion(Request $request){
    $id = $request->solicitud;
    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $solicitud = SolicitudExamen::find($id);
    if($solicitud->f_rayox != null){
      $nombre = $solicitud->rayox->nombre;
    }else if($solicitud->f_ultrasonografia != null){
      $nombre = $solicitud->ultrasonografia->nombre;
    }else if($solicitud->f_tac != null){
      $nombre = $solicitud->tac->nombre;
    }

    $html = "";

    if($resultado != null){
      $html = '<div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h5>Resultado</h5>
              <div class="ln_solid mb-2 mt-2"></div>
            </center>
          </div>
          <div class="flex-row">
            <center>
              <h6>
                '.$resultado->observacion.'
              </h6>
            </center>
          </div>
        </div>
      </div>';
    }

    return compact('html','solicitud','nombre');
  }

  public function ver_examen(Request $request){
    $id = $request->solicitud;
    $idExamen = $request->examen;

    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
    $solicitud=SolicitudExamen::where('id','=',$id)->where('f_examen','=',$idExamen)->first();
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->get();
    $contador=0;
    $contadorSecciones=0;
    if($espr!=null){
      foreach ($espr as $esp) {
        if($contador==0){
          $secciones[$contadorSecciones]=$esp->f_seccion;
        }else{
          if($secciones[$contadorSecciones]==$esp->f_seccion)
          {
          }else {
            $contadorSecciones++;
            $secciones[$contadorSecciones]=$esp->f_seccion;
          }
        }
        $contador++;
      }
    }

    $html ='<div class="col-sm-12">';
    if($solicitud->examen->imagen){
      $html .= '<div class="x_panel m_panel"><div class="flex-row">
        <center>
          <output id="listExamen" style="height:400px; width:400px; object-fit: scale-down;">
          <img src="'.asset(Storage::url($resultado->imagen)).'" id="imgZoom"style="height: 400px; width: 400px; object-fit: scale-down">
          </output>
        </center>
      </div></div>';
    }else{
      foreach($secciones as $variable){
        $contadorParametros = 1;
        $html .= '<div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h5>
                <i class="fas fa-flask"></i> ';
        $html .= ExamenSeccionParametro::nombre_seccion($variable);
        $html .= '</h5>
            </center>
          </div>
          <div class="row">
            <table class="table table-sm table-hover table-stripped">
              <thead>
                <th style="width: 5%">#</th>
                <th style="width: 25%">Parametro</th>
                <th style="width: 20%">Resultado</th>
                <th style="width: 10%" title="Valor Normal mínimo">VNm</th>
                <th style="width: 10%" title="Valor Normal Máximo">VNM</th>
                <th style="width: 15%">Unidades</th>
                <th style="width: 10%">DC</th>
              </thead>
              <tbdoy>';
        if($espr!=null){
          foreach($espr as $esp => $valor){
            if($valor->f_seccion == $variable){
              $html .= '<tr>
              <td>'.$contadorParametros.'</td>
              <td>'.$valor->nombreParametro($valor->f_parametro).'</td>
              <td>'.$detallesResultado[$esp]->resultado.'</td>';
              if($valor->parametro->valorMinimo){
                $html .= '<td>
                  <span class="badge border border-primary text-primary col-12">'.number_format($valor->parametro->valorMinimo, 2, '.', ',').'</span>
                </td>
                <td>
                  <span class="badge border border-danger text-danger col-12">'.number_format($valor->parametro->valorMaximo, 2, '.', ',').'</span>
                </td>';
              }else{
                $html .= '<td><span class="badge border border-secondary text-secondary">Ninguno</span></td>
                <td><span class="badge border border-secondary text-secondary">Ninguno</span></td>';
              }
              $html .= '<td>';
              if($valor->nombreUnidad($valor->parametro->unidad) == "-"){
                $html .= '<span class="badge border border-secondary text-secondary">Ninguna</span>';
              }else{
                $html .= $valor->nombreUnidad($valor->parametro->unidad);
              }
              $html .= '</td>';
              if($valor->f_reactivo){
                $html .= '<td>'.$detallesResultado[$esp]->dato_controlado.'</td>';
              }else{
                $html .= '<td><span class="badge border border-secondary text-secondary">Ninguno</span></td>';
              }
              $html .= '</tr>';
            }
            $contadorParametros++;
          }
        }else{
          $html .= '<tr>
            <td colspan="7">
              <center>No hay registros</center>
            </td>
          </tr>';
        }
        $html .= '</tbdoy>
            </table>
          </div>
        </div>';
      }
    }
    if($resultado->observacion != null){
      $html .='<div class="x_panel m_panel">
        <div class="flex-row">
          <center>
            <h5>Observación</h5>
          </center>
        </div>
        <div class="flex-row">
          <center>
            <span>'.$resultado->observacion.'</span>
          </center>
        </div>
      </div>';
    }
    $html .= '</div>';
    return $html;
  }

  public function datos_solicitud(Request $request){
    $id = $request->id;

    $solicitud = SolicitudExamen::find($id);

    $examen = $solicitud->examen->nombreExamen;

    $ex_area = $solicitud->examen->area;

    if($ex_area == "HEMATOLOGIA"){
      $area = '<span class="badge border border-pink text-pink col-8">Hematología</span>';
    }else if($ex_area == "EXAMENES DE ORINA"){
      $area = '<span class="badge border border-warning text-warning col-8">Uroanális</span>';
    }else if($ex_area == "EXAMENES DE HECES"){
      $area = '<span class="badge border border-dark col-8">Coprología</span>';
    }else if($ex_area == "BACTERIOLOGIA"){
      $area = '<span class="badge border border-success text-success col-8">Bacteriología</span>';
    }else if($ex_area == "QUIMICA SANGUINEA"){
      $area = '<span class="badge border border-danger text-danger col-8">Química sanguínea</span>';
    }else if($ex_area == "INMUNOLOGIA"){
      $area = '<span class="badge border border-primary text-primary col-8">Inmunología</span>';
    }else if($ex_area == "ENZIMAS"){
      $area = '<span class="badge border border-purple text-purple col-8">Enzimas</span>';
    }else if($ex_area == "PRUEBAS ESPECIALES"){
      $area = '<span class="badge border border-info text-info col-8">Pruebas especiales</span>';
    }else if($ex_area == "OTROS"){
      $area = '<span class="badge border border-secondary text-secondary col-8">Otros</span>';
    }

    return (compact('solicitud','examen','area'));
  }

  public function save_mini(Request $request){
    DB::beginTransaction();
      try {
        $pacientes = Paciente::create($request->All());
        $pacientes->departamento = "San Vicente";
        $pacientes->municipio = "San Vicente";
        $pacientes->save();
      } catch (Exception $e) {
        DB::rollback();
        return 0;
      }
      DB::commit();
      Bitacora::bitacora('store','pacientes','pacientes',$pacientes->id);

      $id = $pacientes->id;
      $nombre = $pacientes->nombre.' '.$pacientes->apellido;

      return compact('nombre','id');
	}
	
	public function acta_datos(Request $request){
		
		DB::beginTransaction();		
		try{
			$paciente = Paciente::find($request->paciente_id);
			$paciente->nombre = $request->nombre;
			$paciente->apellido = $request->apellido;
			$paciente->fechaNacimiento = $request->fecha;
			$paciente->dui = $request->dui;
			$paciente->direccion = $request->direccion;
			$paciente->telefono = $request->telefono;

			$paciente->save();

			if($request->paciente_id != $request->responsable_id){
				$responsable = Paciente::find($request->responsable_id);

				$responsable->nombre = $request->r_nombre;
				$responsable->apellido = $request->r_apellido;
				$responsable->dui = $request->r_dui;

				$responsable->save();
			}

			DB::commit();
			return 1;
		}catch(Exception $e){
			
			DB::rollback();
			return 0;
		}
	}
}
