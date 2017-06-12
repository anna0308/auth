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
// Route::get('login', 'Auth\LoginController@getLoginForm')->name('login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('login', 'Auth\LoginController@postLogin');
Route::get('register', 'Auth\RegisterController@getRegisterForm')->name('register');
Route::post('register', 'Auth\RegisterController@postRegister');
Route::get('/register/verify/{code}/{email}', 'Auth\RegisterController@verify');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{url_n}', function () {
    return redirect('/');
});
Route::get('login/{url_n}', function () {
    return redirect('/');
});
Route::get('register/{url_n}', function () {
    return redirect('/');
});