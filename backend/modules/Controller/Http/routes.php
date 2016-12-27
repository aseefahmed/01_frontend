<?php

Route::group(['middleware' => 'web', 'prefix' => 'controller', 'namespace' => 'Modules\Controller\Http\Controllers'], function()
{
	Route::get('/', 'ControllerController@index');
});