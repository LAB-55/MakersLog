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

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('root/initial', 'PostController@validateInitial');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'RootController@index');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();
Route::get('/{gusermail}', 'RootController@userpage');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/log/new', 'PostController@index');
    Route::get('/profile/{gusermail}', 'ProfileController@index')->name('profile');
    Route::post('/profile/{gusermail}', 'ProfileController@store')->name('profile');
});

//-------------Api----------------------
Route::group(['prefix' => 'api','namespace'=>'api'], function () {
    Route::post('search','SearchController@index');
    Route::post('log/publish','PostController@create');
    Route::post('log/update','PostController@update');
    Route::post('category','CategoryController@index');
    Route::post('category/add','CategoryController@create');
});
