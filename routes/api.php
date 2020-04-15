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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
  Route::post('user/details', 'API\UserController@details');
  //create a book resource route
  Route::resource('book', 'API\BookController');

      Route::get('book', 'API\BookController@index');
      Route::get('book/search?', 'API\BookController@show');
      Route::post('book', 'API\BookController@store');
      Route::get('categories', 'API\BookController@categories');
});
