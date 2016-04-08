<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@getHome']);
Route::post('books', ['as' => 'books.store', 'uses' => 'BooksController@store']);
Route::post('messages', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);


Route::group(['middleware' => 'auth'], function () {
    Route::get('works/create', ['as' => 'works.create', 'uses' => 'WorksController@create']);
    Route::post('works/store', ['as' => 'works.store', 'uses' => 'WorksController@store']);
    Route::get('works/{id}/edit', ['as' => 'works.edit', 'uses' => 'WorksController@edit'])->where('id', '[0-9]+');
    Route::post('works/{id}/update', ['as' => 'works.update', 'uses' => 'WorksController@update'])->where('id', '[0-9]+');
});


Route::group(['prefix' => 'ajax'], function () {
    Route::match(['get','post'], 'upload', 'AjaxController@upload');
});

Route::get('users/{id}', ['as' => 'users.show', 'uses' => 'UsersController@show'])->where('id', '[0-9]+');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::post('ajax/getList', 'MessagesController@getList');
Route::post('ajax/getSum', 'MessagesController@getSum');
