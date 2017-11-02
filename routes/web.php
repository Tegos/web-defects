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

Route::get('/', 'HomeController@index');

Route::get('/public', function () {
	return Redirect::to('/');
});

Route::post('upload', 'ImageController@upload');

Route::get('/image/{id}', 'ImageController@index');

Route::get('/demoGrid', 'ImageController@demoGrid');

Route::get('/ajax/intensity/{id}/{m}_{n}', 'Ajax\ImageIntensity@get');

Route::post('/ajax/chart', 'Ajax\GroupChart@get');