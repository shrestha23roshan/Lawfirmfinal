<?php

Route::namespace('Modules\Services\Http\Controllers')->middleware('access:admin.services')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('services', 'ServicesController')->except('show');
});
