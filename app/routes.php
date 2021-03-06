<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(['namespace' => 'Fetch\v1\Controllers', 'prefix' => 'v1'], function()
{
    Route::controller('auth', 'AuthController');

    Route::group(['before' => 'fetch_auth'], function ()
    {
        Route::post('drawing/inbox', 'InboxController@index');
        Route::controller('drawing', 'DrawingController');
    });

});


/////////////// 404 ///////////////
App::missing(function($exception)
{
    $api = new \Fetch\v1\Controllers\APIController;
    return $api->respondNotFound();
});
