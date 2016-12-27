<?php

Route::group(['middleware' => 'web', 'prefix' => 'accouts', 'namespace' => 'Modules\Accouts\Http\Controllers'], function()
{
	Route::get('/', 'AccoutsController@index');
});