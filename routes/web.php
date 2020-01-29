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
    return view('welcome');
});

Auth::routes();
//Ruta Web para devolver la vista Home desde web
Route::get('home', 'HomeController@index');
//Ruta Web para actualizar los datos de un restaurante
Route::middleware('auth')->get('updateRestaurante/{id}', 'RestUpdateViewController@index');
//Ruta Web para crear un restaurante
Route::get('createRestaurante', 'ControllerFormularioResrtaurante@callController');


//Create restaurante
Route::middleware('auth:api')->post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::middleware('auth:api')->delete('restaurantes/delete/{id}', 'RestauranteController@delete');
//Update restaurante
Route::middleware('auth:api')->match(['put', 'post'], 'restaurantes/update/{id}', 'RestauranteController@update');
