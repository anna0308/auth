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

//cat
Route::post('addCategory', 'CategoryController@store');
Route::get('/categories/my_categories','CategoryController@showMyCategories');
Route::get('/categories', 'CategoryController@index');
Route::delete('deleteCategory/{id}', 'CategoryController@destroy');
Route::get('/categories/{id}/edit', 'CategoryController@edit');
Route::put('/categories/{id}', 'CategoryController@update');
// Route::get('postByCategory/{id}', 'CategoryController@postsByCategory');

//post
Route::get('/posts', 'PostController@index');
Route::get('/posts/create', 'PostController@create');
Route::post('addPost', 'PostController@store');
Route::get('/posts/my_posts','PostController@showMyPosts');
Route::get('/posts/{id}/edit', 'PostController@edit');
Route::put('/posts/{id}', 'PostController@update');
Route::delete('deletePost/{id}', 'PostController@destroy');
Route::get('/categories/{id}/posts','PostController@getPostsByCategoryId');