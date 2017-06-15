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
Route::get('/feedback/reportbug', 'RootController@reportbug');
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('root/initial', 'PostController@validateInitial');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/', 'RootController@index')->name('indexroot');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/log/view/{id}', 'RootController@showPost');
Route::group(['middleware' => 'auth'], function () {
  Route::get('/log/new', 'PostController@index');
  Route::get('/log/edit/{id}', 'PostController@update');
});



//-------------Api----------------------
Route::group(['prefix' => 'api','namespace'=>'api'], function () {
    Route::post('search','SearchController@index');
    Route::post('log/publish','PostController@create');
    Route::post('log/update','PostController@update');
    Route::post('category','CategoryController@index');
    Route::post('category/add','CategoryController@create');
    Route::post('logs/{gusermail}','LogsController@index');
	  Route::post('/{gusermail}/tasks/show', 'TasksController@showTasks');
	  Route::post('/{gusermail}/tasks/add', 'TasksController@create');
    Route::post('/{gusermail}/tasks/delete', 'TasksController@delete');
    Route::post('/{gusermail}/tasks/open', 'TasksController@openUpdate');
	  Route::post('/{gusermail}/tasks/help', 'TasksController@helpUpdate');
	  Route::post('/{gusermail}/tasks/closed', 'TasksController@closedUpdate');
});

// ---------------------------------------------------

Route::get('/{gusermail}', 'RootController@userpage')->name('gusermail');
Route::get('/{gusermail}/profile', 'ProfileController@index')->name('getProfile');
Route::post('/{gusermail}/profile', 'ProfileController@store')->name('postProfile');
Route::get('/{gusermail}/presentations', 'PresentationController@presentations')->name('presentations');
Route::post('/{gusermail}/presentations', 'PresentationController@uploadPresentation')->name('uploadPresentation');
Route::get('/{gusermail}/presentations/{presentation_id}', 'PresentationController@presentationView')->name('presentationView');
Route::get('/{gusermail}/tasks', 'TasksController@index')->name('tasks');
Route::get('/{gusermail}/{pid}/{slug}', 'PostController@individual')->name('individial');
