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

Route::get('/', function () {
$meta = [
		'title' => "Search Makers Log ",
		'pageName' => 'Search',
		'firstName' => 'Kalpit',
		'lastName' => 'Akhawat',
		'gusermail' => 'kalpitakhawat',
		'avatar'	=> 'https://avatars0.githubusercontent.com/u/16951479?v=3&s=460'
	];
	return view('search')
    			->with('meta',$meta);;
});

Route::get('/{gusermail}', function ( $gusermail) {
	
	$meta = [
		'title' => "Kalpit Akhawat's Log",
		'pageName' => 'Kalpit Akhawat',
		'firstName' => 'Kalpit',
		'lastName' => 'Akhawat',
		'gusermail' => 'kalpitakhawat',
		'avatar'	=> 'https://avatars0.githubusercontent.com/u/16951479?v=3&s=460'
	];
    return view('welcome')
    			->with('meta',$meta);
});

Route::get('/log/new', function () {
	
	$meta = [
		'title' => "New log - Kalpit Akhawat",
		'pageName' => 'Kalpit Akhawat / New Log ',
		'firstName' => 'Kalpit',
		'lastName' => 'Akhawat',
		'gusermail' => 'kalpitakhawat',
		'avatar'	=> 'https://avatars0.githubusercontent.com/u/16951479?v=3&s=460'
	];
    return view('newpost')
    			->with('meta',$meta);
});

