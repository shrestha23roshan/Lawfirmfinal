<?php

Route::namespace('Modules\Configuration\Http\Controllers')->middleware('access:admin.privilege')->prefix('admin/privilege')->name('admin.privilege.')->group(function(){
       
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);

    Route::put('user/change/status/{user}', ['as' => 'user.change.status', 'uses' => 'UserController@changeStatus']);

});