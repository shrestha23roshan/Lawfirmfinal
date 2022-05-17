<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
