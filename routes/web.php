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
Route::get('home', 'HomeController@index')->name('home');
//Ruta Web para actualizar los datos de un restaurante
Route::middleware('auth')->get('updateRestaurante/{id}', 'RestUpdateViewController@index')->name('update');
//Ruta Web para crear un restaurante
Route::get('createRestaurante', 'ControllerFormularioResrtaurante@callController');

//Create restaurante
Route::middleware('auth')->post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::middleware('auth')->delete('restaurantes/delete/{id}', 'RestauranteController@delete')->name('delete');
//Update restaurante
Route::middleware('auth')->match(['put', 'post'], 'restaurantes/update/{id}', 'RestauranteController@update');
