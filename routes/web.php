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

  //Rutas de Secciones Examenes
  Route::resource('secciones','SeccionController');
  Route::match(['get','post'],'/desactivateSeccion/{id}','SeccionController@desactivate');
  Route::match(['get','post'],'/activateSeccion/{id}','SeccionController@activate');
  Route::match(['get','post'],'/destroySeccion/{id}','SeccionController@destroy');
  Route::match(['get','post'],'/llenarSeccionExamenes','SeccionController@llenarSeccionExamenes');
  //Rutas de examenes
  Route::resource('examenes','ExamenController');
  Route::match(['get','post'],'/desactivateExamen/{id}','ExamenController@desactivate');
  Route::match(['get','post'],'/activateExamen/{id}','ExamenController@activate');
  Route::match(['get','post'],'/destroyExamen/{id}','ExamenController@destroy');
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
});
//Grupo Recepción
Route::group(['middleware'=>'recepcion'], function()
{
  //Rutas de pacientes
  Route::resource('pacientes','PacienteController');
  Route::match(['get','post'],'/desactivatePaciente/{id}','PacienteController@desactivate');
  Route::match(['get','post'],'/activatePaciente/{id}','PacienteController@activate');
  Route::match(['get','post'],'/destroyPaciente/{id}','PacienteController@destroy');
  Route::match(['get','post'],'/paciente_pdf','PacienteController@paciente_pdf');
  Route::match(['get','post'],'/filtrarPaciente','PacienteController@filtrar');
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
  Route::resource('ingresos','IngresoController');
  Route::match(['get','post'],'/desactivateIngreso/{id}','IngresoController@destroy');
  Route::match(['get','post'],'/activateIngreso/{id}','IngresoController@activate');
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
    $primero = $segundo = "Nada";
    if(Auth::user()->tipoUsuario == "Recepción"){
      $primero = App\Ingreso::where('estado',1)->take(5)->get();
      $segundo = App\SolicitudExamen::where('estado','<>',3)->distinct()->get(['f_paciente']);
    }
    $empresa = App\Empresa::latest()->first();
    return view('main', compact(
      "empresa",
      "primero",
      "segundo"
    ));
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
  Route::match(['get','post'],'/busquedaCodigo/{id}','TransaccionController@buscarDivision');
  Route::match(['get','post'],'/inventario','TransaccionController@inventario');
  Route::match(['get','post'],'/buscarCliente/{cliente}','TransaccionController@buscarCliente');
    Route::match(['get','post'],'/buscarProductoVenta/{texto}','TransaccionController@buscarVenta');
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
  //Pacientes
  Route::match(['get','post'],'/buscarPacienteIngreso/{id}','IngresoController@buscarPaciente');
});
Auth::routes();
//Rutas de login
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
