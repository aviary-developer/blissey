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
Route::resource('proveedores','ProveedorController');
//Rutas de pacientes
Route::resource('pacientes','PacienteController');
Route::match(['get','post'],'/desactivatePaciente/{id}','PacienteController@desactivate');
Route::match(['get','post'],'/activatePaciente/{id}','PacienteController@activate');
Route::match(['get','post'],'/destroyPaciente/{id}','PacienteController@destroy');
