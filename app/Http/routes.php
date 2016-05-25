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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('group/create', 'GroupController@createGroup');
Route::post('group/create', 'GroupController@storeGroup');
Route::get('group/show/{id}', 'GroupController@showGroup');
Route::post('group/upload/{id}', 'GroupController@uploadFile');
Route::get('group/edit/{id}', 'GroupController@editGroup');
Route::post('group/edit/{id}', 'GroupController@storeEdited');
Route::get('group/delete/{id}', 'GroupController@deleteGroup');
Route::get('group/all', 'GroupController@getGroups');
Route::get('group/file/download/{id}', 'GroupController@downloadFile');
Route::get('group/file/delete/{id}', 'GroupController@deleteFile');

Route::get('discipline/all', 'DisciplineController@showAll');
Route::get('discipline/show/{id}', 'DisciplineController@show');
Route::get('discipline/create', 'DisciplineController@create');

