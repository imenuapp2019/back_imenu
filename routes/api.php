<?php

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

Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('enviar', ['as' => 'enviar', function () {

    $data = ['link' => 'https://cev.com,'];

    \Mail::send('emails.notificacion', $data, function ($message) {

        $message->from('email@cev.com', 'cev.com');

        $message->to('user@example.com')->subject('Notificación');

    });

    return "Se envío el email";
}]);
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//Create restaurante
Route::post('restaurantes/create', 'RestauranteController@create');
//Delete restaurante
Route::delete('restaurantes/delete/{id}', 'RestauranteController@delete');
//Update restaurante
Route::put('restaurantes/update/{id}', 'RestauranteController@update');

//Route::group(['middleware' => ['auth:api']], function() {
//    Route::get('/', function(){
 //       return response('Hello World', 200)
   //     ->header('Content-Type', 'text/plain');
   // });
   // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');

    //Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
//});
