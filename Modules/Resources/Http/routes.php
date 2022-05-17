<?php

Route::namespace('Modules\Resources\Http\Controllers')->middleware('access:admin.resources')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('resources', 'ResourcesController')->except('show');
});