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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
