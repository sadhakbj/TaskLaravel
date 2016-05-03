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

Route::get('/', 'ArticlesController@index');

Route::auth();

Route::resource('articles', 'ArticlesController');

Route::post('/article/{article}/comments/create', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);
Route::delete('/comment/{comment}', ['as' => 'comments.delete', 'uses' => 'CommentsController@destroy']);
Route::patch('/comment/{comment}', ['as' => 'comments.update', 'uses' => 'CommentsController@update']);
Route::get('/collection', 'ArticlesController@collect');