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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Ruta Web para devolver la vista Home desde web
Route::get('home', 'HomeController@index')->name('home');


//Create restaurante
Route::middleware('auth')->post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::middleware('auth')->get('restaurantes/delete/{id}', 'RestauranteController@delete')->name('delete_restaurante');
//Update restaurante
Route::middleware('auth')->match(['put', 'post'], 'restaurantes/update/{id}', 'RestauranteController@update');


Route::post('register', 'Auth\RegisterController@create');

Route::post('/password.email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::middleware('auth')->prefix('restaurantes')->group(function () {
// Vista del restaurante
    Route::get('read/{id}', 'showRestaurant@showRestaurant')->name('ver_restaurante');
    //Ruta Web para actualizar los datos de un restaurante
    Route::middleware('auth')->get('updateRestaurante/{id}', 'RestUpdateViewController@index')->name('editar_restaurante');
//Ruta Web para crear un restaurante
    Route::get('createRestaurante', 'ControllerFormularioResrtaurante@callController')->name('create_restaurante');
});
// Vista usuarios
Route::get('usuarios/read/{id}', 'showUser@showUser');


// Vista panel del plato
Route::get('adminplato', 'AdminPlatosController@showPlate');

Route::get('menus/{restaurante}','MenuController@index');

Route::middleware('auth')->prefix('menus')->group(function () {
    Route::get('{restaurante}','MenuController@index')->name('view_menu');
    Route::post('menu_do/newMenu','MenuController@newMenu');
    Route::post('menus_do/getMenus','MenuController@getMenusAssign');
});

Route::middleware('auth')->prefix('platos')->group(function(){
    Route::get('{id}',"showPlateController@index");
});
Route::middleware('auth')->prefix('menus/platos_do')->group(function(){
    Route::get('alergenos', "PlateController@getAlergenos");
    Route::get('menus', "PlateController@getMenu");
    //Route::post('set_alergenos',"showPlateController@index");
});


