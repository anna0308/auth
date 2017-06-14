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
Route::get('/categories','CategoryController@index');
Route::get('/categories/create','CategoryController@create');
Route::post('/categories','CategoryController@store');
Route::delete('/categories/{id}','CategoryController@destroy');
Route::get('/categories/{id}/edit','CategoryController@edit');
Route::put('/categories/{id}','CategoryController@update');
Route::get('/posts','PostController@index');
Route::get('/posts/create','PostController@create');
Route::post('/posts','PostController@store');
Route::get('/posts/{id}/edit','PostController@edit');
Route::put('/posts/{id}','PostController@update');
Route::delete('/posts/{id}','PostController@destroy');
Route::get('/posts/all','PostController@showAllPosts');
Route::get('/categories/all','CategoryController@showAllCategories');
Route::get('/{url_n}', function () {return redirect('/');});
Route::get('login/{url_n}', function () {return redirect('/');});
Route::get('register/{url_n}', function () {return redirect('/');});