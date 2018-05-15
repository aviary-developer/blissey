<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Grupo laboratorio
Route::group(['middleware'=>'laboratorio'], function(){
  //Rutas de Reactivos
  Route::resource('reactivos','ReactivoController');
  Route::match(['get','post'],'/desactivateReactivo/{id}','ReactivoController@desactivate');
  Route::match(['get','post'],'/activateReactivo/{id}','ReactivoController@activate');
  Route::match(['get','post'],'/destroyReactivo/{id}','ReactivoController@destroy');
  Route::match(['get','post'],'/llenarReactivosExamenes','ReactivoController@llenarReactivosExamenes');
  Route::match(['get','post'],'/ingresoReactivo','ReactivoController@ingresoReactivo');
  Route::match(['get','post'],'/actualizarExistenciaReactivos','ReactivoController@actualizarExistenciaReactivos');

  //Rutas de Secciones Examenes
  Route::resource('secciones','SeccionController');
  Route::match(['get','post'],'/desactivateSeccion/{id}','SeccionController@desactivate');
  Route::match(['get','post'],'/activateSeccion/{id}','SeccionController@activate');
  Route::match(['get','post'],'/destroySeccion/{id}','SeccionController@destroy');
  Route::match(['get','post'],'/llenarSeccionExamenes','SeccionController@llenarSeccionExamenes');
  Route::match(['get','post'],'/ingresoSeccion','SeccionController@ingresoSeccion');
  //Rutas de examenes
  Route::resource('examenes','ExamenController');
  Route::match(['get','post'],'/desactivateExamen/{id}','ExamenController@desactivate');
  Route::match(['get','post'],'/activateExamen/{id}','ExamenController@activate');
  Route::match(['get','post'],'/destroyExamen/{id}','ExamenController@destroy');
  //Rutas de banco de sangre
  Route::resource('bancosangre','BancoSangreController');
  Route::match(['get','post'],'/desactivateBancoSangre/{id}','BancoSangreController@desactivate');
  Route::match(['get','post'],'/activateBancoSangre/{id}','BancoSangreController@activate');
  Route::match(['get','post'],'/destroyBancoSangre/{id}','BancoSangreController@destroy');
  //Rutas de parametros
  Route::resource('parametros','ParametroController');
  Route::match(['get','post'],'/desactivateParametro/{id}','ParametroController@desactivate');
  Route::match(['get','post'],'/activateParametro/{id}','ParametroController@activate');
  Route::match(['get','post'],'/destroyParametro/{id}','ParametroController@destroy');
  Route::match(['get','post'],'/llenarParametrosExamenes','ParametroController@llenarParametrosExamenes');
  Route::match(['get','post'],'/ingresoParametro','ParametroController@ingresoParametro');
  //Rutas de Muestras
  Route::resource('muestras','MuestraExamenController');
  Route::match(['get','post'],'/desactivateMuestraExamen/{id}','MuestraExamenController@desactivate');
  Route::match(['get','post'],'/activateMuestraExamen/{id}','MuestraExamenController@activate');
  Route::match(['get','post'],'/destroyMuestraExamen/{id}','MuestraExamenController@destroy');
  Route::match(['get','post'],'/llenarMuestrasExamenes','MuestraExamenController@llenarMuestrasExamenes');
  Route::match(['get','post'],'/ingresoMuestra','MuestraExamenController@ingresoMuestra');
});
//Grupo Recepción
Route::group(['middleware'=>'recepcion'], function()
{
  //Rutas de categoria servicio
  Route::resource('categoria_servicios','CategoriaServicioController');
  Route::match(['get','post'],'/desactivateCategoriaServicio/{id}','CategoriaServicioController@desactivate');
  Route::match(['get','post'],'/activateCategoriaServicio/{id}','CategoriaServicioController@activate');
  Route::match(['get','post'],'/destroyCategoriaServicio/{id}','CategoriaServicioController@destroy');
  //Rutas de servicios
  Route::resource('servicios','ServicioController');
  Route::match(['get','post'],'/desactivateServicio/{id}','ServicioController@desactivate');
  Route::match(['get','post'],'/activateServicio/{id}','ServicioController@activate');
  Route::match(['get','post'],'/destroyServicio/{id}','ServicioController@destroy');
  //Rutas de habitaciones
  Route::resource('habitaciones','HabitacionController');
  Route::match(['get','post'],'/desactivateHabitacion/{id}','HabitacionController@desactivate');
  Route::match(['get','post'],'/activateHabitacion/{id}','HabitacionController@activate');
  Route::match(['get','post'],'/destroyHabitacion/{id}','HabitacionController@destroy');
  //Rutas de Ingresos
  Route::match(['get','post'],'/desactivateIngreso/{id}','IngresoController@destroy');
  Route::match(['get','post'],'/activateIngreso/{id}','IngresoController@activate');
  Route::match(['get','post'],'/acta/{id}','IngresoController@acta_pdf');
  Route::get('/informe_financiero/{id}','IngresoController@informe_pdf');
  //Rutas de Requisiciones
  Route::match(['get','post'],'/buscarProductoRequisicion/{texto}','RequisicionController@buscar');
      Route::match(['get','post'],'/asignarRequisicion/{id}','RequisicionController@asignar');
});
//Grupo Farmacia
Route::group(['middleware'=>'farmacia'], function(){
  //Rutas de proveedores
  Route::resource('proveedores','ProveedorController');
  Route::match(['get','post'],'/desactivateProveedor/{id}','ProveedorController@desactivate');
  Route::match(['get','post'],'/activateProveedor/{id}','ProveedorController@activate');
  Route::match(['get','post'],'/destroyProveedor/{id}','ProveedorController@destroy');
  //Rutas de presentaciones
  Route::resource('presentaciones','PresentacionController');
  Route::match(['get','post'],'/desactivatePresentacion/{id}','PresentacionController@desactivate');
  Route::match(['get','post'],'/activatePresentacion/{id}','PresentacionController@activate');
  Route::match(['get','post'],'/destroyPresentacion/{id}','PresentacionController@destroy');
  Route::match(['get','post'],'/guardarPresentacion/{nombre}','PresentacionController@guardar');
  Route::match(['get','post'],'/editarPresentacion/{id}/{nombre}','PresentacionController@editar');
  //Rutas de productos
  Route::resource('productos','ProductoController');
  Route::match(['get','post'],'/desactivateProducto/{id}','ProductoController@desactivate');
  Route::match(['get','post'],'/activateProducto/{id}','ProductoController@activate');
  Route::match(['get','post'],'/destroyProducto/{id}','ProductoController@destroy');
  Route::match(['get','post'],'/buscarComponenteProducto/{id}','ProductoController@buscarComponentes');
  Route::match(['get','post'],'/existeCodigoProducto/{codigo}','ProductoController@existeCodigo');
  Route::match(['get','post'],'/editarDivisionProducto','ProductoController@editarDivision');
  //Rutas de visitadores
  Route::resource('visitadores','DependienteController');
  Route::match(['get','post'],'/desactivateVisitador/{id}','DependienteController@desactivate');
  Route::match(['get','post'],'/activateVisitador/{id}','DependienteController@activate');
  Route::match(['get','post'],'/destroyVisitador/{id}','DependienteController@destroy');
  //Rutas de componentes
  Route::resource('componentes','ComponenteController');
  Route::match(['get','post'],'/desactivateComponente/{id}','ComponenteController@desactivate');
  Route::match(['get','post'],'/activateComponente/{id}','ComponenteController@activate');
  Route::match(['get','post'],'/destroyComponente/{id}','ComponenteController@destroy');
  //Rutas de divisiones
  Route::resource('divisiones','DivisionController');
  Route::match(['get','post'],'/desactivateDivision/{id}','DivisionController@desactivate');
  Route::match(['get','post'],'/activateDivision/{id}','DivisionController@activate');
  Route::match(['get','post'],'/destroyDivision/{id}','DivisionController@destroy');
  //Rutas requisiciones acceso Farmacia
  Route::match(['get','post'],'/verrequisiciones','RequisicionController@verrequisiciones');
    Route::match(['get','post'],'/confirmarRequisicion/{id}','RequisicionController@confirmar');
    Route::match(['get','post'],'/atenderPeticion/{id}','RequisicionController@atenderPeticion');
});
//Grupo Administrador
Route::group(['middleware'=>'admin'], function()
{
  //Rutas usuarios
  Route::resource('usuarios','UserController');
  Route::match(['get','post'],'/desactivateUsuario/{id}','UserController@desactivate');
  Route::match(['get','post'],'/activateUsuario/{id}','UserController@activate');
  Route::match(['get','post'],'/destroyUsuario/{id}','UserController@destroy');

  //Rutas de especialidades
  Route::resource('especialidades','EspecialidadController');
  Route::match(['get','post'],'/desactivateEspecialidad/{id}','EspecialidadController@desactivate');
  Route::match(['get','post'],'/activateEspecialidad/{id}','EspecialidadController@activate');
  Route::match(['get','post'],'/destroyEspecialidad/{id}','EspecialidadController@destroy');
});
Route::group(['middleware'=>'general'], function(){
  Route::get('/', function () {
    $primero = $segundo = $tercero = "Nada";
    if(Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Laboaratorio"){
      $primero = App\Ingreso::where('estado',1)->take(5)->get();
      $segundo = App\SolicitudExamen::where('estado','<>',3)->distinct()->get(['f_paciente']);
      $tercero = App\Reactivo::where('contenidoPorEnvase','<',10)->get();
    }
    $empresa = App\Empresa::latest()->first();
    // App\Transacion::llenar();
    return view('main', compact(
      "empresa",
      "primero",
      "segundo",
      "tercero"
    ));
  });

  //Ver si existe el servicio de honorarios médicos
  Route::get('/servicio_honorario', function(){
    $servicio = App\Servicio::where('nombre','Honorarios médicos por ingreso')->count();
    return $servicio;
  });

  //Ruta de usuario
  Route::match(['get','post'],'/psw','UserController@psw');

  //Ruta de empresa
  Route::resource('grupo_promesa','EmpresaController');

  //Ruta de bitacoras
  Route::resource('historial','BitacoraController');

  //Rutas de transacciones
  Route::resource('transacciones','TransaccionController');
  Route::match(['get','post'],'/buscarProductoTransaccion/{id}/{texto}','TransaccionController@buscarProductos');
  Route::match(['get','post'],'/buscarDivisionTransaccion/{id}','TransaccionController@buscarDivisiones');
  Route::match(['get','post'],'/buscarNombreDivision/{id}','TransaccionController@nombreDivision');
  Route::match(['get','post'],'/buscarNombrePresentacion/{id}/{tipo}','TransaccionController@nombrePresentacion');
  Route::match(['get','post'],'/confirmarPedido/{id}','TransaccionController@confirmarPedido');
  Route::match(['get','post'],'/busquedaCodigo/{id}/{tipo}','TransaccionController@buscarDivision');
  Route::match(['get','post'],'/buscarCliente/{cliente}','TransaccionController@buscarCliente');
  Route::match(['get','post'],'/buscarProductoVenta/{texto}','TransaccionController@buscarVenta');
  Route::match(['get','post'],'/buscarComponenteVenta/{texto}','TransaccionController@buscarComponente');
  Route::match(['get','post'],'/eliminarPedido/{id}/{tipo}','TransaccionController@eliminarPedido');
  Route::match(['get','post'],'/buscarServicios/{texto}','TransaccionController@buscarServicio');
  Route::match(['get','post'],'/anularVenta/{id}/{comentario}','TransaccionController@anularVenta');
  Route::match(['get','post'],'/niveles/{id}','TransaccionController@niveles');
  //Rutas de estantes
  Route::resource('estantes','EstanteController');
  Route::match(['get','post'],'/desactivateEstante/{id}','EstanteController@desactivate');
  Route::match(['get','post'],'/activateEstante/{id}','EstanteController@activate');
  Route::match(['get','post'],'/destroyEstante/{id}','EstanteController@destroy');
  //Rutas de Unidades
  Route::resource('unidades','UnidadController');
  Route::match(['get','post'],'/desactivateUnidad/{id}','UnidadController@desactivate');
  Route::match(['get','post'],'/activateUnidad/{id}','UnidadController@activate');
  Route::match(['get','post'],'/destroyUnidad/{id}','UnidadController@destroy');
  //Rutas de Solicitud de examenes
  Route::resource('solicitudex','SolicitudExamenController');
  Route::match(['get','post'],'/evaluarExamen/{id}/{idExamen}','SolicitudExamenController@evaluarExamen');
  Route::match(['get','post'],'/aceptarSolicitudExamen/{id}','SolicitudExamenController@aceptar');
  Route::match(['get','post'],'/activateSolicitudExamen/{id}','SolicitudExamenController@activate');
  Route::match(['get','post'],'/destroySolicitudExamen/{id}','SolicitudExamenController@destroy');
  Route::match(['get','post'],'/guardarResultadosExamen','SolicitudExamenController@guardarResultadosExamen');
  Route::match(['get','post'],'/entregarExamen/{id}/{idExamen}','SolicitudExamenController@entregarExamen');
  Route::match(['get','post'],'/editarExamen/{id}/{idExamen}','SolicitudExamenController@editarResultadosExamen');
  Route::match(['get','post'],'/examenesEvaluados','SolicitudExamenController@examenesEvaluados');
  Route::match(['get','post'],'/impresionExamenesPorPaciente/{paciente}/{bandera}','SolicitudExamenController@impresionExamenesPorPaciente');
  //Pacientes
  Route::resource('pacientes','PacienteController');
  Route::match(['get','post'],'/desactivatePaciente/{id}','PacienteController@desactivate');
  Route::match(['get','post'],'/activatePaciente/{id}','PacienteController@activate');
  Route::match(['get','post'],'/destroyPaciente/{id}','PacienteController@destroy');
  Route::match(['get','post'],'/paciente_pdf','PacienteController@paciente_pdf');
  Route::match(['get','post'],'/filtrarPaciente','PacienteController@filtrar');
  Route::match(['get','post'],'/municipios/{departamento}','PacienteController@municipios');
  Route::match(['get','post'],'/guardar_paciente','PacienteController@guardar_externo');
  Route::match(['get','post'],'/buscarPacienteIngreso/{id}','IngresoController@buscarPaciente');
  Route::match(['get','post'],'/buscarPersonas','IngresoController@buscarPersonas');
  //Inventarios
  Route::resource('inventarios','InventarioController');
  //Ingresos
  Route::resource('ingresos','IngresoController');
  Route::get('/total_resumen','IngresoController@resumen');
  Route::post('/tratamiento','IngresoController@tratamiento');
  Route::post('/abonar','IngresoController@abonar');
  Route::post('/servicio_medicos','IngresoController@servicio_medicos');
  Route::post('/cambio_ingreso','IngresoController@cambio_ingreso');
  Route::post('/editar24','IngresoController@editar24');
  Route::post('/eliminar24','IngresoController@eliminar24');
  Route::post('/cambiar_estado','IngresoController@cambiar_estado');
//Requisiciones farmacia
  Route::resource('requisiciones','RequisicionController');
  //Categoria $productos
  Route::resource('categoria_productos','CategoriaProductoController');
  Route::match(['get','post'],'/desactivateCategoriaProducto/{id}','CategoriaProductoController@desactivate');
  Route::match(['get','post'],'/activateCategoriaProducto/{id}','CategoriaProductoController@activate');
  Route::match(['get','post'],'/destroyCategoriaProducto/{id}','CategoriaProductoController@destroy');
  //rutas relacionadas con el stock mínimo
  Route::match(['get'],'/stockTodos','DivisionProductoController@stockTodos');
  Route::match(['get'],'/stockProveedor/{f_proveedor}','DivisionProductoController@stockProveedor');
  //Signos vitales
  Route::resource('signos','SignoVitalController');
  Route::get('/signo_lista','SignoVitalController@listar');
  //Fechas de vencimiento
  Route::resource('cambio_productos','CambioProductoController');
  Route::get('/descartarVencidos','CambioProductoController@descartar');

  //Rutas medicas
  Route::get('/historial_medico','ConsultaController@historial_medico');
  Route::resource('/consulta','ConsultaController');
});
Auth::routes();
//Rutas de login
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
Route::get ('/github', 'PdfController@github');
Route::get ('/llenar', 'RequisicionController@index');

Route::resource('/ultrasonografias','UltrasonografiaController');
Route::match(['get','post'],'/desactivateUltrasonografia/{id}','UltrasonografiaController@desactivate');
Route::match(['get','post'],'/activateUltrasonografia/{id}','UltrasonografiaController@activate');
Route::match(['get','post'],'/destroyUltrasonografia/{id}','UltrasonografiaController@destroy');

Route::resource('/rayosx','RayosxController');
Route::match(['get','post'],'/desactivateRayosx/{id}','RayosxController@desactivate');
Route::match(['get','post'],'/activateRayosx/{id}','RayosxController@activate');
Route::match(['get','post'],'/destroyRayosx/{id}','RayosxController@destroy');
