<?php

Route::namespace('Modules\News\Http\Controllers')->middleware('access:admin.news')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('news', 'NewsController')->except('show');
});
