<?php

use App\ImagenRestaurante;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Get user by id//
Route::middleware('auth:api')->get('user/{id}', function (Request $request) {
    return User::find($request->id);
});
//Create y Register user//
Route::post('register', 'Auth\RegisterController@create');
//Update user//
Route::middleware('auth:api')->put('user/modify/{id}', 'UserController@update');
//Delete user//
Route::middleware('auth:api')->delete('user/delete/{id}', 'UserController@delete');

Route::post('/login', 'Auth\LoginController@login');

//Resetear eñ correo recibe un Json
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

//Create restaurante
Route::middleware('auth:api')->post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::middleware('auth:api')->delete('restaurantes/delete/{id}', 'RestauranteController@delete');
//Update restaurante
Route::put('restaurantes/update/{id}', 'RestauranteController@update');


Route::middleware('auth:api')->put('restaurantes/update/{id}', 'RestauranteController@update');
//Get datos del home
Route::get('homeRestaurante', 'RestauranteController@home');
//Get datos del restaurante
Route::get('restaurante', 'RestauranteController@returnAll');

//Get tipo
Route::middleware('auth:api')->get('tipo', 'TipoController@getAll');
//Create tipo
Route::middleware('auth:api')->post('tipo/create', 'TipoController@create');
//Delete tipo
Route::middleware('auth:api')->delete('tipo/delete/{id}', 'TipoController@delete');
//Update tipo
Route::middleware('auth:api')->put('tipo/update/{id}', 'TipoController@update');

//Create imagen restaurante
Route::middleware('auth:api')->post('imagenRestaurante/create', 'ImagenRestauranteController@create');
//Delete imagen restaurante
Route::middleware('auth:api')->delete('imagenRestaurante/delete/{id}', 'ImagenRestauranteController@delete');
//Update imagen restaurante
Route::middleware('auth:api')->put('imagenRestaurante/update/{id}', 'ImagenRestauranteController@update');

