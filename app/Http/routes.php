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
Route::get('group/create', 'ProfessorGroupController@createGroup');
Route::post('group/create', 'ProfessorGroupController@storeGroup');
Route::get('group/show/{id}', 'ProfessorGroupController@showGroup');
Route::post('group/upload/{id}', 'ProfessorGroupController@uploadFile');
Route::get('group/edit/{id}', 'ProfessorGroupController@editGroup');
Route::post('group/edit/{id}', 'ProfessorGroupController@storeEdited');
Route::get('group/delete/{id}', 'ProfessorGroupController@deleteGroup');
Route::get('group/all', 'ProfessorGroupController@getGroups');
Route::get('group/file/download/lecture/{id}', 'GroupController@downloadLecture');
Route::get('group/file/download/exercise/{id}', 'GroupController@downloadExercise');

Route::get('group/file/download/assignment/{id}', 'GroupController@downloadAssignment');
Route::get('group/file/download/assignment/solution/{id}', 'GroupController@downloadAssignmentSolution');
Route::get('group/file/delete/assignment/solution/{id}', 'GroupController@deleteAssignmentSolution');

Route::get('group/file/download/other/{id}', 'GroupController@downloadOther');
Route::get('group/file/delete/lecture/{id}', 'ProfessorGroupController@deleteLecture');
Route::get('group/file/delete/exercise/{id}', 'ProfessorGroupController@deleteExercise');
Route::get('group/file/delete/assignment/{id}', 'ProfessorGroupController@deleteAssignment');
Route::get('group/file/delete/other/{id}', 'ProfessorGroupController@deleteOther');


Route::get('course/all', 'CourseController@showAll');
Route::get('course/show/{id}', 'CourseController@show');
Route::get('course/create', 'CourseController@create');
Route::post('course/create', 'CourseController@store');
Route::get('course/edit/{id}', 'CourseController@edit');
Route::post('course/edit/{id}', 'CourseController@update');
Route::get('course/delete/{id}', 'CourseController@delete');

Route::get('user/show/{id}', 'UserController@show');

Route::get('studgroup/show/{id}', 'GroupController@showGroup');
Route::get('studassignment/show/{id}', 'GroupController@showAssignment');
Route::post('studassignment/upload/{id}', 'GroupController@uploadAssignment');
