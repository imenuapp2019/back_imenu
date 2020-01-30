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

Route::post('register', 'Auth\RegisterController@create');

Route::get('/home', 'HomeController@index')->name('home');

<<<<<<< HEAD
Route::post('/password.email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
=======
Route::get('/formulario', 'ControllerFormularioResrtaurante@callController');

>>>>>>> ed92335d46682d29d54da03af54b9baf194ec711
