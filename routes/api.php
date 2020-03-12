<?php

use App\Http\Controllers\AlergernosController;
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

Route::post('/loginApi', 'Auth\LoginController@loginAPI');

//Resetear eñ correo recibe un Json
Route::post('/password/email', 'API\ForgotPasswordController@sendResetLinkEmail');

Route::post('/password/reset', 'API\ResetPasswordController@reset');
//Mostrar tipos de comida
Route::get('tipo', 'TipoController@listarTipos');
//Crear nuevo tipo
Route::post('tipo/create', 'TipoController@anadirTipos');
//Borrar un tipo de comida
Route::delete('tipo/delete/{id}', 'TipoController@borrarTipos');
//Editar un tipo de comida
Route::put('tipo/update/{id}', 'TipoController@modificarTipos');

Route::get('enviar', ['as' => 'enviar', function () {

    $data = ['link' => 'https://cev.com,'];

    \Mail::send('emails.notificacion', $data, function ($message) {

        $message->from('email@cev.com', 'cev.com');

        $message->to('user@example.com')->subject('Notificación');

    });

    return "Se envío el email";
}]);
//Get datos del home
Route::get('homeRestaurante', 'RestauranteController@home');
//Get datos del restaurante
Route::get('restaurante', 'RestauranteController@returnAll');
//Get buscador de restaurante
Route::get('restaurantes/search', 'RestauranteController@search');

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


// Create alergenos
Route::middleware('auth:api')->post('alergeno/create', 'AlergernosController@create');
//Delete alergenos
Route::middleware('auth:api')->delete('alergeno/delete/{id}', 'AlergernosController@delete');
//update alergeno
Route::middleware('auth:api')->put('alergeno/update/{id}', 'AlergernosController@update');




// Create foto del plato
Route::middleware('auth:api')->post('fotoplato/create', 'PlatePicture@create');
//Delete foto del plato
Route::middleware('auth:api')->delete('fotoplato/delete/{id}', 'PlatePicture@delete');


// Create plato
Route::middleware('auth:api')->post('plato/create', 'PlateController@create');
//Delete plato
Route::middleware('auth:api')->delete('plato/delete/{id}', 'PlateController@delete');
//update plato
Route::middleware('auth:api')->put('plato/update/{id}', 'PlateController@update');



// Create menu
Route::middleware('auth:api')->post('menu/create', 'MenuController@create');
//Delete menu
Route::middleware('auth:api')->delete('menu/delete/{id}', 'MenuController@delete');
//update menu
Route::middleware('auth:api')->put('menu/update/{id}', 'MenuController@update');

//Return Restaurantes
Route::get('verTodo', 'RestauranteController@principal');
//Return tipos de comida
Route::get('tipos', 'RestauranteController@tiposRestaurante');




