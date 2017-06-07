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


Route::get('/', 'RootController@index');
Route::get('/{gusermail}', 'RootController@userpage');
Route::get('/log/new', 'PostController@index');

//-------------Api----------------------
Route::group(['prefix' => 'api','namespace'=>'api'], function () {
    Route::post('search','SearchController@index');
    Route::post('log/publish','PostController@create');
    Route::post('category/add','CategoryController@create');

});