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

Route::get('/', function () {
    return view('main');
});
//Rutas de Reactivos
Route::resource('reactivos','ReactivoController');
Route::match(['get','post'],'/desactivateReactivo/{id}','ReactivoController@desactivate');
Route::match(['get','post'],'/activateReactivo/{id}','ReactivoController@activate');
Route::match(['get','post'],'/destroyReactivo/{id}','ReactivoController@destroy');

//Rutas de pacientes
Route::group(['middleware'=>'recepcion'], function()
{
  Route::resource('pacientes','PacienteController');
  Route::match(['get','post'],'/desactivatePaciente/{id}','PacienteController@desactivate');
  Route::match(['get','post'],'/activatePaciente/{id}','PacienteController@activate');
  Route::match(['get','post'],'/destroyPaciente/{id}','PacienteController@destroy');
});

//Rutas usuarios
Route::group(['middleware'=>'admin'], function()
{
  Route::resource('usuarios','UserController');
  Route::match(['get','post'],'/desactivateUsuario/{id}','UserController@desactivate');
  Route::match(['get','post'],'/activateUsuario/{id}','UserController@activate');
  Route::match(['get','post'],'/destroyUsuario/{id}','UserController@destroy');
});

//Rutas de proveedores
Route::resource('proveedores','ProveedorController');
Route::match(['get','post'],'/desactivateProveedor/{id}','ProveedorController@desactivate');
Route::match(['get','post'],'/activateProveedor/{id}','ProveedorController@activate');
Route::match(['get','post'],'/destroyProveedor/{id}','ProveedorController@destroy');

//Rutas de especialidades
Route::resource('especialidades','EspecialidadController');
Route::match(['get','post'],'/desactivateEspecialidad/{id}','EspecialidadController@desactivate');
Route::match(['get','post'],'/activateEspecialidad/{id}','EspecialidadController@activate');
Route::match(['get','post'],'/destroyEspecialidad/{id}','EspecialidadController@destroy');

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

//Rutas de presentaciones
Route::resource('presentaciones','PresentacionController');
Route::match(['get','post'],'/desactivatePresentacion/{id}','PresentacionController@desactivate');
Route::match(['get','post'],'/activatePresentacion/{id}','PresentacionController@activate');
Route::match(['get','post'],'/destroyPresentacion/{id}','PresentacionController@destroy');

//Rutas de productos
Route::resource('productos','ProductoController');
Route::match(['get','post'],'/desactivateProducto/{id}','ProductoController@desactivate');
Route::match(['get','post'],'/activateProducto/{id}','ProductoController@activate');
Route::match(['get','post'],'/destroyProducto/{id}','ProductoController@destroy');

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

//Rutas de Unidades
Route::resource('unidades','UnidadController');
Route::match(['get','post'],'/desactivateUnidad/{id}','UnidadController@desactivate');
Route::match(['get','post'],'/activateUnidad/{id}','UnidadController@activate');
Route::match(['get','post'],'/destroyUnidad/{id}','UnidadController@destroy');

//Rutas de visitadores
Route::resource('visitadores','DependienteController');
Route::match(['get','post'],'/desactivateVisitador/{id}','DependienteController@desactivate');
Route::match(['get','post'],'/activateVisitador/{id}','DependienteController@activate');
Route::match(['get','post'],'/destroyVisitador/{id}','DependienteController@destroy');

//Ruta de bitacoras
Route::resource('historial','BitacoraController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');

//Rutas de estantes
Route::resource('estantes','EstanteController');
Route::match(['get','post'],'/desactivateEstante/{id}','EstanteController@desactivate');
Route::match(['get','post'],'/activateEstante/{id}','EstanteController@activate');
Route::match(['get','post'],'/destroyEstante/{id}','EstanteController@destroy');

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
