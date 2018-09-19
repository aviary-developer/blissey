<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Paciente;
use App\Bitacora;
use App\Ingreso;
use Redirect;
use Carbon\Carbon;
use App\Http\Requests\PacienteRequest;
use DB;
use Response;

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
        return view('pacientes.create');
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
        $ingresos = $paciente->ingreso;
        return view('Pacientes.show',compact('paciente','ingresos'));
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
        $pacientes = Paciente::findOrFail($id);
        $pacientes->delete();
        Bitacora::bitacora('destroy','pacientes','pacientes',$id);
        return redirect('/pacientes?estado=0');
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

    $total = Ingreso::servicio_gastos($request->id);
    $total += Ingreso::honorario_gastos($request->id);
    $total += Ingreso::tratamiento_gastos($request->id);

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
}