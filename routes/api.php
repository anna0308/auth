<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'RegisterController@postRegister');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@logout');
Route::get('/home','HomeController@index');


Route::post('addCategory', 'CategoryController@store');
Route::get('/categories/my_categories','CategoryController@showMyCategories');
Route::get('/categories', 'CategoryController@index');
Route::delete('deleteCategory/{id}', 'CategoryController@destroy');
Route::get('/categories/{id}/edit', 'CategoryController@edit');
// Route::put('updateCategory/{id}', 'CategoryController@update');
// Route::get('postByCategory/{id}', 'CategoryController@postsByCategory');
