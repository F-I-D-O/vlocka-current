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

//Rou

//echo var_dump(Route::getCurrentRoute()); die;

Route::group(array('prefix' => 'vlocka-current'), function (){
	Route::get('/', 'IndexController@index');
	Route::get('/archiv/{year}/{month}', 'IndexController@archiv');
	Route::post('new-post', 'IndexController@newPost');
	Route::resource('post', 'PostController');
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);
});
		
//Route::get('/vlocka-current/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');


