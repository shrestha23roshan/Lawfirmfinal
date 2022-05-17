<?php

Route::namespace('Modules\About\Http\Controllers')->middleware('access:admin.about')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('about', 'AboutController');
});
