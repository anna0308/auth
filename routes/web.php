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
Auth::routes();
Route::post('login', 'Auth\LoginController@postLogin');
Route::get('register', 'Auth\RegisterController@getRegisterForm')->name('register');
Route::post('register', 'Auth\RegisterController@postRegister');
Route::get('/register/verify/{code}/{email}', 'Auth\RegisterController@verify');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
Route::get('/categories/my_categories','CategoryController@showMyCategores');
Route::get('/categories/{id}/posts','PostController@getPostsByCategoryId');
Route::resource('categories', 'CategoryController');
Route::get('/posts/my_posts','PostController@showMyPosts');
Route::resource('/posts','PostController');
