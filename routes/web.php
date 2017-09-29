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
Route::resource('reactivos','ReactivoController');
Route::get('leerReactivos','ReactivoController@listingReactivos');

//Rutas de pacientes
Route::resource('pacientes','PacienteController');
Route::match(['get','post'],'/desactivatePaciente/{id}','PacienteController@desactivate');
Route::match(['get','post'],'/activatePaciente/{id}','PacienteController@activate');
Route::match(['get','post'],'/destroyPaciente/{id}','PacienteController@destroy');

//Rutas usuarios
Route::resource('usuarios','UserController');
Route::match(['get','post'],'/desactivateUsuario/{id}','UserController@desactivate');
Route::match(['get','post'],'/activateUsuario/{id}','UserController@activate');
Route::match(['get','post'],'/destroyUsuario/{id}','UserController@destroy');

//Rutas de proveedores
Route::resource('proveedores','ProveedorController');
Route::match(['get','post'],'/desactivateProveedor/{id}','ProveedorController@desactivate');
Route::match(['get','post'],'/activateProveedor/{id}','ProveedorController@activate');
Route::match(['get','post'],'/destroyProveedor/{id}','ProveedorController@destroy');
