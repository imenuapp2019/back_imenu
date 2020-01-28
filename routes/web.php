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
//Ruta para devolver la vista Home desde web
Route::get('home', 'HomeController@index');
//Ruta para actualizar los datos de un restaurante
Route::middleware('auth')->get('restaurantupdate/{id}', 'RestUpdateViewController@index');
