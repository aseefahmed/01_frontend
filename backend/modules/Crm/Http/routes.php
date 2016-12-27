<?php

Route::group(['middleware' => 'web', 'prefix' => 'crm', 'namespace' => 'Modules\Crm\Http\Controllers'], function()
{
	Route::get('/', 'CrmController@index');
});